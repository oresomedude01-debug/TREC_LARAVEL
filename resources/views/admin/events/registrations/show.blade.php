@extends('layouts.admin')

@section('title', 'Registration Details - TREC')
@section('page-title', 'Registration: ' . $registration->registration_number)
@section('page-subtitle', $registration->full_name . ' - ' . $event->name)

@section('action-button')
<a href="{{ route('admin.events.registrations.index', $event) }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    Back to List
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Details Column -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Attendee Profile -->
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-200 bg-slate-50 flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-xl font-bold">
                    {{ substr($registration->first_name, 0, 1) }}{{ substr($registration->last_name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900">{{ $registration->full_name }}</h2>
                    <p class="text-slate-500">{{ $registration->email }}</p>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Phone</p>
                        <p class="text-slate-900 font-medium">{{ $registration->phone ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Organization</p>
                        <p class="text-slate-900 font-medium">{{ $registration->organization ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Profession / Role</p>
                        <p class="text-slate-900 font-medium">{{ $registration->profession ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Registration Date</p>
                        <p class="text-slate-900 font-medium">{{ $registration->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Check-in Status Panel -->
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Check-In Status</h3>
            </div>
            <div class="p-6 flex items-center justify-between">
                <div>
                    @if($registration->checked_in)
                        <div class="flex items-center gap-2 text-green-600 mb-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-bold text-lg">Checked In</span>
                        </div>
                        <p class="text-sm text-slate-500">
                            Arrived at {{ $registration->checked_in_at->format('M d, Y h:i A') }}
                            @if($registration->checker)
                                (Scanned by {{ $registration->checker->name }})
                            @endif
                        </p>
                    @else
                        <div class="flex items-center gap-2 text-slate-400 mb-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-bold text-lg text-slate-600">Not Checked In</span>
                        </div>
                        <p class="text-sm text-slate-500">Attendee has not yet arrived.</p>
                    @endif
                </div>

                @if(!$registration->checked_in && $registration->status == 'confirmed')
                    <form action="{{ route('admin.events.checkin.manual', [$event, $registration]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm">
                            Manual Check-In
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar Column -->
    <div class="space-y-6">
        <!-- Ticket Details -->
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Ticket & Payment</h3>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Ticket Type</p>
                    <p class="font-bold text-slate-900">{{ $registration->ticketType->name ?? 'Standard' }}</p>
                </div>
                
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Amount Paid</p>
                    <p class="font-medium text-slate-900">₦{{ number_format($registration->amount_paid, 2) }}</p>
                </div>

                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Payment Status</p>
                    @if($registration->payment_status == 'paid')
                        <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-bold bg-green-100 text-green-800 uppercase tracking-wide">Paid</span>
                    @elseif($registration->payment_status == 'free')
                        <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-bold bg-slate-100 text-slate-600 uppercase tracking-wide">Free</span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-bold bg-yellow-100 text-yellow-800 uppercase tracking-wide">Pending</span>
                    @endif
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2">Registration Status</p>
                    
                    <form action="{{ route('admin.events.registrations.status', [$event, $registration]) }}" method="POST" class="flex gap-2">
                        @csrf
                        <select name="status" class="flex-1 rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                            <option value="confirmed" {{ $registration->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="waitlisted" {{ $registration->status == 'waitlisted' ? 'selected' : '' }}>Waitlisted</option>
                            <option value="cancelled" {{ $registration->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-2 rounded-lg font-medium transition-colors text-sm border border-slate-200">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Marketing Data -->
        @if($registration->utm_source || $registration->ref_code)
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Tracking Data</h3>
            </div>
            <div class="p-6 space-y-4">
                @if($registration->utm_source)
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">UTM Source</p>
                        <p class="font-medium text-slate-900">{{ $registration->utm_source }}</p>
                    </div>
                @endif
                @if($registration->utm_medium)
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">UTM Medium</p>
                        <p class="font-medium text-slate-900">{{ $registration->utm_medium }}</p>
                    </div>
                @endif
                @if($registration->utm_campaign)
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">UTM Campaign</p>
                        <p class="font-medium text-slate-900">{{ $registration->utm_campaign }}</p>
                    </div>
                @endif
                @if($registration->ref_code)
                    <div>
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Referral Code</p>
                        <p class="font-mono text-slate-900 bg-slate-50 p-1 rounded inline-block">{{ $registration->ref_code }}</p>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
