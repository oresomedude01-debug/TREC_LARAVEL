@extends('layouts.admin')

@section('title', 'Edit Event - TREC')
@section('page-title', 'Manage Event: ' . $event->name)
@section('page-subtitle', '/tscc/' . $event->slug)

@section('action-button')
<div class="flex gap-3">
    <a href="{{ $event->public_url }}" target="_blank" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors">
        View Public Page
    </a>
    <a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg font-medium transition-colors">
        Back to Events
    </a>
</div>
@endsection

@section('content')

<!-- Mini Nav Tabs -->
<div class="flex overflow-x-auto border-b border-slate-200 mb-6 pb-px hide-scrollbar snap-x">
    <a href="{{ route('admin.events.edit', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-red-600 text-red-600 font-medium bg-white rounded-t-lg">
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
    <a href="{{ route('admin.events.sponsors.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Sponsors ({{ $event->sponsors->count() }})
    </a>
    <a href="{{ route('admin.events.registrations.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Registrations
    </a>
    <a href="{{ route('admin.events.waitlist.index', $event) }}" class="flex-none whitespace-nowrap px-6 py-3 border-b-2 border-transparent text-slate-500 hover:text-slate-700 font-medium">
        Waitlist
    </a>
</div>

<div class="max-w-4xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-200">
            @csrf
            @method('PUT')

            <!-- Basic Info -->
            <div class="p-6 md:p-8 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Basic Information</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Event Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}" required class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div>
                        <label for="theme" class="block text-sm font-medium text-slate-700 mb-1">Theme</label>
                        <input type="text" name="theme" id="theme" value="{{ old('theme', $event->theme) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-semibold text-slate-700 mb-1">URL Slug <span class="text-red-500">*</span></label>
                        <div class="input-group">
                            <span class="input-group-prefix">/tscc/</span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $event->slug) }}" required>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="status" class="block text-sm font-medium text-slate-700 mb-1">Event Status</label>
                        <select name="status" id="status" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                            <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                            <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published (Visible, No Registration)</option>
                            <option value="registration_open" {{ old('status', $event->status) == 'registration_open' ? 'selected' : '' }}>Registration Open</option>
                            <option value="registration_closed" {{ old('status', $event->status) == 'registration_closed' ? 'selected' : '' }}>Registration Closed</option>
                            <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed (Past Event)</option>
                            <option value="archived" {{ old('status', $event->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Date & Location -->
            <div class="p-6 md:p-8 space-y-6 bg-slate-50">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Date & Location</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div>
                        <label for="event_date" class="block text-sm font-medium text-slate-700 mb-1">Start Date</label>
                        <input type="date" name="event_date" id="event_date" value="{{ old('event_date', $event->event_date?->format('Y-m-d')) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-slate-700 mb-1">End Date <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $event->end_date?->format('Y-m-d')) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-slate-700 mb-1">Start Time</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $event->start_time ? substr($event->start_time, 0, 5) : '') }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-slate-700 mb-1">End Time</label>
                        <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $event->end_time ? substr($event->end_time, 0, 5) : '') }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    {{-- ─── Multi-Venue Repeater ─── --}}
                    <div class="md:col-span-4" id="venues-wrapper">
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-semibold text-slate-700">Venues</label>
                            <button type="button" id="add-venue-btn"
                                class="inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 hover:text-red-800 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Add Another Venue
                            </button>
                        </div>

                        <div id="venues-list" class="space-y-4">
                            @php
                                $venues = old('venues', $event->venues);
                                if (empty($venues) && $event->venue_name) {
                                    $venues = [['name' => $event->venue_name, 'address' => $event->venue_address, 'maps_url' => $event->google_maps_url]];
                                }
                                if (empty($venues)) {
                                    $venues = [['name' => '', 'address' => '', 'maps_url' => '']];
                                }
                            @endphp
                            
                            @foreach($venues as $index => $venue)
                            <div class="venue-row border border-slate-200 rounded-xl p-4 bg-white relative">
                                <button type="button" class="remove-venue absolute top-3 right-3 text-slate-400 hover:text-red-500 transition-colors {{ $index === 0 && count($venues) === 1 ? 'hidden' : '' }}">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="md:col-span-3">
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Venue Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="venues[{{ $index }}][name]" placeholder="e.g. Eko Convention Center" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm" value="{{ $venue['name'] ?? '' }}">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Address</label>
                                        <input type="text" name="venues[{{ $index }}][address]" placeholder="e.g. Victoria Island, Lagos" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm" value="{{ $venue['address'] ?? '' }}">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Google Maps URL</label>
                                        <input type="url" name="venues[{{ $index }}][maps_url]" placeholder="https://maps.google.com/..." class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm" value="{{ $venue['maps_url'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="p-6 md:p-8 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Description</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="short_description" class="block text-sm font-medium text-slate-700 mb-1">Short Description (Summary)</label>
                        <textarea name="short_description" id="short_description" rows="3" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">{{ old('short_description', $event->short_description) }}</textarea>
                    </div>
                    
                    <div>
                        <label for="full_description" class="block text-sm font-medium text-slate-700 mb-1">Full Description (HTML allowed)</label>
                        <textarea name="full_description" id="full_description" rows="6" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">{{ old('full_description', $event->full_description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Branding -->
            <div class="p-6 md:p-8 space-y-6 bg-slate-50">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Branding & Media</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Banner Image</label>
                        @if($event->banner_image)
                            <div class="mb-3 relative group">
                                <img src="{{ asset($event->banner_image) }}" alt="Banner" class="h-32 w-full object-cover rounded-lg border border-slate-200">
                                <div class="absolute inset-0 bg-black/40 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-sm font-medium">Replace image below</span>
                                </div>
                            </div>
                        @endif
                        <div class="file-drop-zone" id="banner-drop-zone">
                            <svg class="drop-icon w-8 h-8 text-slate-400 mb-1 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm font-semibold text-slate-600">{{ $event->banner_image ? 'Click or drag to replace' : 'Click or drag banner here' }}</p>
                            <p class="form-hint">PNG, JPG, WEBP — recommended 1200×630px</p>
                            <p id="banner-file-name" class="text-xs font-semibold text-red-600 mt-1 hidden"></p>
                            <input type="file" name="banner_image" id="banner_image" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8 flex items-center justify-between">
                <button type="button" onclick="if(confirm('Are you sure you want to delete this event? This action cannot be undone.')) { document.getElementById('delete-form').submit(); }" class="btn btn-danger-ghost">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Delete Event
                </button>
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Save Changes
                </button>
            </div>
        </form>

        <form id="delete-form" action="{{ route('admin.events.destroy', $event) }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
    let venueIndex = {{ count($venues ?? []) > 0 ? count($venues) - 1 : 0 }};
    document.getElementById('add-venue-btn').addEventListener('click', function() {
        venueIndex++;
        const list = document.getElementById('venues-list');
        const newRow = document.createElement('div');
        newRow.className = 'venue-row border border-slate-200 rounded-xl p-4 bg-white relative mt-4';
        newRow.innerHTML = `
            <button type="button" class="remove-venue absolute top-3 right-3 text-slate-400 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-3">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Venue Name <span class="text-red-500">*</span></label>
                    <input type="text" name="venues[${venueIndex}][name]" placeholder="e.g. Eko Convention Center" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Address</label>
                    <input type="text" name="venues[${venueIndex}][address]" placeholder="e.g. Victoria Island, Lagos" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Google Maps URL</label>
                    <input type="url" name="venues[${venueIndex}][maps_url]" placeholder="https://maps.google.com/..." class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                </div>
            </div>
        `;
        list.appendChild(newRow);
        
        // Add remove listener
        newRow.querySelector('.remove-venue').addEventListener('click', function() {
            newRow.remove();
        });
        
        // Show all remove buttons since there's >1
        document.querySelectorAll('.remove-venue').forEach(btn => btn.classList.remove('hidden'));
    });

    document.querySelectorAll('.remove-venue').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.venue-row').remove();
            const remaining = document.querySelectorAll('.venue-row');
            if (remaining.length === 1) {
                remaining[0].querySelector('.remove-venue').classList.add('hidden');
            }
        });
    });
</script>
@endsection
