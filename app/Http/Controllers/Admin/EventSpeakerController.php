<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSpeaker;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventSpeakerController extends Controller
{
    public function index(Event $event): View
    {
        $speakers = $event->speakers()->orderBy('display_order')->get();
        return view('admin.events.speakers.index', compact('event','speakers'));
    }

    public function create(Event $event): View
    {
        return view('admin.events.speakers.create', compact('event'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'is_featured' => 'boolean',
            'display_order' => 'integer|min:0',
            'social_links.twitter' => 'nullable|url',
            'social_links.linkedin' => 'nullable|url',
            'social_links.website' => 'nullable|url',
        ]);

        $validated['event_id'] = $event->id;
        $validated['social_links'] = array_filter($request->input('social_links', []));
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['display_order'] = $request->input('display_order', EventSpeaker::where('event_id', $event->id)->max('display_order') + 1);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'speaker-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/speakers'), $filename);
            $validated['photo'] = '/uploads/events/speakers/' . $filename;
        }

        EventSpeaker::create($validated);
        return redirect()->route('admin.events.speakers.index', $event)->with('success', 'Speaker added successfully!');
    }

    public function edit(Event $event, EventSpeaker $speaker): View
    {
        return view('admin.events.speakers.edit', compact('event','speaker'));
    }

    public function update(Request $request, Event $event, EventSpeaker $speaker): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'organization' => 'nullable|string|max:255',
            'biography' => 'nullable|string',
            'is_featured' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        $validated['social_links'] = array_filter($request->input('social_links', []));
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'speaker-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/speakers'), $filename);
            $validated['photo'] = '/uploads/events/speakers/' . $filename;
        }

        $speaker->update($validated);
        return redirect()->route('admin.events.speakers.index', $event)->with('success', 'Speaker updated!');
    }

    public function destroy(Event $event, EventSpeaker $speaker): RedirectResponse
    {
        $speaker->delete();
        return redirect()->route('admin.events.speakers.index', $event)->with('success', 'Speaker removed.');
    }

    public function updateOrder(Request $request, Event $event)
    {
        $request->validate(['order' => 'required|array', 'order.*' => 'integer']);
        foreach ($request->order as $index => $id) {
            EventSpeaker::where('id', $id)->where('event_id', $event->id)->update(['display_order' => $index]);
        }
        return response()->json(['success' => true]);
    }
}
