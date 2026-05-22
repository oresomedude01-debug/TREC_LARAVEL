<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'excerpt', 'category', 'image_url', 'read_time', 'published_at'];
    protected $casts = ['published_at' => 'datetime'];
}
