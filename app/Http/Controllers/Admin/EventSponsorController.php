<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSponsor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventSponsorController extends Controller
{
    public function index(Event $event): View
    {
        $sponsors = $event->sponsors()->orderBy('tier')->orderBy('display_order')->get();
        return view('admin.events.sponsors.index', compact('event','sponsors'));
    }

    public function create(Event $event): View
    {
        return view('admin.events.sponsors.create', compact('event'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'website_url' => 'nullable|url',
            'tier' => 'required|in:platinum,gold,silver,bronze,supporting',
            'display_order' => 'integer|min:0',
        ]);
        $validated['event_id'] = $event->id;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'sponsor-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/sponsors'), $filename);
            $validated['logo'] = '/uploads/events/sponsors/' . $filename;
        }
        EventSponsor::create($validated);
        return redirect()->route('admin.events.sponsors.index', $event)->with('success', 'Sponsor added!');
    }

    public function edit(Event $event, EventSponsor $sponsor): View
    {
        return view('admin.events.sponsors.edit', compact('event','sponsor'));
    }

    public function update(Request $request, Event $event, EventSponsor $sponsor): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'website_url' => 'nullable|url',
            'tier' => 'required|in:platinum,gold,silver,bronze,supporting',
            'display_order' => 'integer|min:0',
        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'sponsor-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/sponsors'), $filename);
            $validated['logo'] = '/uploads/events/sponsors/' . $filename;
        }
        $sponsor->update($validated);
        return redirect()->route('admin.events.sponsors.index', $event)->with('success', 'Sponsor updated!');
    }

    public function destroy(Event $event, EventSponsor $sponsor): RedirectResponse
    {
        $sponsor->delete();
        return redirect()->route('admin.events.sponsors.index', $event)->with('success', 'Sponsor removed.');
    }
}
