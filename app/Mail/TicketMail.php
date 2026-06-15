<?php

namespace App\Mail;

use App\Models\EventRegistration;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public EventRegistration $registration) {}

    public function envelope(): Envelope
    {
        $fromAddress = Setting::get('mail_from_address') ?: config('mail.from.address');
        $fromName    = Setting::get('mail_from_name')    ?: config('mail.from.name');

        return new Envelope(
            from: new \Illuminate\Mail\Mailables\Address($fromAddress, $fromName),
            subject: '🎟️ Your ticket for ' . $this->registration->event->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ticket',
            with: [
                'registration' => $this->registration,
                'event'        => $this->registration->event,
            ],
        );
    }
}
