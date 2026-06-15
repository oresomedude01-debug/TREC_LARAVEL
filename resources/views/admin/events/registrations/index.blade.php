@extends('layouts.admin')

@section('title', 'Manage Registrations - TREC')
@section('page-title', 'Registrations: ' . $event->name)
@section('page-subtitle', '/tscc/' . $event->slug)

@section('action-button')
<div class="flex gap-3">
    <a href="{{ route('admin.events.waitlist.index', $event) }}" class="inline-flex items-center gap-2 bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
        </svg>
        Waitlist
    </a>
    <a href="{{ route('admin.events.registrations.export', $event) }}" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        Export CSV
    </a>
    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg font-medium transition-colors">
        Back to Events
    </a>
</div>
@endsection

@section('content')

<!-- Navigation Tabs -->
<div class="flex overflow-x-auto border-b border-slate-200 mb-6 pb-px hide-scrollbar snap-x">
    <a href="{{ route('admin.events.registrations.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-red-600 text-red-600 font-medium">
        Registrations
    </a>
    <a href="{{ route('admin.events.waitlist.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Waitlist
    </a>
    <a href="{{ route('admin.events.checkin.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Check-in
    </a>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Total</p>
            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['total']) }}</p>
        </div>
        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Confirmed</p>
            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['confirmed']) }}</p>
        </div>
        <div class="p-3 bg-green-50 text-green-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Checked In</p>
            <p class="text-2xl font-bold text-slate-900">{{ number_format($stats['checked_in']) }}</p>
        </div>
        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </div>
    </div>
    <div class="bg-white rounded-xl border border-slate-200 p-4 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">Revenue</p>
            <p class="text-2xl font-bold text-slate-900">₦{{ number_format($stats['revenue'], 2) }}</p>
        </div>
        <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm">
    <!-- Filters & Search -->
    <div class="p-4 border-b border-slate-200 bg-slate-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <form action="{{ route('admin.events.registrations.index', $event) }}" method="GET" class="flex-1 max-w-md">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or Reg ID..." class="w-full pl-10 pr-4 py-2 rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </form>
        
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('admin.events.checkin.index', $event) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Check-in Desk
            </a>
        </div>
    </div>

    <table class="w-full text-left text-sm">
        <thead class="bg-slate-50 border-b border-slate-200 text-slate-500">
            <tr>
                <th class="px-6 py-4 font-medium">Attendee</th>
                <th class="px-6 py-4 font-medium">Ticket Type</th>
                <th class="px-6 py-4 font-medium">Status / Payment</th>
                <th class="px-6 py-4 font-medium">Check-in</th>
                <th class="px-6 py-4 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($registrations as $reg)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 mb-1">{{ $reg->full_name }}</div>
                        <div class="text-xs text-slate-500">{{ $reg->email }}</div>
                        <div class="text-xs font-mono text-slate-400 mt-1">{{ $reg->registration_number }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-900">{{ $reg->ticketType->name ?? 'N/A' }}</div>
                        <div class="text-xs text-slate-500">₦{{ number_format($reg->amount_paid, 2) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="mb-1">
                            @if($reg->status == 'confirmed')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Confirmed</span>
                            @elseif($reg->status == 'cancelled')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Cancelled</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">{{ ucfirst($reg->status) }}</span>
                            @endif
                        </div>
                        <div>
                            @if($reg->payment_status == 'paid')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">Paid</span>
                            @elseif($reg->payment_status == 'free')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-600">Free</span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">Pending</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($reg->checked_in)
                            <div class="flex items-center gap-1 text-green-600 font-medium text-xs">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Checked In
                            </div>
                            <div class="text-[10px] text-slate-400 mt-1">{{ $reg->checked_in_at->format('M d, g:i A') }}</div>
                        @else
                            <span class="text-slate-400 text-xs">Not arrived</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.events.registrations.show', [$event, $reg]) }}" class="inline-flex items-center justify-center px-3 py-1.5 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 transition-colors">
                            View Details
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        @if(request('search'))
                            <p class="text-lg font-medium text-slate-900 mb-1">No registrations found matching "{{ request('search') }}"</p>
                            <a href="{{ route('admin.events.registrations.index', $event) }}" class="text-red-600 hover:underline">Clear search</a>
                        @else
                            <p class="text-lg font-medium text-slate-900 mb-1">No registrations yet</p>
                            <p class="mb-4">Share your event link to start collecting registrations.</p>
                            <a href="{{ $event->public_url }}" target="_blank" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                View Event Page
                            </a>
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
    
    @if($registrations->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $registrations->links() }}
        </div>
    @endif
</div>
@endsection
