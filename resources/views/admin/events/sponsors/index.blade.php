@extends('layouts.admin')

@section('title', 'Manage Sponsors - TREC')
@section('page-title', 'Manage Event: ' . $event->name)
@section('page-subtitle', '/tscc/' . $event->slug)

@section('action-button')
<div class="flex gap-3">
    <a href="{{ route('admin.events.sponsors.create', $event) }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Sponsor
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
    <a href="{{ route('admin.events.tickets.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Tickets ({{ $event->ticketTypes->count() }})
    </a>
    <a href="{{ route('admin.events.sponsors.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-red-600 text-red-600 font-medium bg-white rounded-t-lg">
        Sponsors ({{ $event->sponsors->count() }})
    </a>
</div>

<div class="bg-white rounded-xl border border-slate-200 shadow-sm">
    <div class="overflow-x-auto rounded-xl">
        <table class="w-full text-left text-sm min-w-max">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500">
            <tr>
                <th class="px-6 py-4 font-medium w-24">Logo</th>
                <th class="px-6 py-4 font-medium">Sponsor Name</th>
                <th class="px-6 py-4 font-medium">Tier</th>
                <th class="px-6 py-4 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($sponsors as $sponsor)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        @if($sponsor->logo)
                            <div class="w-16 h-12 bg-white rounded border border-slate-200 p-1 flex items-center justify-center">
                                <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}" class="max-w-full max-h-full object-contain">
                            </div>
                        @else
                            <div class="w-16 h-12 bg-slate-100 rounded border border-slate-200 flex items-center justify-center text-slate-400">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900">{{ $sponsor->name }}</div>
                        @if($sponsor->website_url)
                            <a href="{{ $sponsor->website_url }}" target="_blank" class="text-xs text-blue-600 hover:underline">{{ parse_url($sponsor->website_url, PHP_URL_HOST) }}</a>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            @if($sponsor->tier == 'platinum') bg-slate-800 text-slate-100
                            @elseif($sponsor->tier == 'gold') bg-yellow-100 text-yellow-800
                            @elseif($sponsor->tier == 'silver') bg-slate-200 text-slate-800
                            @elseif($sponsor->tier == 'bronze') bg-orange-100 text-orange-800
                            @else bg-blue-100 text-blue-800 @endif
                        ">
                            {{ ucfirst($sponsor->tier) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.events.sponsors.edit', [$event, $sponsor]) }}" class="inline-flex items-center text-sm text-slate-600 hover:text-slate-900 font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.events.sponsors.destroy', [$event, $sponsor]) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this sponsor?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                        <p class="text-lg font-medium text-slate-900 mb-1">No sponsors added yet</p>
                        <p class="mb-4">Add companies or organizations sponsoring this event.</p>
                        <a href="{{ route('admin.events.sponsors.create', $event) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Add Sponsor
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
