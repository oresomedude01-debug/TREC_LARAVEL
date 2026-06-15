@extends('layouts.app')

@section('title', 'Registration Confirmed – ' . $event->name)

@section('content')
<section class="relative min-h-screen bg-[#0f172a] text-white flex items-center justify-center py-24 px-4 overflow-hidden">
    {{-- Glow effects --}}
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-red-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-xl relative">
        {{-- TSCC Logo --}}
        <div class="flex justify-center mb-8">
            <img src="{{ asset('images/tscc-logo.png') }}" alt="TSCC Logo" class="h-24 md:h-32 object-contain drop-shadow-xl">
        </div>

        {{-- Card --}}
        <div class="bg-slate-900/60 backdrop-blur-xl border border-slate-800 rounded-3xl overflow-hidden shadow-2xl">
            
            {{-- Success Header --}}
            <div class="relative p-8 text-center border-b border-slate-800/80 bg-slate-900/40">
                @if($registration->status === 'waitlisted')
                    <div class="w-16 h-16 bg-amber-500/10 border border-amber-500/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2">Waitlist Joined!</h2>
                    <p class="text-sm text-slate-400">You're on the list. We'll notify you when tickets become available.</p>
                @else
                    <div class="w-16 h-16 bg-emerald-500/10 border border-emerald-500/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight text-white mb-2">Registration Confirmed!</h2>
                    <p class="text-sm text-slate-400">Thank you, your ticket for the event is ready.</p>
                @endif
            </div>
            
            <div class="p-8 space-y-6">
                @if(session('success'))
                    <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm text-center font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Ticket Info Badge --}}
                <div class="bg-slate-950/40 border border-slate-800 rounded-2xl p-6 text-center space-y-2">
                    <span class="text-xs font-semibold text-slate-500 uppercase tracking-widest">
                        {{ $registration->status === 'waitlisted' ? 'Waitlist Reference' : 'Registration Number' }}
                    </span>
                    <p class="text-3xl font-extrabold text-red-500 font-mono tracking-widest">{{ $registration->registration_number }}</p>
                </div>

                {{-- Info Rows --}}
                <div class="bg-slate-950/20 border border-slate-800/60 rounded-2xl p-6 space-y-4 text-sm">
                    <div class="flex justify-between items-center py-1 border-b border-slate-800/40">
                        <span class="text-slate-400 font-medium">Attendee</span>
                        <span class="font-semibold text-white">{{ $registration->full_name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1 border-b border-slate-800/40">
                        <span class="text-slate-400 font-medium">Status</span>
                        <span class="font-semibold {{ $registration->status === 'waitlisted' ? 'text-amber-400' : 'text-emerald-400' }}">
                            {{ ucfirst($registration->status) }}
                        </span>
                    </div>
                    @if($registration->ticketType)
                    <div class="flex justify-between items-center py-1 border-b border-slate-800/40">
                        <span class="text-slate-400 font-medium">Ticket Type</span>
                        <span class="font-semibold text-white">{{ $registration->ticketType->name }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between items-center py-1 border-b border-slate-800/40">
                        <span class="text-slate-400 font-medium">Date</span>
                        <span class="font-semibold text-white">{{ $event->event_date?->format('F d, Y') ?? 'TBA' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-1">
                        <span class="text-slate-400 font-medium">Venue</span>
                        <span class="font-semibold text-white text-right max-w-[240px] truncate">{{ $event->venue_name ?? 'TBA' }}</span>
                    </div>
                </div>

                @if($registration->status === 'waitlisted')
                    {{-- Waitlist info section --}}
                    <div class="bg-slate-950/40 border border-slate-800 rounded-2xl p-6 text-center space-y-3">
                        <svg class="w-10 h-10 text-amber-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <div class="space-y-1">
                            <p class="text-xs text-slate-355 font-medium text-slate-300">You are officially on the queue.</p>
                            <p class="text-[11px] text-slate-500">We will send updates regarding ticket releases to <span class="text-slate-300 font-mono">{{ $registration->email }}</span></p>
                        </div>
                    </div>
                @else
                    {{-- QR Code Section --}}
                    <div class="bg-slate-950/40 border border-slate-800 rounded-2xl p-6 text-center space-y-4">
                        <div class="inline-block p-4 bg-white rounded-2xl shadow-inner">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ urlencode($registration->registration_number) }}&color=0f172a&bgcolor=ffffff"
                                 alt="QR Code – {{ $registration->registration_number }}"
                                 class="w-36 h-36">
                        </div>
                        
                        <div class="space-y-1">
                            <p class="text-xs text-slate-400 font-medium">Scan code at the venue entrance to check in</p>
                            <p class="text-[11px] text-slate-500">We've also sent a copy of your ticket to <span class="text-slate-300 font-mono">{{ $registration->email }}</span></p>
                        </div>

                        @if($registration->payment_status == 'pending')
                            <div class="p-4 bg-amber-500/10 border border-amber-500/20 rounded-xl text-amber-400 text-xs text-left flex gap-3">
                                <svg class="w-5 h-5 flex-shrink-0 text-amber-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span><strong>Payment Pending:</strong> Your registration is confirmed but payment is required. You will receive an email with instructions shortly.</span>
                            </div>
                        @endif
                    </div>
                @endif


                {{-- Back button --}}
                <div class="text-center pt-2">
                    <a href="{{ route('event.show', $event->slug) }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-sm font-semibold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Event Page
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

