@component('mail::message')
# {{ $ticketType->name }} Tickets Are Available!

Hello {{ $firstName }},

Great news! The **{{ $ticketType->name }}** tickets for **{{ $event->name }}** are now available for purchase.

You were on our waitlist, so we wanted to notify you first!

@component('mail::button', ['url' => route('event.show', $event->slug)])
Register Now
@endcomponent

**Ticket Details:**
- **Event:** {{ $event->name }}
- **Ticket Type:** {{ $ticketType->name }}
- **Price:** {{ $ticketType->currency }} {{ number_format($ticketType->price, 2) }}
@if($ticketType->benefits && count($ticketType->benefits) > 0)
- **Includes:**
  @foreach($ticketType->benefits as $benefit)
    - {{ $benefit }}
  @endforeach
@endif

@if($ticketType->sales_end)
**Sales Close:** {{ $ticketType->sales_end->format('M d, Y \a\t h:i A') }}
@endif

Don't miss out! Secure your spot now before tickets sell out.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
