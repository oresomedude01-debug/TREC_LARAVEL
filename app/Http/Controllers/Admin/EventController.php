<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventTicketType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function dashboard(): View
    {
        $stats = [
            'total_events' => Event::count(),
            'upcoming_events' => Event::whereIn('status',['published','registration_open'])->where('event_date','>=',now())->count(),
            'active_registrations' => EventRegistration::where('status','confirmed')->count(),
            'tickets_sold' => EventRegistration::where('payment_status','paid')->count(),
            'revenue' => EventRegistration::where('payment_status','paid')->sum('amount_paid'),
            'checkins' => EventRegistration::where('checked_in',true)->count(),
        ];

        $recentActivity = EventRegistration::with(['event','ticketType'])
            ->latest()->take(10)->get();

        $activeEvents = Event::whereIn('status',['published','registration_open','registration_closed'])
            ->withCount(['registrations'])
            ->get()
            ->map(function($event) {
                $event->revenue = $event->registrations()->where('payment_status','paid')->sum('amount_paid');
                $event->checkins = $event->registrations()->where('checked_in',true)->count();
                return $event;
            });

        return view('admin.events.dashboard', compact('stats','recentActivity','activeEvents'));
    }

    public function index(): View
    {
        $events = Event::withCount('registrations')->latest()->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create(): View
    {
        return view('admin.events.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'theme' => 'nullable|string|max:255',
            'slug' => 'required|string|max:50|unique:events,slug|regex:/^[a-z0-9-]+$/',
            'status' => 'required|in:draft,published,registration_open,registration_closed,completed,archived',
            'short_description' => 'nullable|string|max:500',
            'full_description' => 'nullable|string',
            'objectives' => 'nullable|array',
            'objectives.*' => 'string|max:255',
            'target_audience' => 'nullable|string',
            'venue_name' => 'nullable|string|max:255',
            'venue_address' => 'nullable|string',
            'google_maps_url' => 'nullable|url',
            'event_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);

        // Handle image uploads
        foreach (['banner_image','logo_image','social_share_image','email_header_image'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/events'), $filename);
                $validated[$field] = '/uploads/events/' . $filename;
            }
        }

        // Filter out empty objectives
        if (isset($validated['objectives'])) {
            $validated['objectives'] = array_values(array_filter($validated['objectives']));
        }

        $event = Event::create($validated);
        return redirect()->route('admin.events.edit', $event)->with('success', 'Event created successfully!');
    }

    public function edit(Event $event): View
    {
        $event->load(['speakers','sessions.speaker','ticketTypes','sponsors','registrations']);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'theme' => 'nullable|string|max:255',
            'slug' => 'required|string|max:50|unique:events,slug,'.$event->id.'|regex:/^[a-z0-9-]+$/',
            'status' => 'required|in:draft,published,registration_open,registration_closed,completed,archived',
            'short_description' => 'nullable|string|max:500',
            'full_description' => 'nullable|string',
            'objectives' => 'nullable|array',
            'objectives.*' => 'string|max:255',
            'target_audience' => 'nullable|string',
            'venue_name' => 'nullable|string|max:255',
            'venue_address' => 'nullable|string',
            'google_maps_url' => 'nullable|url',
            'event_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
        ]);

        foreach (['banner_image','logo_image','social_share_image','email_header_image'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/events'), $filename);
                $validated[$field] = '/uploads/events/' . $filename;
            }
        }

        if (isset($validated['objectives'])) {
            $validated['objectives'] = array_values(array_filter($validated['objectives']));
        }

        $event->update($validated);
        return back()->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted.');
    }

    public function updateStatus(Request $request, Event $event): RedirectResponse
    {
        $request->validate(['status' => 'required|in:draft,published,registration_open,registration_closed,completed,archived']);
        $event->update(['status' => $request->status]);
        return back()->with('success', 'Event status updated.');
    }
}
