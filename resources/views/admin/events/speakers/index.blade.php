@extends('layouts.admin')

@section('title', 'Manage Speakers - TREC')
@section('page-title', 'Manage Event: ' . $event->name)
@section('page-subtitle', '/tscc/' . $event->slug)

@section('action-button')
<div class="flex gap-3">
    <a href="{{ route('admin.events.speakers.create', $event) }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add Speaker
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
    <a href="{{ route('admin.events.speakers.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-red-600 text-red-600 font-medium bg-white rounded-t-lg">
        Speakers ({{ $event->speakers->count() }})
    </a>
    <a href="{{ route('admin.events.sessions.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
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
                <th class="px-6 py-4 font-medium w-16">Photo</th>
                <th class="px-6 py-4 font-medium">Name & Title</th>
                <th class="px-6 py-4 font-medium">Organization</th>
                <th class="px-6 py-4 font-medium">Featured</th>
                <th class="px-6 py-4 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @forelse($speakers as $speaker)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        @if($speaker->photo)
                            <img src="{{ asset($speaker->photo) }}" alt="{{ $speaker->name }}" class="w-12 h-12 rounded-full object-cover border border-slate-200">
                        @else
                            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 border border-slate-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-900 mb-1">{{ $speaker->name }}</div>
                        <div class="text-xs text-slate-500">{{ $speaker->title }}</div>
                    </td>
                    <td class="px-6 py-4 text-slate-500">
                        {{ $speaker->organization ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($speaker->is_featured)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Featured
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                Standard
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.events.speakers.edit', [$event, $speaker]) }}" class="inline-flex items-center text-sm text-slate-600 hover:text-slate-900 font-medium">
                            Edit
                        </a>
                        <form action="{{ route('admin.events.speakers.destroy', [$event, $speaker]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this speaker?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        <p class="text-lg font-medium text-slate-900 mb-1">No speakers added yet</p>
                        <p class="mb-4">Add speakers who will be presenting at this event.</p>
                        <a href="{{ route('admin.events.speakers.create', $event) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Add Speaker
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </div>
</div>
@endsection
