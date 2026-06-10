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
Route::get('/services/counselling-department-setup', [PageController::class, 'serviceDeptSetup'])->name('services.dept-setup');
Route::get('/services/curriculum-development', [PageController::class, 'serviceCurriculum'])->name('services.curriculum');
Route::get('/services/needs-assessment', [PageController::class, 'serviceNeedsAssessment'])->name('services.needs-assessment');
Route::get('/services/training-capacity-building', [PageController::class, 'serviceTraining'])->name('services.training');
Route::get('/services/wellbeing-package', [PageController::class, 'serviceWellbeing'])->name('services.wellbeing');
Route::redirect('/services/tscc-events', '/tscc', 301);
Route::get('/tscc', [PageController::class, 'tscc'])->name('tscc');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/insights', [PageController::class, 'blog'])->name('blog');
Route::get('/insights/{slug}', [PageController::class, 'showBlog'])->name('blog.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Authentication routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('admin.contacts');
    
    // Insights (Blog) Management
    Route::get('/insights', [AdminController::class, 'blog'])->name('admin.blog');
    Route::get('/insights/create', [AdminController::class, 'createBlog'])->name('admin.blog.create');
    Route::post('/insights', [AdminController::class, 'storeBlog'])->name('admin.blog.store');
    Route::get('/insights/{post}/edit', [AdminController::class, 'editBlog'])->name('admin.blog.edit');
    Route::put('/insights/{post}', [AdminController::class, 'updateBlog'])->name('admin.blog.update');
    Route::delete('/insights/{post}', [AdminController::class, 'deleteBlog'])->name('admin.blog.delete');
});

// Image proxy route for Google Drive images
Route::get('/image/proxy/{fileId}', [ImageProxyController::class, 'googleDrive'])->name('image.proxy');
