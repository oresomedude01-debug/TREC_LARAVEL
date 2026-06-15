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
                    <div>
                        <label for="event_date" class="block text-sm font-semibold text-slate-700 mb-1">Start Date</label>
                        <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-semibold text-slate-700 mb-1">End Date <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}">
                    </div>
                    <div>
                        <label for="start_time" class="block text-sm font-semibold text-slate-700 mb-1">Start Time</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}">
                    </div>
                    <div>
                        <label for="end_time" class="block text-sm font-semibold text-slate-700 mb-1">End Time</label>
                        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}">
                    </div>

                    <div class="md:col-span-3">
                        <label for="venue_name" class="block text-sm font-semibold text-slate-700 mb-1">Venue Name</label>
                        <input type="text" name="venue_name" id="venue_name" value="{{ old('venue_name') }}" placeholder="e.g. Eko Convention Center">
                    </div>

                    <div class="md:col-span-3">
                        <label for="venue_address" class="block text-sm font-semibold text-slate-700 mb-1">Full Address</label>
                        <textarea name="venue_address" id="venue_address" rows="2">{{ old('venue_address') }}</textarea>
                    </div>

                    <div class="md:col-span-3">
                        <label for="google_maps_url" class="block text-sm font-semibold text-slate-700 mb-1">Google Maps Link <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <input type="url" name="google_maps_url" id="google_maps_url" value="{{ old('google_maps_url') }}" placeholder="https://maps.google.com/...">
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
</script>
@endsection
