<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageProxyController;

// Public pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/wellbeing', [PageController::class, 'wellbeing'])->name('wellbeing');
Route::get('/tscc', [PageController::class, 'tscc'])->name('tscc');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('admin.contacts');
    Route::get('/blog', [AdminController::class, 'blog'])->name('admin.blog');
    Route::get('/gallery', [AdminController::class, 'gallery'])->name('admin.gallery');
});

// Image proxy route for Google Drive images
Route::get('/image/proxy/{fileId}', [ImageProxyController::class, 'googleDrive'])->name('image.proxy');
