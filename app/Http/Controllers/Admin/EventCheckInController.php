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

    public function scan(Request $request, Event $event): JsonResponse
    {
        $request->validate(['qr_token' => 'required|string']);
        $token = $request->qr_token;

        $registration = EventRegistration::where('qr_token', $token)
            ->where('event_id', $event->id)
            ->with('ticketType')
            ->first();

        if (!$registration) {
            return response()->json(['status' => 'invalid', 'message' => 'Ticket not found or not for this event.'], 404);
        }

        if ($registration->status === 'cancelled') {
            return response()->json(['status' => 'cancelled', 'message' => 'This registration has been cancelled.', 'registration' => $this->formatReg($registration)], 422);
        }

        if ($registration->checked_in) {
            return response()->json(['status' => 'already_checked_in', 'message' => 'Already checked in at ' . $registration->checked_in_at->format('H:i, d M Y'), 'registration' => $this->formatReg($registration)], 422);
        }

        $registration->update([
            'checked_in' => true,
            'checked_in_at' => now(),
            'checked_in_by' => Auth::id(),
        ]);

        return response()->json(['status' => 'valid', 'message' => 'Check-in successful!', 'registration' => $this->formatReg($registration)]);
    }

    public function search(Request $request, Event $event): JsonResponse
    {
        $request->validate(['q' => 'required|string|min:2']);
        $q = $request->q;
        $results = EventRegistration::where('event_id', $event->id)
            ->where(function($query) use ($q) {
                $query->where('first_name','like',"%$q%")
                    ->orWhere('last_name','like',"%$q%")
                    ->orWhere('email','like',"%$q%")
                    ->orWhere('registration_number','like',"%$q%");
            })
            ->with('ticketType')
            ->take(10)->get()
            ->map(fn($r) => $this->formatReg($r));
        return response()->json(['results' => $results]);
    }

    public function manualCheckIn(Request $request, Event $event, EventRegistration $registration): JsonResponse
    {
        if ($registration->checked_in) {
            return response()->json(['status' => 'already_checked_in', 'message' => 'Already checked in.']);
        }
        $registration->update([
            'checked_in' => true, 'checked_in_at' => now(), 'checked_in_by' => Auth::id(),
        ]);
        return response()->json(['status' => 'valid', 'message' => 'Checked in!', 'registration' => $this->formatReg($registration)]);
    }

    private function formatReg(EventRegistration $r): array
    {
        return [
            'id' => $r->id,
            'full_name' => $r->full_name,
            'email' => $r->email,
            'registration_number' => $r->registration_number,
            'ticket_type' => $r->ticketType?->name,
            'status' => $r->status,
            'payment_status' => $r->payment_status,
            'checked_in' => $r->checked_in,
            'checked_in_at' => $r->checked_in_at?->format('H:i, d M Y'),
        ];
    }
}
