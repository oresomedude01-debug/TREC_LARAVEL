<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSession;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventSessionController extends Controller
{
    public function index(Event $event): View
    {
        $sessions = $event->sessions()->with('speaker')->orderBy('session_date')->orderBy('start_time')->get();
        $sessionsByDay = $sessions->groupBy(fn($s) => $s->session_date?->format('Y-m-d'));
        return view('admin.events.sessions.index', compact('event','sessions','sessionsByDay'));
    }

    public function create(Event $event): View
    {
        $speakers = $event->speakers()->orderBy('name')->get();
        return view('admin.events.sessions.create', compact('event','speakers'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'session_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'venue_room' => 'nullable|string|max:255',
            'category' => 'required|in:keynote,workshop,panel,networking,break,other',
            'track' => 'nullable|string|max:100',
            'speaker_id' => 'nullable|exists:event_speakers,id',
            'display_order' => 'integer|min:0',
        ]);
        $validated['event_id'] = $event->id;
        EventSession::create($validated);
        return redirect()->route('admin.events.sessions.index', $event)->with('success', 'Session added!');
    }

    public function edit(Event $event, EventSession $session): View
    {
        $speakers = $event->speakers()->orderBy('name')->get();
        return view('admin.events.sessions.edit', compact('event','session','speakers'));
    }

    public function update(Request $request, Event $event, EventSession $session): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'session_date' => 'nullable|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'venue_room' => 'nullable|string|max:255',
            'category' => 'required|in:keynote,workshop,panel,networking,break,other',
            'track' => 'nullable|string|max:100',
            'speaker_id' => 'nullable|exists:event_speakers,id',
            'display_order' => 'integer|min:0',
        ]);
        $session->update($validated);
        return redirect()->route('admin.events.sessions.index', $event)->with('success', 'Session updated!');
    }

    public function destroy(Event $event, EventSession $session): RedirectResponse
    {
        $session->delete();
        return redirect()->route('admin.events.sessions.index', $event)->with('success', 'Session removed.');
    }
}
