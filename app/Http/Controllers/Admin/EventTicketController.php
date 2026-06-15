<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventTicketType;
use App\Services\WaitlistNotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventTicketController extends Controller
{
    public function index(Event $event): View
    {
        $tickets = $event->ticketTypes()->orderBy('display_order')->get();
        return view('admin.events.tickets.index', compact('event','tickets'));
    }

    public function create(Event $event): View
    {
        return view('admin.events.tickets.create', compact('event'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'quantity_available' => 'nullable|integer|min:1',
            'sales_start' => 'nullable|date',
            'sales_end' => 'nullable|date|after_or_equal:sales_start',
            'access_type' => 'required|in:public,invite_only',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string|max:255',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
            'type' => ['required', 'string', 'in:early_bird,standard,vip,student,virtual,team', \Illuminate\Validation\Rule::unique('event_ticket_types')->where('event_id', $event->id)],
            'team_size' => 'nullable|integer|min:2|required_if:type,team',
        ]);
        if ($validated['type'] === 'standard') {
            $earlyBird = $event->ticketTypes()->where('type', 'early_bird')->first();
            if ($earlyBird && $earlyBird->sales_end && $validated['sales_start']) {
                if (\Carbon\Carbon::parse($validated['sales_start'])->lt($earlyBird->sales_end)) {
                    return back()->withErrors(['sales_start' => 'Standard ticket sales must start after Early Bird sales end.'])->withInput();
                }
            } elseif ($earlyBird && $earlyBird->sales_start && $validated['sales_start']) {
                if (\Carbon\Carbon::parse($validated['sales_start'])->lt($earlyBird->sales_start)) {
                    return back()->withErrors(['sales_start' => 'Standard ticket sales must start after Early Bird.'])->withInput();
                }
            }
        }

        $validated['event_id'] = $event->id;
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['benefits'] = array_values(array_filter($request->input('benefits', [])));
        $validated['currency'] = $request->input('currency', 'NGN');
        $validated['team_size'] = $validated['type'] === 'team' ? $validated['team_size'] : null;
        EventTicketType::create($validated);
        return redirect()->route('admin.events.tickets.index', $event)->with('success', 'Ticket type created!');
    }

    public function edit(Event $event, EventTicketType $ticket): View
    {
        return view('admin.events.tickets.edit', compact('event','ticket'));
    }

    public function update(Request $request, Event $event, EventTicketType $ticket): RedirectResponse
    {
        // Store original state for comparison
        $wasOnSale = $ticket->is_on_sale;
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|size:3',
            'quantity_available' => 'nullable|integer|min:1',
            'sales_start' => 'nullable|date',
            'sales_end' => 'nullable|date|after_or_equal:sales_start',
            'access_type' => 'required|in:public,invite_only',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string|max:255',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
            'type' => ['required', 'string', 'in:early_bird,standard,vip,student,virtual,team', \Illuminate\Validation\Rule::unique('event_ticket_types')->where('event_id', $event->id)->ignore($ticket->id)],
            'team_size' => 'nullable|integer|min:2|required_if:type,team',
        ]);
        if ($validated['type'] === 'standard') {
            $earlyBird = $event->ticketTypes()->where('type', 'early_bird')->first();
            if ($earlyBird && $earlyBird->sales_end && $validated['sales_start']) {
                if (\Carbon\Carbon::parse($validated['sales_start'])->lt($earlyBird->sales_end)) {
                    return back()->withErrors(['sales_start' => 'Standard ticket sales must start after Early Bird sales end.'])->withInput();
                }
            } elseif ($earlyBird && $earlyBird->sales_start && $validated['sales_start']) {
                if (\Carbon\Carbon::parse($validated['sales_start'])->lt($earlyBird->sales_start)) {
                    return back()->withErrors(['sales_start' => 'Standard ticket sales must start after Early Bird.'])->withInput();
                }
            }
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['benefits'] = array_values(array_filter($request->input('benefits', [])));
        $validated['currency'] = $request->input('currency', 'NGN');
        $validated['team_size'] = $validated['type'] === 'team' ? $validated['team_size'] : null;
        $ticket->update($validated);
        
        // Check if ticket just went on sale and notify waitlist
        $isNowOnSale = $ticket->is_on_sale;
        if (!$wasOnSale && $isNowOnSale) {
            $notificationService = new WaitlistNotificationService();
            $sentCount = $notificationService->notifyWaitlistedUsers($ticket);
            if ($sentCount > 0) {
                return redirect()->route('admin.events.tickets.index', $event)
                    ->with('success', "Ticket type updated! Waitlist notifications sent to {$sentCount} users.");
            }
        }
        
        return redirect()->route('admin.events.tickets.index', $event)->with('success', 'Ticket type updated!');
    }

    public function destroy(Event $event, EventTicketType $ticket): RedirectResponse
    {
        $ticket->delete();
        return redirect()->route('admin.events.tickets.index', $event)->with('success', 'Ticket type deleted.');
    }
}
