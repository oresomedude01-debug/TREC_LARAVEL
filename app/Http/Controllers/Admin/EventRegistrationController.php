<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventTicketType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    public function index(Event $event, Request $request): View
    {
        $query = $event->registrations()->with(['ticketType']);

        if ($request->status) $query->where('status', $request->status);
        if ($request->payment_status) $query->where('payment_status', $request->payment_status);
        if ($request->ticket_type_id) $query->where('ticket_type_id', $request->ticket_type_id);
        if ($request->search) {
            $q = $request->search;
            $query->where(function($sub) use ($q) {
                $sub->where('first_name','like',"%$q%")
                    ->orWhere('last_name','like',"%$q%")
                    ->orWhere('email','like',"%$q%")
                    ->orWhere('registration_number','like',"%$q%");
            });
        }

        $registrations = $query->latest()->paginate(25);
        $ticketTypes = $event->ticketTypes;
        $stats = [
            'total' => $event->registrations()->count(),
            'confirmed' => $event->registrations()->where('status','confirmed')->count(),
            'paid' => $event->registrations()->where('payment_status','paid')->count(),
            'checked_in' => $event->registrations()->where('checked_in',true)->count(),
            'revenue' => $event->registrations()->where('payment_status','paid')->sum('amount_paid'),
        ];

        return view('admin.events.registrations.index', compact('event','registrations','ticketTypes','stats'));
    }

    public function show(Event $event, EventRegistration $registration): View
    {
        $registration->load(['ticketType','checkedInByUser']);
        return view('admin.events.registrations.show', compact('event','registration'));
    }

    public function create(Event $event): View
    {
        $ticketTypes = $event->ticketTypes()->where('is_active', true)->get();
        return view('admin.events.registrations.create', compact('event','ticketTypes'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'ticket_type_id' => 'nullable|exists:event_ticket_types,id',
            'payment_status' => 'required|in:pending,paid,free,refunded',
            'amount_paid' => 'nullable|numeric|min:0',
            'status' => 'required|in:confirmed,cancelled,waitlisted',
        ]);

        $regNumber = EventRegistration::generateRegistrationNumber($event);
        $validated['event_id'] = $event->id;
        $validated['registration_number'] = $regNumber;
        $validated['qr_token'] = EventRegistration::generateQrToken($regNumber);

        $reg = EventRegistration::create($validated);

        // Increment ticket sold count
        if ($validated['ticket_type_id'] && $validated['status'] === 'confirmed') {
            EventTicketType::find($validated['ticket_type_id'])->increment('quantity_sold');
        }

        return redirect()->route('admin.events.registrations.show', [$event, $reg])
            ->with('success', 'Registration created: ' . $regNumber);
    }

    public function updateStatus(Request $request, Event $event, EventRegistration $registration): RedirectResponse
    {
        $request->validate([
            'payment_status' => 'sometimes|in:pending,paid,free,refunded',
            'status' => 'sometimes|in:confirmed,cancelled,waitlisted',
        ]);
        $registration->update($request->only(['payment_status','status']));
        return back()->with('success', 'Registration updated.');
    }

    public function checkIn(Request $request, Event $event, EventRegistration $registration): RedirectResponse
    {
        if ($registration->checked_in) {
            return back()->with('error', 'Already checked in at ' . $registration->checked_in_at->format('H:i d M Y'));
        }
        $registration->update([
            'checked_in' => true,
            'checked_in_at' => now(),
            'checked_in_by' => Auth::id(),
        ]);
        return back()->with('success', $registration->full_name . ' checked in successfully!');
    }

    public function export(Event $event)
    {
        $registrations = $event->registrations()->with('ticketType')->get();
        $filename = 'registrations-' . $event->slug . '-' . date('Ymd') . '.csv';
        $headers = ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="'.$filename.'"'];
        $callback = function() use ($registrations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Reg No','First Name','Last Name','Email','Phone','Organization','Profession','Ticket Type','Payment Status','Amount Paid','Status','Checked In','Check-in Time','Registered At']);
            foreach ($registrations as $r) {
                fputcsv($file, [
                    $r->registration_number, $r->first_name, $r->last_name, $r->email,
                    $r->phone, $r->organization, $r->profession,
                    $r->ticketType?->name, $r->payment_status, $r->amount_paid,
                    $r->status, $r->checked_in ? 'Yes' : 'No',
                    $r->checked_in_at?->format('d M Y H:i'),
                    $r->created_at->format('d M Y H:i'),
                ]);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
