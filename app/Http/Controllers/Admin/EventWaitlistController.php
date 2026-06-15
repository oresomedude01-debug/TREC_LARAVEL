<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Services\WaitlistNotificationService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EventWaitlistController extends Controller
{
    public function index(Event $event, Request $request): View
    {
        $query = $event->registrations()
            ->where('status', 'waitlisted')
            ->with(['ticketType']);

        if ($request->search) {
            $q = $request->search;
            $query->where(function($sub) use ($q) {
                $sub->where('first_name','like',"%$q%")
                    ->orWhere('last_name','like',"%$q%")
                    ->orWhere('email','like',"%$q%")
                    ->orWhere('registration_number','like',"%$q%");
            });
        }

        if ($request->ticket_type_id) {
            $query->where('ticket_type_id', $request->ticket_type_id);
        }

        if ($request->notified_status) {
            if ($request->notified_status === 'notified') {
                $query->whereNotNull('waitlist_notified_at');
            } elseif ($request->notified_status === 'pending') {
                $query->whereNull('waitlist_notified_at');
            }
        }

        $waitlisters = $query->latest()->paginate(25);
        $ticketTypes = $event->ticketTypes;
        
        $stats = [
            'total' => $event->registrations()->where('status', 'waitlisted')->count(),
            'pending' => $event->registrations()->where('status', 'waitlisted')->whereNull('waitlist_notified_at')->count(),
            'notified' => $event->registrations()->where('status', 'waitlisted')->whereNotNull('waitlist_notified_at')->count(),
        ];

        return view('admin.events.waitlist.index', compact('event', 'waitlisters', 'ticketTypes', 'stats'));
    }

    public function sendNotifications(Event $event, Request $request): RedirectResponse
    {
        $request->validate(['ticket_type_id' => 'required|exists:event_ticket_types,id']);
        
        $ticket = $event->ticketTypes()->findOrFail($request->ticket_type_id);
        $service = new WaitlistNotificationService();
        $sent = $service->notifyWaitlistedUsers($ticket);

        return back()->with('success', "Notifications sent to {$sent} waitlisted users for {$ticket->name}.");
    }

    public function removeFromWaitlist(Event $event, EventRegistration $registration): RedirectResponse
    {
        if ($registration->status !== 'waitlisted') {
            return back()->with('error', 'This registration is not on the waitlist.');
        }

        $registration->delete();
        return back()->with('success', 'Registration removed from waitlist.');
    }
}
