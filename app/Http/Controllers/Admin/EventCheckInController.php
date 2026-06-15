<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class EventCheckInController extends Controller
{
    public function index(Event $event): View
    {
        $stats = [
            'total' => $event->registrations()->where('status','confirmed')->count(),
            'checked_in' => $event->registrations()->where('checked_in',true)->count(),
            'remaining' => $event->registrations()->where('status','confirmed')->where('checked_in',false)->count(),
        ];
        $totalCount = $stats['total'];
        $checkedInCount = $stats['checked_in'];
        $recentCheckIns = $event->registrations()
            ->where('checked_in', true)
            ->with(['ticketType','checkedInByUser'])
            ->orderByDesc('checked_in_at')
            ->take(20)->get();
        return view('admin.events.checkin.index', compact('event','stats','recentCheckIns','totalCount','checkedInCount'));
    }

    public function scan(Request $request, Event $event)
    {
        $request->validate(['qr_token' => 'required|string']);
        $token = trim($request->qr_token);

        // Allow manual entry of registration number in the scan box as a fallback
        $registration = EventRegistration::where('event_id', $event->id)
            ->where(function($q) use ($token) {
                $q->where('qr_token', $token)
                  ->orWhere('registration_number', $token);
            })
            ->with('ticketType')
            ->first();

        if (!$registration) {
            return redirect()->back()->with('error', 'Ticket not found or not for this event.');
        }

        if ($registration->status === 'cancelled') {
            return redirect()->back()->with('error', 'This registration has been cancelled.');
        }

        if ($registration->checked_in) {
            return redirect()->back()->with('warning', 'Already checked in at ' . $registration->checked_in_at->format('H:i, d M Y'))->with('attendee', $registration);
        }

        $registration->update([
            'checked_in' => true,
            'checked_in_at' => now(),
            'checked_in_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Check-in successful!')->with('attendee', $registration);
    }

    public function search(Request $request, Event $event)
    {
        $request->validate(['search' => 'required|string|min:2']);
        $q = $request->search;
        
        $searchResults = EventRegistration::where('event_id', $event->id)
            ->where(function($query) use ($q) {
                $query->where('first_name','like',"%$q%")
                    ->orWhere('last_name','like',"%$q%")
                    ->orWhere('email','like',"%$q%")
                    ->orWhere('registration_number','like',"%$q%");
            })
            ->with('ticketType')
            ->take(10)->get();
            
        $stats = [
            'total' => $event->registrations()->where('status','confirmed')->count(),
            'checked_in' => $event->registrations()->where('checked_in',true)->count(),
            'remaining' => $event->registrations()->where('status','confirmed')->where('checked_in',false)->count(),
        ];
        $totalCount = $stats['total'];
        $checkedInCount = $stats['checked_in'];
        $recentCheckIns = $event->registrations()
            ->where('checked_in', true)
            ->with(['ticketType','checkedInByUser'])
            ->orderByDesc('checked_in_at')
            ->take(20)->get();

        return view('admin.events.checkin.index', compact('event', 'stats', 'recentCheckIns', 'totalCount', 'checkedInCount', 'searchResults'));
    }

    public function manualCheckIn(Request $request, Event $event, EventRegistration $registration)
    {
        if ($registration->checked_in) {
            return redirect()->route('admin.events.checkin.index', $event)->with('warning', 'Already checked in.');
        }
        
        $registration->update([
            'checked_in' => true, 'checked_in_at' => now(), 'checked_in_by' => Auth::id(),
        ]);
        
        return redirect()->route('admin.events.checkin.index', $event)->with('success', 'Checked in!')->with('attendee', $registration);
    }
}
