<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\GalleryImage;
use App\Models\ContactSubmission;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $blogCount = BlogPost::count();
        $galleryCount = GalleryImage::count();
        $contactCount = ContactSubmission::count();
        $unreadCount = ContactSubmission::where('read', false)->count();
        
        return view('admin.dashboard', compact('blogCount', 'galleryCount', 'contactCount', 'unreadCount'));
    }

    public function contacts(): View
    {
        $submissions = ContactSubmission::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contacts', compact('submissions'));
    }

    public function blog(): View
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.blog', compact('posts'));
    }

    public function gallery(): View
    {
        $images = GalleryImage::all();
        return view('admin.gallery', compact('images'));
    }
}
