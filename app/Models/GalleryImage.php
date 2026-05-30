<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['label', 'category', 'image_path', 'height', 'color1', 'color2'];
    
    /**
     * Get the proxy URL for the image
     */
    public function getProxyUrlAttribute()
    {
        if (str_contains($this->image_path, 'drive.google.com')) {
            // Extract file ID from Google Drive URL
            preg_match('/id=([a-zA-Z0-9_-]+)/', $this->image_path, $matches);
            if (isset($matches[1])) {
                return route('image.proxy', ['fileId' => $matches[1]]);
            }
        }
        return $this->image_path;
    }
}
