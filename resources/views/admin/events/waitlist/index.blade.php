@extends('layouts.admin')

@section('title', 'Event Waitlist - TREC')
@section('page-title', 'Waitlist: ' . $event->name)
@section('page-subtitle', 'Manage and notify users waiting for tickets')

@section('action-button')
<a href="{{ route('admin.events.registrations.index', $event) }}" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg font-medium transition-colors">
    Back to Registrations
</a>
@endsection

@section('content')

<!-- Navigation Tabs -->
<div class="flex overflow-x-auto border-b border-slate-200 mb-6 pb-px hide-scrollbar snap-x">
    <a href="{{ route('admin.events.registrations.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Registrations
    </a>
    <a href="{{ route('admin.events.waitlist.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-amber-600 text-amber-600 font-medium">
        Waitlist
    </a>
    <a href="{{ route('admin.events.checkin.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Check-in
    </a>
</div>

<div class="space-y-6">
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
            <p class="text-slate-600 text-sm font-medium mb-1">Total Waitlisted</p>
            <p class="text-3xl font-bold text-slate-900">{{ $stats['total'] }}</p>
            <p class="text-xs text-slate-500 mt-2">waiting for tickets</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
            <p class="text-slate-600 text-sm font-medium mb-1">Pending Notification</p>
            <p class="text-3xl font-bold text-amber-600">{{ $stats['pending'] }}</p>
            <p class="text-xs text-slate-500 mt-2">not yet notified</p>
        </div>
        <div class="bg-white rounded-lg border border-slate-200 p-6 shadow-sm">
            <p class="text-slate-600 text-sm font-medium mb-1">Already Notified</p>
            <p class="text-3xl font-bold text-green-600">{{ $stats['notified'] }}</p>
            <p class="text-xs text-slate-500 mt-2">of ticket availability</p>
        </div>
    </div>

    {{-- Send Notifications Form --}}
    @if($stats['pending'] > 0)
    <div class="bg-gradient-to-r from-amber-50 to-amber-100/50 border border-amber-200 rounded-lg p-6 shadow-sm">
        <div class="flex items-start justify-between gap-4">
            <div class="flex-1">
                <h3 class="font-bold text-amber-900 mb-1">Send Notifications to Waitlist</h3>
                <p class="text-amber-800 text-sm mb-4">Select a ticket type and notify all waitlisted users that tickets are now available.</p>
                
                <form action="{{ route('admin.events.waitlist.notify', $event) }}" method="POST" class="flex gap-3">
                    @csrf
                    <select name="ticket_type_id" required class="flex-1 rounded-lg border border-amber-300 bg-white px-4 py-2 text-sm focus:border-amber-500 focus:ring-amber-500">
                        <option value="">Select ticket type to notify for...</option>
                        @foreach($ticketTypes as $ticket)
                        <option value="{{ $ticket->id }}" @if($ticket->is_on_sale) selected @endif>
                            {{ $ticket->name }} ({{ $ticket->is_on_sale ? '✓ On Sale' : 'Not on sale' }})
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg font-medium transition-colors flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        Send Notifications
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- Filters --}}
    <div class="bg-white rounded-lg border border-slate-200 p-5 shadow-sm">
        <form action="{{ route('admin.events.waitlist.index', $event) }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, email, number..." class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-2">Ticket Type</label>
                <select name="ticket_type_id" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">All Tickets</option>
                    @foreach($ticketTypes as $ticket)
                    <option value="{{ $ticket->id }}" @if(request('ticket_type_id') == $ticket->id) selected @endif>{{ $ticket->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-2">Notification Status</label>
                <select name="notified_status" class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">All</option>
                    <option value="pending" @if(request('notified_status') === 'pending') selected @endif>Pending</option>
                    <option value="notified" @if(request('notified_status') === 'notified') selected @endif>Notified</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Waitlist Table --}}
    <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 font-semibold text-slate-900">Name</th>
                    <th class="px-6 py-3 font-semibold text-slate-900">Email</th>
                    <th class="px-6 py-3 font-semibold text-slate-900">Ticket Type</th>
                    <th class="px-6 py-3 font-semibold text-slate-900">Registration #</th>
                    <th class="px-6 py-3 font-semibold text-slate-900">Joined</th>
                    <th class="px-6 py-3 font-semibold text-slate-900">Notified</th>
                    <th class="px-6 py-3 font-semibold text-slate-900">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($waitlisters as $registration)
                <tr class="hover:bg-slate-50">
                    <td class="px-6 py-4">
                        <p class="font-medium text-slate-900">{{ $registration->full_name }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-slate-600 text-xs font-mono">{{ $registration->email }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $registration->ticketType?->name ?? 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-slate-600 text-xs font-mono">{{ $registration->registration_number }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-slate-600 text-xs">{{ $registration->created_at->format('M d, Y') }}</p>
                    </td>
                    <td class="px-6 py-4">
                        @if($registration->waitlist_notified_at)
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                            <p class="text-xs text-green-700 font-medium">{{ $registration->waitlist_notified_at->format('M d, h:i A') }}</p>
                        </div>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                            Pending
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.events.waitlist.remove', [$event, $registration]) }}" method="POST" class="inline" onsubmit="return confirm('Remove from waitlist?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 font-medium text-xs">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                        <svg class="w-16 h-16 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                        <p class="text-sm mb-1">No waitlist entries found</p>
                        <p class="text-xs text-slate-400">There are no waitlisted users matching your filters.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50">
            {{ $waitlisters->links() }}
        </div>
    </div>
</div>
@endsection
