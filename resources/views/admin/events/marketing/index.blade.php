@extends('layouts.admin')

@section('title', 'Marketing & Tracking - TREC')
@section('page-title', 'Marketing: ' . $event->name)
@section('page-subtitle', '/tscc/' . $event->slug)

@section('action-button')
<a href="{{ route('admin.events.index') }}" class="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-4 py-2 rounded-lg font-medium transition-colors">
    Back to Events
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Campaign List -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900">Active Campaigns & Links</h3>
            </div>
            
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-medium">Campaign Name</th>
                        <th class="px-6 py-4 font-medium">Channel</th>
                        <th class="px-6 py-4 font-medium text-center">Clicks</th>
                        <th class="px-6 py-4 font-medium text-center">Conversions</th>
                        <th class="px-6 py-4 font-medium text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($campaigns as $campaign)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $campaign->name }}</div>
                                <div class="text-xs text-slate-500 flex gap-2 mt-1">
                                    @if($campaign->utm_source)<span class="bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">src: {{ $campaign->utm_source }}</span>@endif
                                    @if($campaign->utm_campaign)<span class="bg-slate-100 px-1.5 py-0.5 rounded border border-slate-200">cmp: {{ $campaign->utm_campaign }}</span>@endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-slate-100 text-slate-700 capitalize">
                                    {{ $campaign->channel }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="font-medium text-slate-900">{{ number_format($campaign->clicks) }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="font-medium text-green-600">{{ number_format($campaign->registrations) }}</div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-3">
                                <button type="button" onclick="copyToClipboard('{{ $event->public_url }}?utm_source={{ $campaign->utm_source }}&utm_medium={{ $campaign->channel }}&utm_campaign={{ $campaign->utm_campaign }}')" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    Copy Link
                                </button>
                                <form action="{{ route('admin.events.marketing.destroy', [$event, $campaign]) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this tracking link?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <p class="mb-2">No marketing campaigns or tracking links created yet.</p>
                                <p class="text-xs">Use tracking links to see which marketing channels bring the most registrations.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Campaign Form -->
    <div class="space-y-6">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Create Tracking Link</h3>
            </div>
            
            <form action="{{ route('admin.events.marketing.store', $event) }}" method="POST" class="p-6 space-y-4">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Campaign Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" required class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500" placeholder="e.g. October Newsletter">
                </div>

                <div>
                    <label for="channel" class="block text-sm font-medium text-slate-700 mb-1">Channel <span class="text-red-500">*</span></label>
                    <select name="channel" id="channel" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500">
                        <option value="email">Email</option>
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
                        <option value="linkedin">LinkedIn</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="direct">Direct Partner</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div>
                    <label for="utm_source" class="block text-sm font-medium text-slate-700 mb-1">UTM Source (Optional)</label>
                    <input type="text" name="utm_source" id="utm_source" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500" placeholder="e.g. mailchimp">
                </div>

                <div>
                    <label for="utm_campaign" class="block text-sm font-medium text-slate-700 mb-1">UTM Campaign (Optional)</label>
                    <input type="text" name="utm_campaign" id="utm_campaign" class="w-full rounded-lg border-slate-300 focus:border-red-500 focus:ring-red-500" placeholder="e.g. early_bird_promo">
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm mt-4">
                    Generate Link
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Tracking link copied to clipboard!');
        }).catch(err => {
            console.error('Could not copy text: ', err);
        });
    }
</script>
@endsection
