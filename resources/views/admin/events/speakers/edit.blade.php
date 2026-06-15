@extends('layouts.admin')

@section('title', 'Edit Speaker - TREC')
@section('page-title', 'Edit Speaker: ' . $speaker->name)
@section('page-subtitle', 'For event: ' . $event->name)

@section('action-button')
<a href="{{ route('admin.events.speakers.index', $event) }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors">
    Cancel
</a>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <form action="{{ route('admin.events.speakers.update', [$event, $speaker]) }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-200">
            @csrf
            @method('PUT')

            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $speaker->name) }}" required class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $speaker->title) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div>
                        <label for="organization" class="block text-sm font-medium text-slate-700 mb-1">Organization</label>
                        <input type="text" name="organization" id="organization" value="{{ old('organization', $speaker->organization) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div class="md:col-span-2">
                        <label for="biography" class="block text-sm font-medium text-slate-700 mb-1">Biography</label>
                        <textarea name="biography" id="biography" rows="4" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">{{ old('biography', $speaker->biography) }}</textarea>
                    </div>

                    <div class="md:col-span-2 flex items-center gap-6">
                        <label class="flex items-center gap-2 text-sm font-medium text-slate-700">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $speaker->is_featured) ? 'checked' : '' }} class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                            Feature prominently
                        </label>
                        
                        <div class="flex items-center gap-2">
                            <label for="display_order" class="text-sm font-medium text-slate-700">Display Order:</label>
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $speaker->display_order) }}" class="w-20 rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500 px-2 py-1">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Links & Media -->
            <div class="p-8 space-y-6 bg-slate-50">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4">Media & Links</h3>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Profile Photo</label>
                        @if($speaker->photo)
                            <div class="mb-3">
                                <img src="{{ asset($speaker->photo) }}" alt="{{ $speaker->name }}" class="w-24 h-24 rounded-full object-cover border border-slate-200">
                            </div>
                        @endif
                        <input type="file" name="photo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="social_linkedin" class="block text-sm font-medium text-slate-700 mb-1">LinkedIn URL</label>
                            <input type="url" name="social_links[linkedin]" id="social_linkedin" value="{{ old('social_links.linkedin', $speaker->social_links['linkedin'] ?? '') }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                        </div>
                        <div>
                            <label for="social_twitter" class="block text-sm font-medium text-slate-700 mb-1">Twitter (X) URL</label>
                            <input type="url" name="social_links[twitter]" id="social_twitter" value="{{ old('social_links.twitter', $speaker->social_links['twitter'] ?? '') }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                        </div>
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
