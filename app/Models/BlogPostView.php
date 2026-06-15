<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPostView extends Model
{
    protected $table = 'blog_post_views';

    protected $fillable = [
        'blog_post_id',
        'ip_address',
        'user_agent',
    ];

    public function blogPost()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
