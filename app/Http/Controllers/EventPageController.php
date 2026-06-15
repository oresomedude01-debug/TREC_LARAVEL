<?php
namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Models\Event;
use App\Models\EventEmailLog;
use App\Models\EventMarketingCampaign;
use App\Models\EventRegistration;
use App\Models\EventTicketType;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Http\Response;

class EventPageController extends Controller
{
    // ─────────────────────────────────────────────────────────────────────────
    // PUBLIC PAGES
    // ─────────────────────────────────────────────────────────────────────────

    public function show(Request $request, string $year): View|Response
    {
        $event = Event::where('slug', $year)
            ->whereIn('status', ['published','registration_open','registration_closed','completed'])
            ->with([
                'speakers'    => fn($q) => $q->orderBy('display_order'),
                'sessions'    => fn($q) => $q->with('speaker')->orderBy('session_date')->orderBy('start_time'),
                'ticketTypes' => fn($q) => $q->where('is_active', true)->where('access_type','public')->orderBy('display_order'),
                'sponsors'    => fn($q) => $q->orderByRaw("CASE tier WHEN 'platinum' THEN 1 WHEN 'gold' THEN 2 WHEN 'silver' THEN 3 WHEN 'bronze' THEN 4 WHEN 'supporting' THEN 5 ELSE 6 END"),
            ])
            ->firstOrFail();

        // Track marketing click if ref code present
        if ($request->ref) {
            $campaign = EventMarketingCampaign::where('ref_code', $request->ref)->first();
            if ($campaign) $campaign->increment('clicks');
        }

        $sessionsByDay    = $event->sessions->groupBy(fn($s) => $s->session_date?->format('Y-m-d'));
        $sponsorsByTier   = $event->sponsors->groupBy('tier');
        $featuredSpeakers = $event->speakers->where('is_featured', true);
        $allSpeakers      = $event->speakers;

        // Find currently active ticket (on sale, not sold out)
        $activeTicket = $event->ticketTypes->first(fn($t) => $t->is_on_sale && !$t->is_sold_out);

        // Find the next upcoming ticket (scheduled, not yet on sale)
        $nextTicket = $event->ticketTypes
            ->filter(fn($t) => $t->sales_start && $t->sales_start->isFuture())
            ->sortBy('sales_start')
            ->first();

        // Registration deadline = earliest sales_end among active tickets, or event date
        $registrationDeadline = $event->ticketTypes
            ->filter(fn($t) => $t->sales_end)
            ->sortBy('sales_end')
            ->first()?->sales_end ?? $event->event_date;

        // Total confirmed registrations for social proof
        $totalRegistrations = $event->registrations()->where('status', 'confirmed')->count();

        // Paystack public key (passed to view for JS popup)
        $paystackPublicKey = Setting::get('paystack_public_key', '');
        $paystackEnabledValue = Setting::get('paystack_enabled', '0');
        $paystackEnabled = in_array($paystackEnabledValue, ['1', 1, 'true', true, 'on', 'yes'], true);

        return view('pages.event-show', compact(
            'event','sessionsByDay','sponsorsByTier','featuredSpeakers','allSpeakers',
            'activeTicket','nextTicket','registrationDeadline','totalRegistrations',
            'paystackPublicKey','paystackEnabled'
        ));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // REGISTRATION
    // ─────────────────────────────────────────────────────────────────────────

    public function register(Request $request, string $year): RedirectResponse|JsonResponse
    {
        $event = Event::where('slug', $year)
            ->whereIn('status', ['published', 'registration_open'])
            ->firstOrFail();

        // Determine if waitlist is active
        $activeTicket = $event->ticketTypes->first(fn($t) => $t->is_on_sale && !$t->is_sold_out);
        $showWaitlist = ($event->status === 'published') || ($event->status === 'registration_open' && !$activeTicket);

        $rules = [
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'nullable|string|max:20',
            'organization'   => 'nullable|string|max:255',
            'profession'     => 'nullable|string|max:255',
        ];

        if ($showWaitlist) {
            $rules['ticket_type_id'] = 'nullable|exists:event_ticket_types,id';
        } else {
            $rules['ticket_type_id'] = 'required|exists:event_ticket_types,id';
        }

        $validated = $request->validate($rules);

        // Check for duplicate registration
        $existing = EventRegistration::where('event_id', $event->id)->where('email', $validated['email'])->first();
        if ($existing) {
            $msg = $showWaitlist 
                ? 'You have already joined the waitlist for this event with this email address.'
                : 'You have already registered for this event with this email address.';
            return back()->withErrors(['email' => $msg])->withInput();
        }

        // Handle Waitlist Flow
        if ($showWaitlist) {
            $regNumber = EventRegistration::generateRegistrationNumber($event);
            $reg = EventRegistration::create([
                ...$validated,
                'event_id'            => $event->id,
                'registration_number' => $regNumber,
                'qr_token'            => EventRegistration::generateQrToken($regNumber),
                'payment_status'      => 'free',
                'amount_paid'         => 0,
                'status'              => 'waitlisted',
                'utm_source'          => $request->utm_source,
                'utm_medium'          => $request->utm_medium,
                'utm_campaign'        => $request->utm_campaign,
                'ref_code'            => $request->ref,
            ]);

            return redirect()->route('event.confirm', ['year' => $year, 'token' => $reg->qr_token])
                ->with('success', 'Waitlist joined successfully! We will notify you once tickets become available.');
        }

        // Check ticket availability
        $ticket = EventTicketType::find($validated['ticket_type_id']);
        if (!$ticket || !$ticket->is_on_sale || $ticket->is_sold_out) {
            return back()->withErrors(['ticket_type_id' => 'This ticket type is no longer available.'])->withInput();
        }

        // For FREE tickets → confirm immediately and send email
        if ($ticket->price == 0) {
            $reg = $this->createRegistration($event, $ticket, $validated, $request, 'free');
            $this->sendTicketEmail($reg);

            return redirect()->route('event.confirm', ['year' => $year, 'token' => $reg->qr_token])
                ->with('success', 'Registration successful! Your registration number is ' . $reg->registration_number);
        }

        // For PAID tickets → redirect to Paystack
        $paystackEnabledValue = Setting::get('paystack_enabled', '0');
        $paystackEnabled = in_array($paystackEnabledValue, ['1', 1, 'true', true, 'on', 'yes'], true);
        $paystackSecretKey = Setting::get('paystack_secret_key', '');

        if (!$paystackEnabled || !$paystackSecretKey) {
            return back()->withErrors(['ticket_type_id' => 'Online payment is not configured yet. Please contact the organiser.'])->withInput();
        }

        // Create a pending registration first (so we can reference it in callback)
        $reg = $this->createRegistration($event, $ticket, $validated, $request, 'pending');

        // Initialize Paystack transaction
        $callbackUrl = route('event.payment.callback', ['year' => $year]) . '?token=' . $reg->qr_token;

        try {
            $response = Http::timeout(15)->withToken($paystackSecretKey)
                ->post('https://api.paystack.co/transaction/initialize', [
                    'email'        => $reg->email,
                    'amount'       => (int) ($ticket->price * 100), // Paystack uses kobo
                    'currency'     => $ticket->currency ?? 'NGN',
                    'reference'    => $reg->registration_number,
                    'callback_url' => $callbackUrl,
                    'metadata'     => [
                        'registration_id'     => $reg->id,
                        'registration_number' => $reg->registration_number,
                        'event_name'          => $event->name,
                        'ticket_type'         => $ticket->name,
                        'full_name'           => $reg->first_name . ' ' . $reg->last_name,
                    ],
                ]);

            if (!$response->successful() || !$response->json('status')) {
                Log::error('Paystack initialization failed', [
                    'response' => $response->json(),
                    'reg'      => $reg->registration_number,
                ]);
                $reg->delete();
                return back()->withErrors(['ticket_type_id' => 'Could not connect to payment gateway. Please try again.'])->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Paystack initialization exception', [
                'error' => $e->getMessage(),
                'reg'   => $reg->registration_number,
            ]);
            $reg->delete();
            return back()->withErrors(['ticket_type_id' => 'Payment gateway connection timed out. Please try again.'])->withInput();
        }

        $authorizationUrl = $response->json('data.authorization_url');

        return redirect()->away($authorizationUrl);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // PAYSTACK CALLBACK
    // ─────────────────────────────────────────────────────────────────────────

    public function paymentCallback(Request $request, string $year): RedirectResponse
    {
        $reference = $request->query('reference') ?? $request->query('trxref');
        $token     = $request->query('token');

        if (!$reference && !$token) {
            return redirect()->route('event.show', $year)
                ->withErrors(['payment' => 'Invalid payment callback. Please contact support.']);
        }

        $paystackSecretKey = Setting::get('paystack_secret_key', '');

        try {
            // Verify the transaction with Paystack
            $verifyResponse = Http::timeout(15)->withToken($paystackSecretKey)
                ->get("https://api.paystack.co/transaction/verify/{$reference}");

            if (!$verifyResponse->successful()) {
                Log::error('Paystack verification failed', ['reference' => $reference, 'response' => $verifyResponse->json()]);
                return redirect()->route('event.show', $year)
                    ->withErrors(['payment' => 'Payment verification failed. Please contact support.']);
            }
        } catch (\Exception $e) {
            Log::error('Paystack verification exception', ['reference' => $reference, 'error' => $e->getMessage()]);
            return redirect()->route('event.show', $year)
                ->withErrors(['payment' => 'Payment verification timed out. Please contact support if you have been debited.']);
        }

        $data   = $verifyResponse->json('data');
        $status = $data['status'] ?? null;

        // Find the registration by reference (registration_number) or token
        $reg = EventRegistration::where('registration_number', $reference)
            ->orWhere('qr_token', $token)
            ->with(['event', 'ticketType'])
            ->first();

        if (!$reg) {
            return redirect()->route('event.show', $year)
                ->withErrors(['payment' => 'Registration not found. Please contact support.']);
        }

        if ($status === 'success') {
            // Guard: don't double-process
            if ($reg->payment_status !== 'paid') {
                $amountPaid = ($data['amount'] ?? 0) / 100;

                $reg->update([
                    'payment_status' => 'paid',
                    'amount_paid'    => $amountPaid,
                    'status'         => 'confirmed',
                ]);

                // Increment ticket sold count if not already done
                if ($reg->ticketType && $reg->payment_status !== 'paid') {
                    $reg->ticketType->increment('quantity_sold');
                }

                // Track marketing revenue
                if ($reg->ref_code) {
                    $campaign = EventMarketingCampaign::where('ref_code', $reg->ref_code)->first();
                    if ($campaign) {
                        $campaign->increment('registrations');
                        $campaign->increment('revenue', $amountPaid);
                    }
                }

                // Send ticket email
                $this->sendTicketEmail($reg);
            }

            return redirect()->route('event.confirm', ['year' => $year, 'token' => $reg->qr_token])
                ->with('success', 'Payment successful! Your ticket has been sent to ' . $reg->email);
        }

        // Payment failed or was abandoned
        Log::warning('Paystack payment not successful', ['reference' => $reference, 'status' => $status]);

        $reg->update(['status' => 'cancelled']);

        return redirect()->route('event.show', $year)
            ->withErrors(['payment' => 'Your payment was not completed. Please try again or contact support.']);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // CONFIRMATION PAGE
    // ─────────────────────────────────────────────────────────────────────────

    public function confirm(string $year, string $token): View|Response
    {
        $event = Event::where('slug', $year)->firstOrFail();
        $registration = EventRegistration::where('qr_token', $token)
            ->where('event_id', $event->id)
            ->with('ticketType')
            ->firstOrFail();
        return view('pages.event-confirm', compact('event','registration'));
    }

    // ─────────────────────────────────────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────────────────────────────────────

    private function createRegistration(Event $event, EventTicketType $ticket, array $validated, Request $request, string $paymentStatus): EventRegistration
    {
        $regNumber = EventRegistration::generateRegistrationNumber($event);

        $reg = EventRegistration::create([
            ...$validated,
            'event_id'            => $event->id,
            'registration_number' => $regNumber,
            'qr_token'            => EventRegistration::generateQrToken($regNumber),
            'payment_status'      => $paymentStatus,
            'amount_paid'         => 0,
            'status'              => $paymentStatus === 'free' ? 'confirmed' : 'waitlisted',
            'utm_source'          => $request->utm_source,
            'utm_medium'          => $request->utm_medium,
            'utm_campaign'        => $request->utm_campaign,
            'ref_code'            => $request->ref,
        ]);

        // Increment sold count for free tickets immediately
        if ($paymentStatus === 'free') {
            $ticket->increment('quantity_sold');
        }

        return $reg;
    }

    private function sendTicketEmail(EventRegistration $reg): void
    {
        $reg->loadMissing(['event', 'ticketType']);

        Log::info('Attempting to send ticket email', [
            'registration_id' => $reg->id,
            'registration_number' => $reg->registration_number,
            'email' => $reg->email,
            'event_id' => $reg->event_id,
        ]);

        try {
            Mail::to($reg->email, $reg->first_name . ' ' . $reg->last_name)
                ->send(new TicketMail($reg));

            Log::info('Ticket email sent successfully', [
                'registration_number' => $reg->registration_number,
                'email' => $reg->email,
            ]);

            EventEmailLog::create([
                'event_id'        => $reg->event_id,
                'registration_id' => $reg->id,
                'template'        => 'confirmation',
                'recipient_email' => $reg->email,
                'recipient_name'  => $reg->first_name . ' ' . $reg->last_name,
                'status'          => 'sent',
                'sent_at'         => now(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to send ticket email', [
                'registration' => $reg->registration_number,
                'email' => $reg->email,
                'error'        => $e->getMessage(),
                'trace' => substr($e->getTraceAsString(), 0, 500),
            ]);

            EventEmailLog::create([
                'event_id'        => $reg->event_id,
                'registration_id' => $reg->id,
                'template'        => 'confirmation',
                'recipient_email' => $reg->email,
                'recipient_name'  => $reg->first_name . ' ' . $reg->last_name,
                'status'          => 'failed',
                'error_message'   => $e->getMessage(),
                'sent_at'         => now(),
            ]);
        }
    }
}
