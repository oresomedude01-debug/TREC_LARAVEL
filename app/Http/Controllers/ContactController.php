<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'organisation' => 'nullable|string|max:255',
            'service_interest' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactSubmission::create($validated);

        return back()->with('success', 'Thank you for your message! We\'ll get back to you soon.');
    }
}
