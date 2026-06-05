<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email',
            'phone'            => 'nullable|string|max:50',
            'organisation'     => 'nullable|string|max:255',
            'service_interest' => 'required|string|max:255',
            'message'          => 'required|string',
        ]);

        // 1. Save to local database
        ContactSubmission::create($validated);

        // 2. Forward to Google Sheets via Apps Script Web App
        $sheetsUrl = config('services.google_sheets.url');

        if ($sheetsUrl) {
            try {
                Http::timeout(8)->post($sheetsUrl, [
                    'first_name'       => $validated['first_name'],
                    'last_name'        => $validated['last_name'],
                    'email'            => $validated['email'],
                    'phone'            => $validated['phone'] ?? '',
                    'organisation'     => $validated['organisation'] ?? '',
                    'service_interest' => $validated['service_interest'],
                    'message'          => $validated['message'],
                    'submitted_at'     => now()->toDateTimeString(),
                    'source_url'       => $request->headers->get('referer', config('app.url')),
                ]);
            } catch (\Exception $e) {
                // Non-blocking — log the error but don't fail the user's request
                Log::warning('Google Sheets sync failed: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Thank you for your message! We\'ll get back to you soon.');
    }
}

