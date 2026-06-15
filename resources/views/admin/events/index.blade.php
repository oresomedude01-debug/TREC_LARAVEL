@extends('layouts.admin')

@section('title', 'All Events - TREC')
@section('page-title', 'All Events')

@section('action-button')
<a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
    </svg>
    Create Event
</a>
@endsection

@section('content')
<div class="bg-white rounded-xl border border-slate-200 shadow-sm">
    <div class="overflow-x-auto rounded-xl">
        <table class="w-full text-left text-sm min-w-max">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500">
            <tr>
                <th class="px-6 py-4 font-medium">Event Name</th>
                <th class="px-6 py-4 font-medium">Date & Location</th>
                <th class="px-6 py-4 font-medium">Status</th>
                <th class="px-6 py-4 font-medium">Registrations</th>
                <th class="px-6 py-4 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($events as $event)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 mb-1">{{ $event->name }}</div>
                        <div class="text-xs text-slate-500 font-mono">/tscc/{{ $event->slug }}</div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            @if(!empty($event->dates) && count($event->dates) > 0)
                                {{ collect($event->dates)->map(fn($d) => \Carbon\Carbon::parse($d['date'])->format('M d, Y'))->join(', ') }}
                            @else
                                {{ $event->event_date?->format('M d, Y') ?? 'TBA' }}
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            @if(!empty($event->venues) && count($event->venues) > 0)
                                {{ Str::limit(collect($event->venues)->pluck('name')->join(', '), 20) }}
                            @else
                                {{ Str::limit($event->venue_name ?? 'TBA', 20) }}
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $event->status_badge_color }}-100 text-{{ $event->status_badge_color }}-800">
                            {{ str_replace('_', ' ', Str::title($event->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-slate-900">{{ number_format($event->registrations_count) }}</div>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.events.registrations.index', $event) }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800 font-medium">
                            Registrations
                        </a>
                        <span class="text-slate-300">|</span>
                        <a href="{{ route('admin.events.checkin.index', $event) }}" class="inline-flex items-center gap-1 text-sm text-green-600 hover:text-green-800 font-medium">
                            Check-in
                        </a>
                        <span class="text-slate-300">|</span>
                        <a href="{{ route('admin.events.edit', $event) }}" class="inline-flex items-center gap-1 text-sm text-slate-600 hover:text-slate-900 font-medium">
                            Manage
                        </a>
                        <span class="text-slate-300">|</span>
                        <a href="{{ $event->public_url }}" target="_blank" class="inline-flex items-center gap-1 text-sm text-slate-500 hover:text-slate-700 font-medium">
                            View Page
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        <svg class="w-12 h-12 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-lg font-medium text-slate-900 mb-1">No events found</p>
                        <p class="mb-4">Get started by creating your first event.</p>
                        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Create Event
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
    
    @if($events->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $events->links() }}
        </div>
    @endif
</div>
@endsection
