<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'excerpt', 'category', 'image_url', 'read_time', 'published_at', 'view_count'];
    protected $casts = ['published_at' => 'datetime'];

    public function views()
    {
        return $this->hasMany(BlogPostView::class);
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}
