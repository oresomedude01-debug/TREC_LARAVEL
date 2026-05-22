<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\GalleryImage;
use Illuminate\View\View;

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

    public function wellbeing(): View
    {
        return view('pages.wellbeing');
    }

    public function tscc(): View
    {
        return view('pages.tscc');
    }

    public function gallery(): View
    {
        $galleryItems = GalleryImage::all();
        return view('pages.gallery', compact('galleryItems'));
    }

    public function blog(): View
    {
        $posts = BlogPost::orderBy('published_at', 'desc')->get();
        return view('pages.blog', compact('posts'));
    }

    public function contact(): View
    {
        return view('pages.contact');
    }
}
