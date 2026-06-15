@extends('layouts.admin')

@section('title', 'Events Dashboard - TREC')
@section('page-title', 'Events Dashboard')
@section('page-subtitle', 'Overview of your events and registrations.')

@section('action-button')
<a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
    </svg>
    Create Event
</a>
@endsection

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 font-medium text-sm">Total Events</h3>
            <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ $stats['total_events'] }}</div>
        <div class="text-sm text-slate-500 mt-2">{{ $stats['upcoming_events'] }} upcoming</div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 font-medium text-sm">Active Registrations</h3>
            <div class="p-2 bg-green-50 rounded-lg text-green-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ number_format($stats['active_registrations']) }}</div>
        <div class="text-sm text-slate-500 mt-2">{{ number_format($stats['checkins']) }} checked in</div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 font-medium text-sm">Tickets Sold</h3>
            <div class="p-2 bg-purple-50 rounded-lg text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">{{ number_format($stats['tickets_sold']) }}</div>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 font-medium text-sm">Total Revenue</h3>
            <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-slate-900">₦{{ number_format($stats['revenue'], 2) }}</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Active Events -->
    <div class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900">Active Events</h2>
            <a href="{{ route('admin.events.index') }}" class="text-sm font-medium text-red-600 hover:text-red-700">View All &rarr;</a>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="overflow-x-auto rounded-xl">
                <table class="w-full text-left text-sm min-w-max">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500">
                    <tr>
                        <th class="px-6 py-3 font-medium">Event</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium text-right">Registrations</th>
                        <th class="px-6 py-3 font-medium text-right">Revenue</th>
                        <th class="px-6 py-3 font-medium text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($activeEvents as $event)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-medium text-slate-900">{{ $event->name }}</div>
                                <div class="text-slate-500 text-xs mt-1">{{ $event->event_date?->format('M d, Y') ?? 'TBA' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $event->status_badge_color }}-100 text-{{ $event->status_badge_color }}-800">
                                    {{ str_replace('_', ' ', Str::title($event->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="font-medium">{{ number_format($event->registrations_count) }}</div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="font-medium">₦{{ number_format($event->revenue, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.events.edit', $event) }}" class="text-slate-400 hover:text-slate-600">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                No active events found. <a href="{{ route('admin.events.create') }}" class="text-red-600 font-medium">Create your first event</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="space-y-6">
        <h2 class="text-lg font-bold text-slate-900">Recent Registrations</h2>
        
        <div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
            <div class="space-y-6">
                @forelse($recentActivity as $activity)
                    <div class="flex gap-4">
                        <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0 font-bold text-xs">
                            {{ substr($activity->first_name, 0, 1) }}{{ substr($activity->last_name, 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm text-slate-900 font-medium">
                                {{ $activity->full_name }} <span class="text-slate-500 font-normal">registered for</span> {{ $activity->event->slug }}
                            </p>
                            <p class="text-xs text-slate-500 mt-1">{{ $activity->created_at->diffForHumans() }} &bull; {{ $activity->ticketType?->name ?? 'Free Ticket' }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 text-center py-4">No recent activity.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
