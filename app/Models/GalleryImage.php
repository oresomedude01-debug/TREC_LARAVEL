<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['label', 'category', 'image_path', 'height', 'color1', 'color2'];
}
