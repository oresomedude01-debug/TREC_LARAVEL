@extends('layouts.admin')

@section('title', 'Edit Session - TREC')
@section('page-title', 'Edit Session')
@section('page-subtitle', 'For event: ' . $event->name)

@section('action-button')
<a href="{{ route('admin.events.sessions.index', $event) }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors">
    Cancel
</a>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <form action="{{ route('admin.events.sessions.update', [$event, $session]) }}" method="POST" class="divide-y divide-slate-200">
            @csrf
            @method('PUT')

            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Session Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $session->title) }}" required class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700 mb-1">Category</label>
                        <select name="category" id="category" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                            <option value="keynote" {{ old('category', $session->category) == 'keynote' ? 'selected' : '' }}>Keynote</option>
                            <option value="panel" {{ old('category', $session->category) == 'panel' ? 'selected' : '' }}>Panel Discussion</option>
                            <option value="workshop" {{ old('category', $session->category) == 'workshop' ? 'selected' : '' }}>Workshop</option>
                            <option value="networking" {{ old('category', $session->category) == 'networking' ? 'selected' : '' }}>Networking</option>
                            <option value="break" {{ old('category', $session->category) == 'break' ? 'selected' : '' }}>Break / Lunch</option>
                            <option value="other" {{ old('category', $session->category) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="speaker_id" class="block text-sm font-medium text-slate-700 mb-1">Speaker (Optional)</label>
                        <select name="speaker_id" id="speaker_id" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                            <option value="">-- No Speaker / Panel --</option>
                            @foreach($event->speakers as $speaker)
                                <option value="{{ $speaker->id }}" {{ old('speaker_id', $session->speaker_id) == $speaker->id ? 'selected' : '' }}>{{ $speaker->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="3" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">{{ old('description', $session->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="p-8 space-y-6 bg-slate-50">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Schedule & Location</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="session_date" class="block text-sm font-medium text-slate-700 mb-1">Date</label>
                        <input type="date" name="session_date" id="session_date" value="{{ old('session_date', $session->session_date?->format('Y-m-d')) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-slate-700 mb-1">Start Time</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $session->start_time) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-slate-700 mb-1">End Time</label>
                        <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $session->end_time) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div class="md:col-span-2">
                        <label for="venue_room" class="block text-sm font-medium text-slate-700 mb-1">Room / Location</label>
                        <input type="text" name="venue_room" id="venue_room" value="{{ old('venue_room', $session->venue_room) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500" placeholder="e.g. Main Hall">
                    </div>

                    <div>
                        <label for="display_order" class="block text-sm font-medium text-slate-700 mb-1">Display Order</label>
                        <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $session->display_order) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>
                </div>
            </div>

            <div class="p-8 bg-white flex items-center justify-end">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
