<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Ticket – {{ $event->name }}</title>
    <style>
        /* Reset */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f1f5f9; font-family: 'Segoe UI', Arial, sans-serif; color: #1e293b; }
        a { color: inherit; text-decoration: none; }

        /* Wrapper */
        .wrapper { max-width: 600px; margin: 32px auto; }

        /* Header */
        .header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 20px 20px 0 0;
            padding: 40px 40px 32px;
            text-align: center;
        }
        .header-logo {
            font-size: 14px; font-weight: 700; letter-spacing: 2px;
            color: #ef4444; text-transform: uppercase; margin-bottom: 16px;
        }
        .header h1 {
            font-size: 26px; font-weight: 800; color: #ffffff;
            line-height: 1.3; margin-bottom: 6px;
        }
        .header p { font-size: 13px; color: #94a3b8; }

        /* Ticket card */
        .ticket-card {
            background: #ffffff;
            border-left: 6px solid #ef4444;
            margin: 0 40px;
            padding: 28px 32px;
            border-radius: 0;
            position: relative;
        }
        .ticket-card::before, .ticket-card::after {
            content: '';
            position: absolute;
            width: 24px; height: 24px;
            background: #f1f5f9;
            border-radius: 50%;
            top: -12px;
        }
        .ticket-card::before { left: -18px; }
        .ticket-card::after  { right: -18px; }

        /* Info grid */
        .info-grid { display: table; width: 100%; border-collapse: collapse; }
        .info-row  { display: table-row; }
        .info-label, .info-value { display: table-cell; padding: 8px 0; vertical-align: top; }
        .info-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; width: 140px; }
        .info-value { font-size: 14px; font-weight: 600; color: #0f172a; }

        .divider {
            height: 1px; background: #e2e8f0;
            margin: 20px 40px; border: none;
        }
        .divider-dashed {
            border: none; border-top: 2px dashed #e2e8f0;
            margin: 0 40px 0;
        }

        /* Reg number badge */
        .reg-badge {
            background: #fff7ed;
            border: 2px solid #fed7aa;
            border-radius: 12px;
            padding: 14px 24px;
            margin: 0 40px;
            text-align: center;
        }
        .reg-badge .label { font-size: 11px; font-weight: 700; color: #f97316; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .reg-badge .number { font-size: 22px; font-weight: 800; color: #ea580c; letter-spacing: 3px; }

        /* QR placeholder */
        .qr-section {
            text-align: center;
            padding: 24px 40px 20px;
            background: #ffffff;
        }
        .qr-box {
            display: inline-block;
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 10px;
        }
        .qr-box img { display: block; width: 120px; height: 120px; }
        .qr-label { font-size: 11px; color: #94a3b8; }

        /* Note box */
        .note-box {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            border-radius: 0 12px 12px 0;
            margin: 0 40px;
            padding: 14px 18px;
            font-size: 13px;
            color: #1d4ed8;
            line-height: 1.6;
        }

        /* CTA Button */
        .cta-wrap { text-align: center; padding: 28px 40px 8px; }
        .cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #ffffff !important;
            font-size: 14px; font-weight: 700;
            padding: 14px 32px;
            border-radius: 50px;
            letter-spacing: 0.5px;
        }

        /* Footer */
        .footer {
            background: #0f172a;
            border-radius: 0 0 20px 20px;
            padding: 28px 40px;
            text-align: center;
        }
        .footer p { font-size: 12px; color: #475569; line-height: 1.7; }
        .footer a { color: #ef4444; }
    </style>
</head>
<body>
<div class="wrapper">

    <!-- Header -->
    <div class="header">
        <div class="header-logo">The Ripple Effect Consult</div>
        <h1>🎟️ You're Registered!</h1>
        <p>Your ticket has been confirmed. We can't wait to see you there.</p>
    </div>

    <!-- Greeting -->
    <div style="background:#fff; padding:28px 40px 0; font-size:15px; line-height:1.7; color:#334155;">
        <p>Hi <strong>{{ $registration->first_name }}</strong>,</p>
        <p style="margin-top:8px;">
            Thank you for registering for <strong>{{ $event->name }}</strong>. Your spot is confirmed!
            Please bring this email (printed or on your phone) to the event for check-in.
        </p>
    </div>

    <!-- Registration Number Badge -->
    <div style="background:#fff; padding:20px 0 0;">
        <div class="reg-badge">
            <div class="label">Registration Number</div>
            <div class="number">{{ $registration->registration_number }}</div>
        </div>
    </div>

    <!-- Dashed divider (tear line) -->
    <div style="background:#fff; padding:20px 0 0;">
        <hr class="divider-dashed">
    </div>

    <!-- Ticket Details -->
    <div class="ticket-card">
        <div style="font-size:11px; font-weight:700; color:#ef4444; text-transform:uppercase; letter-spacing:1px; margin-bottom:16px;">
            Event Details
        </div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-label">Event</div>
                <div class="info-value">{{ $event->name }}</div>
            </div>
            @if($event->theme)
            <div class="info-row">
                <div class="info-label">Theme</div>
                <div class="info-value">{{ $event->theme }}</div>
            </div>
            @endif
            @if(!empty($event->dates) && count($event->dates) > 0)
            <div class="info-row">
                <div class="info-label">Date</div>
                <div class="info-value">
                    @foreach($event->dates as $dt)
                        {{ \Carbon\Carbon::parse($dt['date'])->format('l, F j, Y') }}
                        @if(!empty($dt['start_time']))
                            <br><small style="color:#718096">{{ \Carbon\Carbon::parse($dt['start_time'])->format('h:i A') }}{{ !empty($dt['end_time']) ? ' - '.\Carbon\Carbon::parse($dt['end_time'])->format('h:i A') : '' }}</small>
                        @endif
                        {!! !$loop->last ? '<br><br>' : '' !!}
                    @endforeach
                </div>
            </div>
            @elseif($event->event_date)
            <div class="info-row">
                <div class="info-label">Date</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($event->event_date)->format('l, F j, Y') }}@if($event->end_date && $event->end_date->neq($event->event_date)) &mdash; {{ \Carbon\Carbon::parse($event->end_date)->format('l, F j, Y') }}@endif
                </div>
            </div>
            @endif
            @if($event->start_time)
            <div class="info-row">
                <div class="info-label">Time</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($event->start_time)->format('g:i A') }}
                    @if($event->end_time) – {{ \Carbon\Carbon::parse($event->end_time)->format('g:i A') }}@endif
                </div>
            </div>
            @endif
            @if(!empty($event->venues) && count($event->venues) > 0)
            <div class="info-row">
                <div class="info-label">Venue</div>
                <div class="info-value">
                    {{ collect($event->venues)->pluck('name')->join(', ') }}
                </div>
            </div>
            @elseif($event->venue_name)
            <div class="info-row">
                <div class="info-label">Venue</div>
                <div class="info-value">
                    {{ $event->venue_name }}
                    @if($event->venue_address)<br><small style="color:#718096">{{ $event->venue_address }}</small>@endif
                </div>
            </div>
            @endif
            @if($registration->ticketType)
            <div class="info-row">
                <div class="info-label">Ticket</div>
                <div class="info-value">{{ $registration->ticketType->name }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">Name</div>
                <div class="info-value">{{ $registration->first_name }} {{ $registration->last_name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Email</div>
                <div class="info-value" style="font-weight:400; color:#475569;">{{ $registration->email }}</div>
            </div>
            @if($registration->organization)
            <div class="info-row">
                <div class="info-label">Organisation</div>
                <div class="info-value" style="font-weight:400;">{{ $registration->organization }}</div>
            </div>
            @endif
            <div class="info-row">
                <div class="info-label">Payment</div>
                <div class="info-value">
                    @if($registration->payment_status === 'paid')
                        <span style="color:#16a34a;">✔ Paid ({{ $registration->ticketType?->currency ?? 'NGN' }} {{ number_format($registration->amount_paid, 2) }})</span>
                    @elseif($registration->payment_status === 'free')
                        <span style="color:#2563eb;">Free Ticket</span>
                    @else
                        <span style="color:#d97706;">Pending</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- QR Code section -->
    <div class="qr-section">
        <div class="qr-box">
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode($registration->registration_number) }}&color=0f172a&bgcolor=f8fafc"
                 alt="QR Code – {{ $registration->registration_number }}">
        </div>
        <div class="qr-label">Scan at the venue for check-in</div>
    </div>

    <!-- Divider -->
    <hr class="divider">

    <!-- Note -->
    <div class="note-box">
        <strong>📌 Please note:</strong> This email serves as your official event ticket. Present it at the entrance for check-in. Ensure the QR code is visible and unobstructed.
    </div>

    <!-- CTA -->
    <div class="cta-wrap">
        <a href="{{ route('event.show', $event->slug) }}" class="cta-btn">
            View Event Details →
        </a>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>
            © {{ date('Y') }} The Ripple Effect Consult (TREC) · All rights reserved<br>
            Questions? Email us at <a href="mailto:info@therippleeffectconsult.com">info@therippleeffectconsult.com</a>
        </p>
        <p style="margin-top:10px; font-size:11px; color:#334155;">
            You received this email because you registered for {{ $event->name }}.
        </p>
    </div>

</div>
</body>
</html>
