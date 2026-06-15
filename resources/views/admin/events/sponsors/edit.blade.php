@extends('layouts.admin')

@section('title', 'Edit Sponsor - TREC')
@section('page-title', 'Edit Sponsor: ' . $sponsor->name)
@section('page-subtitle', 'For event: ' . $event->name)

@section('action-button')
<a href="{{ route('admin.events.sponsors.index', $event) }}" class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-lg font-medium transition-colors">
    Cancel
</a>
@endsection

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
        <form action="{{ route('admin.events.sponsors.update', [$event, $sponsor]) }}" method="POST" enctype="multipart/form-data" class="divide-y divide-slate-200">
            @csrf
            @method('PUT')

            <div class="p-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Sponsor Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $sponsor->name) }}" required class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div>
                        <label for="tier" class="block text-sm font-medium text-slate-700 mb-1">Sponsorship Tier</label>
                        <select name="tier" id="tier" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                            <option value="platinum" {{ old('tier', $sponsor->tier) == 'platinum' ? 'selected' : '' }}>Platinum</option>
                            <option value="gold" {{ old('tier', $sponsor->tier) == 'gold' ? 'selected' : '' }}>Gold</option>
                            <option value="silver" {{ old('tier', $sponsor->tier) == 'silver' ? 'selected' : '' }}>Silver</option>
                            <option value="bronze" {{ old('tier', $sponsor->tier) == 'bronze' ? 'selected' : '' }}>Bronze</option>
                            <option value="supporting" {{ old('tier', $sponsor->tier) == 'supporting' ? 'selected' : '' }}>Supporting / Partner</option>
                        </select>
                    </div>

                    <div>
                        <label for="display_order" class="block text-sm font-medium text-slate-700 mb-1">Display Order</label>
                        <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $sponsor->display_order) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div class="md:col-span-2">
                        <label for="website_url" class="block text-sm font-medium text-slate-700 mb-1">Website URL</label>
                        <input type="url" name="website_url" id="website_url" value="{{ old('website_url', $sponsor->website_url) }}" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Sponsor Logo</label>
                        @if($sponsor->logo)
                            <div class="mb-3 p-2 border border-slate-200 rounded-lg inline-block bg-slate-50">
                                <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}" class="h-16 object-contain">
                            </div>
                        @endif
                        <input type="file" name="logo" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                    </div>
                </div>
            </div>

            <div class="p-8 bg-slate-50 flex items-center justify-end">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2.5 rounded-lg font-medium transition-colors shadow-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
