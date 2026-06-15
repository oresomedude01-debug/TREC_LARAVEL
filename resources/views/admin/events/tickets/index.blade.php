@extends('layouts.admin')

@section('title', 'Manage Tickets - TREC')
@section('page-title', 'Manage Event: ' . $event->name)
@section('page-subtitle', '/tscc/' . $event->slug)

@section('action-button')
<div class="flex gap-3">
    <a href="{{ route('admin.events.tickets.create', $event) }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Ticket Type
    </a>
    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg font-medium transition-colors">
        Back to Events
    </a>
</div>
@endsection

@section('content')

<!-- Mini Nav Tabs -->
<div class="flex overflow-x-auto border-b border-slate-200 mb-6 pb-px hide-scrollbar">
    <a href="{{ route('admin.events.edit', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Event Details
    </a>
    <a href="{{ route('admin.events.speakers.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Speakers ({{ $event->speakers->count() }})
    </a>
    <a href="{{ route('admin.events.sessions.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Programme ({{ $event->sessions->count() }})
    </a>
    <a href="{{ route('admin.events.tickets.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-red-600 text-red-600 font-medium bg-white rounded-t-lg">
        Tickets ({{ $event->ticketTypes->count() }})
    </a>
    <a href="{{ route('admin.events.sponsors.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Sponsors ({{ $event->sponsors->count() }})
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm">
    <div class="overflow-x-auto rounded-xl">
        <table class="w-full text-left text-sm min-w-max">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500">
            <tr>
                <th class="px-6 py-4 font-medium">Ticket Name</th>
                <th class="px-6 py-4 font-medium">Price</th>
                <th class="px-6 py-4 font-medium">Sales Period</th>
                <th class="px-6 py-4 font-medium">Availability</th>
                <th class="px-6 py-4 font-medium">Status</th>
                <th class="px-6 py-4 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($tickets as $ticket)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 mb-1">{{ $ticket->name }}</div>
                        <div class="text-xs text-slate-500">
                            <span class="uppercase tracking-wider font-semibold text-slate-400">
                                {{ str_replace('_', ' ', $ticket->type) }}
                                @if($ticket->type === 'team' && $ticket->team_size)
                                    ({{ $ticket->team_size }} Members)
                                @endif
                            </span> 
                            &bull; {{ ucfirst($ticket->access_type) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium text-slate-900">
                        {{ $ticket->formatted_price }}
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-500">
                        @if($ticket->sales_start && $ticket->sales_end)
                            <div>{{ $ticket->sales_start->format('M d, g:i A') }}</div>
                            <div>to {{ $ticket->sales_end->format('M d, g:i A') }}</div>
                        @else
                            Always open
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-full bg-slate-200 rounded-full h-2 max-w-[100px]">
                                @if($ticket->quantity_available)
                                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ min(($ticket->quantity_sold / $ticket->quantity_available) * 100, 100) }}%"></div>
                                @else
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                                @endif
                            </div>
                            <span class="text-xs text-slate-600 font-medium">
                                {{ $ticket->quantity_sold }} / {{ $ticket->quantity_available ?? '∞' }}
                            </span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($ticket->status === 'inactive')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">Inactive</span>
                        @elseif($ticket->status === 'sold_out')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Sold Out</span>
                        @elseif($ticket->status === 'scheduled')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Scheduled</span>
                        @elseif($ticket->status === 'ended')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">Ended</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.events.tickets.edit', [$event, $ticket]) }}" class="inline-flex items-center text-sm text-slate-600 hover:text-slate-900 font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.events.tickets.destroy', [$event, $ticket]) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this ticket type?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium" {{ $ticket->quantity_sold > 0 ? 'disabled title="Cannot delete tickets that have been sold"' : '' }}>Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                        <p class="text-lg font-medium text-slate-900 mb-1">No ticket types added</p>
                        <p class="mb-4">Create ticket tiers to allow registrations.</p>
                        <a href="{{ route('admin.events.tickets.create', $event) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Add Ticket Type
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
