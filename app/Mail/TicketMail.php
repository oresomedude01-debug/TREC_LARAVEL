<?php

namespace App\Mail;

use App\Models\EventRegistration;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use SerializesModels;

    public function __construct(public EventRegistration $registration) {}

    public function envelope(): Envelope
    {
        $fromAddress = Setting::get('mail_from_address') ?: config('mail.from.address');
        $fromName    = Setting::get('mail_from_name')    ?: config('mail.from.name');
        
        // Ensure event is loaded
        $this->registration->loadMissing('event');
        $eventName = $this->registration->event?->name ?? 'Event Ticket';

        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address($fromAddress, $fromName),
            subject: '🎟️ Your ticket for ' . $eventName,
        );
    }

    public function content(): Content
    {
        $this->registration->loadMissing(['event', 'ticketType']);
        
        return new Content(
            view: 'emails.ticket',
            with: [
                'registration' => $this->registration,
                'event'        => $this->registration->event,
            ],
        );
    }
}
