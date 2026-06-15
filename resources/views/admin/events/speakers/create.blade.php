@extends('layouts.admin')

@section('title', 'Add Speaker - TREC')
@section('page-title', 'Add Speaker')
@section('page-subtitle', 'For event: ' . $event->name)

@section('action-button')
<a href="{{ route('admin.events.speakers.index', $event) }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors">
    Cancel
</a>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <form action="{{ route('admin.events.speakers.store', $event) }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-200">
            @csrf

            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="e.g. Dr. Jane Doe">
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="e.g. Chief Medical Officer">
                    </div>

                    <div>
                        <label for="organization" class="block text-sm font-semibold text-slate-700 mb-1">Organization</label>
                        <input type="text" name="organization" id="organization" value="{{ old('organization') }}" placeholder="e.g. Wellness Hospital">
                    </div>

                    <div class="md:col-span-2">
                        <label for="biography" class="block text-sm font-semibold text-slate-700 mb-1">Biography</label>
                        <textarea name="biography" id="biography" rows="4">{{ old('biography') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="inline-flex items-center gap-3 cursor-pointer p-3 rounded-lg border border-slate-200 bg-white hover:border-red-300 hover:bg-red-50 transition-colors w-full">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <div>
                                <span class="text-sm font-semibold text-slate-700">Feature this speaker</span>
                                <p class="form-hint mt-0">Speaker will be shown prominently on the event page.</p>
                            </div>
                        </label>
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
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Profile Photo</label>
                        <div class="file-drop-zone" id="photo-drop-zone">
                            <svg class="drop-icon w-8 h-8 text-slate-400 mb-1 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm font-semibold text-slate-600">Click or drag photo here</p>
                            <p class="form-hint">PNG, JPG, WEBP up to 2MB</p>
                            <p id="photo-file-name" class="text-xs font-semibold text-red-600 mt-1 hidden"></p>
                            <input type="file" name="photo" id="photo" accept="image/*">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="social_linkedin" class="block text-sm font-semibold text-slate-700 mb-1">LinkedIn URL</label>
                            <input type="url" name="social_links[linkedin]" id="social_linkedin" value="{{ old('social_links.linkedin') }}" placeholder="https://linkedin.com/in/...">
                        </div>
                        <div>
                            <label for="social_twitter" class="block text-sm font-semibold text-slate-700 mb-1">Twitter (X) URL</label>
                            <input type="url" name="social_links[twitter]" id="social_twitter" value="{{ old('social_links.twitter') }}" placeholder="https://twitter.com/...">
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8 bg-white flex items-center justify-end">
                <button type="submit" class="btn btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Add Speaker
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
