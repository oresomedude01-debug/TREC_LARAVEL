<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\GalleryImage;
use App\Models\ContactSubmission;
use App\Models\User;
use App\Models\Setting;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function dashboard(): View
    {
        $blogCount = BlogPost::count();
        $contactCount = ContactSubmission::count();
        $unreadCount = ContactSubmission::where('read', false)->count();
        
        return view('admin.dashboard', compact('blogCount', 'contactCount', 'unreadCount'));
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

    public function createBlog(): View
    {
        return view('admin.blog-create');
    }

    public function storeBlog(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:blog_posts',
            'slug' => 'required|string|max:255|unique:blog_posts',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string|max:100',
            'image_url' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'published_at' => 'nullable|date',
        ]);

        $validated['image_url'] = $this->handleBlogImage($request);
        BlogPost::create($validated);

        return redirect()->route('admin.blog')->with('success', 'Insight created successfully!');
    }

    public function editBlog(BlogPost $post): View
    {
        return view('admin.blog-edit', compact('post'));
    }

    public function updateBlog(Request $request, BlogPost $post): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:blog_posts,title,' . $post->id,
            'slug' => 'required|string|max:255|unique:blog_posts,slug,' . $post->id,
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'category' => 'required|string|max:100',
            'image_url' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'published_at' => 'nullable|date',
        ]);

        $validated['image_url'] = $this->handleBlogImage($request) ?? $post->image_url;
        $post->update($validated);

        return redirect()->route('admin.blog')->with('success', 'Insight updated successfully!');
    }

    public function deleteBlog(BlogPost $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('admin.blog')->with('success', 'Insight deleted successfully!');
    }

    private function handleBlogImage(Request $request): ?string
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'blog-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $filename);
            return '/uploads/blog/' . $filename;
        }
        return $request->input('image_url');
    }

    public function settings(): View
    {
        $settings = [
            'paystack_enabled'    => Setting::get('paystack_enabled', '0'),
            'paystack_public_key' => Setting::get('paystack_public_key', ''),
            'paystack_secret_key' => Setting::get('paystack_secret_key', ''),
            'mail_from_address'   => Setting::get('mail_from_address', config('mail.from.address')),
            'mail_from_name'      => Setting::get('mail_from_name', config('mail.from.name')),
        ];
        return view('admin.settings', compact('settings'));
    }

    public function saveSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'paystack_enabled'    => 'nullable|boolean',
            'paystack_public_key' => 'nullable|string|max:255',
            'paystack_secret_key' => 'nullable|string|max:255',
            'mail_from_address'   => 'nullable|email|max:255',
            'mail_from_name'      => 'nullable|string|max:255',
        ]);

        Setting::set('paystack_enabled',    $request->boolean('paystack_enabled') ? '1' : '0');
        Setting::set('paystack_public_key', $request->input('paystack_public_key', ''));
        Setting::set('paystack_secret_key', $request->input('paystack_secret_key', ''));
        Setting::set('mail_from_address',   $request->input('mail_from_address', ''));
        Setting::set('mail_from_name',      $request->input('mail_from_name', ''));

        return back()->with('success', 'Settings saved successfully!');
    }

    public function gallery(): View
    {
        $images = GalleryImage::all();
        return view('admin.gallery', compact('images'));
    }
}
