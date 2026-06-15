<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventMarketingCampaign;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class EventMarketingController extends Controller
{
    public function index(Event $event): View
    {
        $campaigns = $event->marketingCampaigns()->orderByDesc('created_at')->get();
        $socialLinks = [
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode($event->public_url),
            'twitter' => 'https://twitter.com/intent/tweet?url=' . urlencode($event->public_url) . '&text=' . urlencode($event->name . ' - ' . $event->theme),
            'linkedin' => 'https://www.linkedin.com/sharing/share-offsite/?url=' . urlencode($event->public_url),
            'whatsapp' => 'https://api.whatsapp.com/send?text=' . urlencode($event->name . ' ' . $event->public_url),
        ];
        $channelStats = $campaigns->groupBy('channel')->map(fn($g) => [
            'clicks' => $g->sum('clicks'),
            'registrations' => $g->sum('registrations'),
            'revenue' => $g->sum('revenue'),
        ]);
        return view('admin.events.marketing.index', compact('event','campaigns','socialLinks','channelStats'));
    }

    public function store(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'channel' => 'required|in:facebook,instagram,linkedin,whatsapp,email,direct,other',
            'utm_source' => 'nullable|string|max:100',
            'utm_medium' => 'nullable|string|max:100',
            'utm_campaign' => 'nullable|string|max:100',
        ]);
        $validated['event_id'] = $event->id;
        $validated['ref_code'] = strtoupper(Str::random(8));
        // Defaults
        $validated['utm_source'] = $validated['utm_source'] ?: $validated['channel'];
        $validated['utm_medium'] = $validated['utm_medium'] ?: 'social';
        $validated['utm_campaign'] = $validated['utm_campaign'] ?: strtolower(str_replace(' ','-',$event->slug));
        EventMarketingCampaign::create($validated);
        return back()->with('success', 'Campaign created with referral code: ' . $validated['ref_code']);
    }

    public function destroy(Event $event, EventMarketingCampaign $campaign): RedirectResponse
    {
        $campaign->delete();
        return back()->with('success', 'Campaign deleted.');
    }

    public function trackClick(Request $request, string $ref): void
    {
        $campaign = EventMarketingCampaign::where('ref_code', $ref)->first();
        if ($campaign) $campaign->increment('clicks');
    }
}
