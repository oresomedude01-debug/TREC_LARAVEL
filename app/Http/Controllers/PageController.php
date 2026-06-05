<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function tscc(): View
    {
        return view('pages.tscc');
    }

    /**
     * Gallery page — images fetched from Google Drive folder.
     * No database used. Results cached for 2 hours.
     */
    public function gallery(): View
    {
        $folderId = config('services.google_drive.folder_id');
        $apiKey   = config('services.google_drive.api_key');

        $galleryImages = Cache::remember('gallery_drive_' . $folderId, now()->addHours(2), function () use ($folderId, $apiKey) {
            if ($apiKey) {
                return $this->fetchViaApi($folderId, $apiKey);
            }
            return $this->fetchViaHtmlScrape($folderId);
        });

        return view('pages.gallery', compact('galleryImages'));
    }

    // ──────────────────────────────────────────────────────────────────────
    // Private helpers
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Fetch images from Google Drive folder using the API v3.
     * Requires a free Google API key (see README for instructions).
     * Images are served via direct Google thumbnail CDN URLs — no proxy.
     */
    private function fetchViaApi(string $folderId, string $apiKey): array
    {
        try {
            $response = Http::timeout(10)->get('https://www.googleapis.com/drive/v3/files', [
                'q'      => "'{$folderId}' in parents and trashed = false and mimeType contains 'image/'",
                'fields' => 'files(id,name,mimeType)',
                'orderBy'  => 'name',
                'pageSize' => 100,
                'key'      => $apiKey,
            ]);

            if ($response->successful()) {
                return collect($response->json('files', []))
                    ->map(fn ($f) => [
                        'id'    => $f['id'],
                        'label' => pathinfo($f['name'], PATHINFO_FILENAME),
                        'thumb' => "https://drive.google.com/thumbnail?id={$f['id']}&sz=w600-h450-c",
                        'full'  => "https://drive.google.com/thumbnail?id={$f['id']}&sz=w1600",
                    ])
                    ->values()
                    ->toArray();
            }

            Log::warning('Google Drive API error', ['status' => $response->status(), 'body' => $response->body()]);
        } catch (\Exception $e) {
            Log::error('Google Drive API exception: ' . $e->getMessage());
        }

        return [];
    }

    /**
     * Fallback: scrape the public Drive folder HTML to extract file IDs.
     * Works for publicly shared folders without an API key.
     * Less reliable — use the API key method for production.
     */
    private function fetchViaHtmlScrape(string $folderId): array
    {
        try {
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept-Language' => 'en-US,en;q=0.9',
            ])->timeout(15)->get("https://drive.google.com/drive/folders/{$folderId}");

            $html = $response->body();

            // Drive embeds file metadata as a JSON-like data array in the page.
            // Pattern targets 33-char file IDs adjacent to image mime types.
            preg_match_all('/\["([a-zA-Z0-9_-]{25,})"[^\]]*?"image\/(?:jpeg|jpg|png|gif|webp)"/i', $html, $matches);

            $ids = array_unique($matches[1] ?? []);

            if (empty($ids)) {
                // Broader fallback: any 33-char alphanumeric token in the HTML
                preg_match_all('/"([a-zA-Z0-9_-]{33})"/', $html, $broad);
                $ids = array_unique(array_slice($broad[1] ?? [], 0, 50));
            }

            return collect($ids)
                ->map(fn ($id) => [
                    'id'    => $id,
                    'label' => 'Gallery Image',
                    'thumb' => "https://drive.google.com/thumbnail?id={$id}&sz=w600-h450-c",
                    'full'  => "https://drive.google.com/thumbnail?id={$id}&sz=w1600",
                ])
                ->values()
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Drive HTML scrape error: ' . $e->getMessage());
            return [];
        }
    }

    public function blog(): View
    {
        $posts = BlogPost::where('published_at', '!=', null)->orderBy('published_at', 'desc')->get();
        return view('pages.blog', compact('posts'));
    }

    public function showBlog(string $slug): View
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();
        $relatedPosts = BlogPost::where('id', '!=', $post->id)
            ->where('published_at', '!=', null)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();
        return view('pages.blog-show', compact('post', 'relatedPosts'));
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}

