<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ImageProxyController extends Controller
{
    /**
     * Proxy Google Drive images to avoid CORS issues.
     * Images are cached server-side for 7 days so Google Drive
     * is only hit once per unique file.
     */
    public function googleDrive($fileId)
    {
        $cacheKey = 'img_proxy_' . $fileId;

        // Serve from cache if available
        $cached = Cache::get($cacheKey);
        if ($cached) {
            return response($cached['body'])
                ->header('Content-Type', $cached['contentType'])
                ->header('Cache-Control', 'public, max-age=604800')
                ->header('X-Cache', 'HIT')
                ->header('Access-Control-Allow-Origin', '*');
        }

        try {
            // Google Drive direct download URL
            $url = "https://drive.google.com/uc?export=download&id={$fileId}";

            // Fetch with proper headers
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'Accept'     => 'image/*',
                'Referer'    => 'https://drive.google.com/',
            ])->timeout(30)->followRedirects()->get($url);

            if ($response->successful()) {
                $contentType = $response->header('Content-Type');

                // Default to image/jpeg if content type is not set or is HTML
                if (!$contentType || str_contains($contentType, 'text/html')) {
                    $contentType = 'image/jpeg';
                }

                $body = $response->body();

                // Cache image body + content-type for 7 days
                Cache::put($cacheKey, [
                    'body'        => $body,
                    'contentType' => $contentType,
                ], now()->addDays(7));

                return response($body)
                    ->header('Content-Type', $contentType)
                    ->header('Cache-Control', 'public, max-age=604800')
                    ->header('X-Cache', 'MISS')
                    ->header('Access-Control-Allow-Origin', '*');
            }

            abort(404, 'Image not found');
        } catch (\Exception $e) {
            \Log::error('Image proxy error: ' . $e->getMessage());
            abort(500, 'Failed to load image');
        }
    }
}
