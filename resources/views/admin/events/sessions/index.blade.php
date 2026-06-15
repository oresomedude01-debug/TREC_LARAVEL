@extends('layouts.admin')

@section('title', 'Manage Programme - TREC')
@section('page-title', 'Manage Event: ' . $event->name)
@section('page-subtitle', '/tscc/' . $event->slug)

@section('action-button')
<div class="flex gap-3">
    <a href="{{ route('admin.events.sessions.create', $event) }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Session
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
    <a href="{{ route('admin.events.sessions.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-red-600 text-red-600 font-medium bg-white rounded-t-lg">
        Programme ({{ $event->sessions->count() }})
    </a>
    <a href="{{ route('admin.events.tickets.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
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
                <th class="px-6 py-4 font-medium w-32">Time</th>
                <th class="px-6 py-4 font-medium">Session Title</th>
                <th class="px-6 py-4 font-medium">Speaker</th>
                <th class="px-6 py-4 font-medium">Category</th>
                <th class="px-6 py-4 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($sessions as $session)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 text-slate-600 font-mono text-xs whitespace-nowrap">
                        @if($session->start_time && $session->end_time)
                            {{ \Carbon\Carbon::parse($session->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($session->end_time)->format('H:i') }}
                        @else
                            TBA
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 mb-1">{{ $session->title }}</div>
                        @if($session->venue_room)
                            <div class="text-xs text-slate-500 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $session->venue_room }}
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($session->speaker)
                            <div class="flex items-center gap-2">
                                @if($session->speaker->photo)
                                    <img src="{{ asset($session->speaker->photo) }}" class="w-6 h-6 rounded-full object-cover">
                                @else
                                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-xs text-slate-500">{{ substr($session->speaker->name, 0, 1) }}</div>
                                @endif
                                <span class="text-slate-700 font-medium">{{ $session->speaker->name }}</span>
                            </div>
                        @else
                            <span class="text-slate-400 italic">No speaker</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                            @if($session->category == 'keynote') bg-purple-100 text-purple-800
                            @elseif($session->category == 'break') bg-slate-100 text-slate-800
                            @elseif($session->category == 'networking') bg-green-100 text-green-800
                            @else bg-blue-100 text-blue-800 @endif
                        ">
                            {{ ucfirst($session->category) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.events.sessions.edit', [$event, $session]) }}" class="inline-flex items-center text-sm text-slate-600 hover:text-slate-900 font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.events.sessions.destroy', [$event, $session]) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this session?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        <p class="text-lg font-medium text-slate-900 mb-1">No sessions added yet</p>
                        <p class="mb-4">Build your event's agenda by adding sessions.</p>
                        <a href="{{ route('admin.events.sessions.create', $event) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Add Session
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
