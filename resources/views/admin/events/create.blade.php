@extends('layouts.admin')

@section('title', 'Create Event - TREC')
@section('page-title', 'Create New Event')

@section('action-button')
<a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors">
    Cancel
</a>
@endsection

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-200">
            @csrf

            <!-- Basic Info -->
            <div class="p-6 md:p-8 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Basic Information</h3>
                    <p class="text-sm text-slate-500">The core details of your event.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Event Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. TSCC 2026">
                    </div>

                    <div>
                        <label for="theme" class="block text-sm font-semibold text-slate-700 mb-1">Theme</label>
                        <input type="text" name="theme" id="theme" value="{{ old('theme') }}" placeholder="e.g. Bridging the Gap">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-semibold text-slate-700 mb-1">URL Slug <span class="text-red-500">*</span></label>
                        <div class="input-group">
                            <span class="input-group-prefix">/tscc/</span>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required placeholder="2026">
                        </div>
                        <p class="form-hint">Auto-generated from the event name.</p>
                    </div>

                    <div class="md:col-span-2">
                        <label for="status" class="block text-sm font-semibold text-slate-700 mb-1">Initial Status</label>
                        <select name="status" id="status">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Visible, No Registration)</option>
                            <option value="registration_open" {{ old('status') == 'registration_open' ? 'selected' : '' }}>Registration Open</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Date & Location -->
            <div class="p-6 md:p-8 space-y-6 bg-slate-50">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Date & Location</h3>
                    <p class="text-sm text-slate-500">When and where is this happening?</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    {{-- ─── Multi-Date Repeater ─── --}}
                    <div class="md:col-span-4" id="dates-wrapper">
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-semibold text-slate-700">Dates</label>
                            <button type="button" id="add-date-btn"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Add Another Date
                            </button>
                        </div>
                        <div id="dates-list">
                            @php
                                $oldDates = old('dates', [['date' => old('event_date', ''), 'start_time' => old('start_time', ''), 'end_time' => old('end_time', '')]]);
                            @endphp
                            @foreach($oldDates as $index => $dt)
                            <div class="date-row border border-slate-200 rounded-xl p-4 bg-slate-50/50 relative mb-4">
                                @if($index > 0)
                                <button type="button" class="remove-date absolute top-3 right-3 text-slate-400 hover:text-red-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                @endif
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Date <span class="text-red-500">*</span></label>
                                        <input type="date" name="dates[{{$index}}][date]" value="{{ $dt['date'] ?? '' }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Start Time</label>
                                        <input type="time" name="dates[{{$index}}][start_time]" value="{{ $dt['start_time'] ?? '' }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">End Time</label>
                                        <input type="time" name="dates[{{$index}}][end_time]" value="{{ $dt['end_time'] ?? '' }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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
                            {{-- starter row --}}
                            <div class="venue-row border border-slate-200 rounded-xl p-4 bg-white relative">
                                <button type="button" class="remove-venue absolute top-3 right-3 text-slate-400 hover:text-red-500 transition-colors hidden">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="md:col-span-3">
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Venue Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="venues[0][name]" placeholder="e.g. Eko Convention Center" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm" value="{{ old('venues.0.name') }}">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Address</label>
                                        <input type="text" name="venues[0][address]" placeholder="e.g. Victoria Island, Lagos" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm" value="{{ old('venues.0.address') }}">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-600 mb-1">Google Maps URL</label>
                                        <input type="url" name="venues[0][maps_url]" placeholder="https://maps.google.com/..." class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm" value="{{ old('venues.0.maps_url') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="p-6 md:p-8 space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Description & Content</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="short_description" class="block text-sm font-semibold text-slate-700 mb-1">Short Description <span class="text-slate-400 font-normal">(Summary)</span></label>
                        <textarea name="short_description" id="short_description" rows="3">{{ old('short_description') }}</textarea>
                    </div>
                    
                    <div>
                        <label for="full_description" class="block text-sm font-semibold text-slate-700 mb-1">Full Description <span class="text-slate-400 font-normal">(HTML allowed)</span></label>
                        <textarea name="full_description" id="full_description" rows="6">{{ old('full_description') }}</textarea>
                    </div>

                    <div>
                        <label for="target_audience" class="block text-sm font-semibold text-slate-700 mb-1">Target Audience</label>
                        <textarea name="target_audience" id="target_audience" rows="2" placeholder="Who should attend this event?">{{ old('target_audience') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8 bg-slate-50 flex items-center justify-end gap-4">
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Create Event & Continue
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('name').addEventListener('input', function() {
        if(!document.getElementById('slug').value || document.getElementById('slug').value === document.getElementById('name').value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '')) {
            document.getElementById('slug').value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
        }
    });

    let venueIndex = 0;
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
    });

    let dateIndex = {{ count($oldDates ?? []) }};
    document.getElementById('add-date-btn').addEventListener('click', function() {
        const list = document.getElementById('dates-list');
        const newRow = document.createElement('div');
        newRow.className = 'date-row border border-slate-200 rounded-xl p-4 bg-slate-50/50 relative mb-4';
        newRow.innerHTML = `
            <button type="button" class="remove-date absolute top-3 right-3 text-slate-400 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Date <span class="text-red-500">*</span></label>
                    <input type="date" name="dates[${dateIndex}][date]" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">Start Time</label>
                    <input type="time" name="dates[${dateIndex}][start_time]" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1">End Time</label>
                    <input type="time" name="dates[${dateIndex}][end_time]" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 text-sm">
                </div>
            </div>
        `;
        list.appendChild(newRow);
        
        newRow.querySelector('.remove-date').addEventListener('click', function() {
            newRow.remove();
        });
        dateIndex++;
    });

    // Attach listeners to existing date remove buttons
    document.querySelectorAll('.remove-date').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.date-row').remove();
        });
    });
</script>
@endsection
