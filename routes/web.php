<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImageProxyController;
use App\Http\Controllers\EventPageController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventSpeakerController;
use App\Http\Controllers\Admin\EventSessionController;
use App\Http\Controllers\Admin\EventTicketController;
use App\Http\Controllers\Admin\EventSponsorController;
use App\Http\Controllers\Admin\EventRegistrationController;
use App\Http\Controllers\Admin\EventMarketingController;
use App\Http\Controllers\Admin\EventCheckInController;
use App\Http\Controllers\Admin\EventWaitlistController;
use App\Models\EventRegistration;

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
Route::get('/tscc/{year}', [EventPageController::class, 'show'])->name('event.show');
Route::post('/tscc/{year}/register', [EventPageController::class, 'register'])->name('event.register');
Route::get('/tscc/{year}/register/confirm/{token}', [EventPageController::class, 'confirm'])->name('event.confirm');

// Paystack payment routes
Route::post('/tscc/{year}/payment/initialize', [EventPageController::class, 'paymentInitialize'])->name('event.payment.initialize');
Route::get('/tscc/{year}/payment/callback', [EventPageController::class, 'paymentCallback'])->name('event.payment.callback');

Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/insights', [PageController::class, 'blog'])->name('blog');
Route::get('/insights/{slug}', [PageController::class, 'showBlog'])->name('blog.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Test email route (for development/debugging)
Route::get('/test-email', function () {
    return view('test-email');
})->name('test.email');

Route::post('/test-email/send', [PageController::class, 'sendTestEmail'])->name('test.email.send');

// Test ticket email (debug)
Route::get('/test-ticket-email/{registration}', function (EventRegistration $registration) {
    \Illuminate\Support\Facades\Log::info('Test ticket email route accessed', ['reg_id' => $registration->id]);
    
    try {
        $registration->loadMissing(['event', 'ticketType']);
        \Illuminate\Support\Facades\Mail::to($registration->email, $registration->first_name . ' ' . $registration->last_name)
            ->send(new \App\Mail\TicketMail($registration));
        return "Ticket email sent to {$registration->email}";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage() . "\n\nTrace:\n" . $e->getTraceAsString();
    }
})->name('test.ticket.email');

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
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [AdminController::class, 'saveSettings'])->name('admin.settings.save');
    
    // Insights (Blog) Management
    Route::get('/insights', [AdminController::class, 'blog'])->name('admin.blog');
    Route::get('/insights/create', [AdminController::class, 'createBlog'])->name('admin.blog.create');
    Route::post('/insights', [AdminController::class, 'storeBlog'])->name('admin.blog.store');
    Route::get('/insights/{post}/edit', [AdminController::class, 'editBlog'])->name('admin.blog.edit');
    Route::put('/insights/{post}', [AdminController::class, 'updateBlog'])->name('admin.blog.update');
    Route::delete('/insights/{post}', [AdminController::class, 'deleteBlog'])->name('admin.blog.delete');

    // Events Management
    Route::prefix('events')->name('admin.events.')->group(function() {
        Route::get('/', [EventController::class, 'dashboard'])->name('dashboard');
        Route::get('/all', [EventController::class, 'index'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::post('/', [EventController::class, 'store'])->name('store');
        Route::get('/{event}/edit', [EventController::class, 'edit'])->name('edit');
        Route::put('/{event}', [EventController::class, 'update'])->name('update');
        Route::delete('/{event}', [EventController::class, 'destroy'])->name('destroy');
        Route::post('/{event}/status', [EventController::class, 'updateStatus'])->name('status');

        // Speakers
        Route::get('/{event}/speakers', [EventSpeakerController::class, 'index'])->name('speakers.index');
        Route::get('/{event}/speakers/create', [EventSpeakerController::class, 'create'])->name('speakers.create');
        Route::post('/{event}/speakers', [EventSpeakerController::class, 'store'])->name('speakers.store');
        Route::get('/{event}/speakers/{speaker}/edit', [EventSpeakerController::class, 'edit'])->name('speakers.edit');
        Route::put('/{event}/speakers/{speaker}', [EventSpeakerController::class, 'update'])->name('speakers.update');
        Route::delete('/{event}/speakers/{speaker}', [EventSpeakerController::class, 'destroy'])->name('speakers.destroy');
        Route::post('/{event}/speakers/order', [EventSpeakerController::class, 'updateOrder'])->name('speakers.order');

        // Sessions
        Route::get('/{event}/sessions', [EventSessionController::class, 'index'])->name('sessions.index');
        Route::get('/{event}/sessions/create', [EventSessionController::class, 'create'])->name('sessions.create');
        Route::post('/{event}/sessions', [EventSessionController::class, 'store'])->name('sessions.store');
        Route::get('/{event}/sessions/{session}/edit', [EventSessionController::class, 'edit'])->name('sessions.edit');
        Route::put('/{event}/sessions/{session}', [EventSessionController::class, 'update'])->name('sessions.update');
        Route::delete('/{event}/sessions/{session}', [EventSessionController::class, 'destroy'])->name('sessions.destroy');

        // Tickets
        Route::get('/{event}/tickets', [EventTicketController::class, 'index'])->name('tickets.index');
        Route::get('/{event}/tickets/create', [EventTicketController::class, 'create'])->name('tickets.create');
        Route::post('/{event}/tickets', [EventTicketController::class, 'store'])->name('tickets.store');
        Route::get('/{event}/tickets/{ticket}/edit', [EventTicketController::class, 'edit'])->name('tickets.edit');
        Route::put('/{event}/tickets/{ticket}', [EventTicketController::class, 'update'])->name('tickets.update');
        Route::delete('/{event}/tickets/{ticket}', [EventTicketController::class, 'destroy'])->name('tickets.destroy');

        // Sponsors
        Route::get('/{event}/sponsors', [EventSponsorController::class, 'index'])->name('sponsors.index');
        Route::get('/{event}/sponsors/create', [EventSponsorController::class, 'create'])->name('sponsors.create');
        Route::post('/{event}/sponsors', [EventSponsorController::class, 'store'])->name('sponsors.store');
        Route::get('/{event}/sponsors/{sponsor}/edit', [EventSponsorController::class, 'edit'])->name('sponsors.edit');
        Route::put('/{event}/sponsors/{sponsor}', [EventSponsorController::class, 'update'])->name('sponsors.update');
        Route::delete('/{event}/sponsors/{sponsor}', [EventSponsorController::class, 'destroy'])->name('sponsors.destroy');

        // Registrations
        Route::get('/{event}/registrations', [EventRegistrationController::class, 'index'])->name('registrations.index');
        Route::get('/{event}/registrations/create', [EventRegistrationController::class, 'create'])->name('registrations.create');
        Route::post('/{event}/registrations', [EventRegistrationController::class, 'store'])->name('registrations.store');
        Route::get('/{event}/registrations/export', [EventRegistrationController::class, 'export'])->name('registrations.export');
        Route::get('/{event}/registrations/{registration}', [EventRegistrationController::class, 'show'])->name('registrations.show');
        Route::post('/{event}/registrations/{registration}/status', [EventRegistrationController::class, 'updateStatus'])->name('registrations.status');

        // Waitlist
        Route::get('/{event}/waitlist', [EventWaitlistController::class, 'index'])->name('waitlist.index');
        Route::post('/{event}/waitlist/notify', [EventWaitlistController::class, 'sendNotifications'])->name('waitlist.notify');
        Route::delete('/{event}/waitlist/{registration}', [EventWaitlistController::class, 'removeFromWaitlist'])->name('waitlist.remove');

        // Check-in
        Route::get('/{event}/checkin', [EventCheckInController::class, 'index'])->name('checkin.index');
        Route::post('/{event}/checkin/scan', [EventCheckInController::class, 'scan'])->name('checkin.scan');
        Route::post('/{event}/checkin/search', [EventCheckInController::class, 'search'])->name('checkin.search');
        Route::post('/{event}/checkin/{registration}', [EventCheckInController::class, 'manualCheckIn'])->name('checkin.manual');

        // Marketing
        Route::get('/{event}/marketing', [EventMarketingController::class, 'index'])->name('marketing.index');
        Route::post('/{event}/marketing', [EventMarketingController::class, 'store'])->name('marketing.store');
        Route::delete('/{event}/marketing/{campaign}', [EventMarketingController::class, 'destroy'])->name('marketing.destroy');
    });
});

// Image proxy route for Google Drive images
Route::get('/image/proxy/{fileId}', [ImageProxyController::class, 'googleDrive'])->name('image.proxy');
