@extends('layouts.app')

@php
  $showWaitlist = ($event->status === 'published') || ($event->status === 'registration_open' && !$activeTicket);
@endphp

{{-- ─── SEO ──────────────────────────────────────────────────────────────── --}}
@section('title', $event->name . ' – ' . ($event->theme ? '"'.$event->theme.'"' : 'TREC Event'))
@section('meta_desc', $event->short_description ?? 'Join us for ' . $event->name . ' by The Ripple Effect Consult.')
@section('og_title', $event->name . ' | TREC')
@section('og_desc',  $event->short_description ?? 'Register now for ' . $event->name)
@section('og_type',  'event')
@if($event->social_share_image ?? $event->banner_image)
@section('og_image', asset($event->social_share_image ?? $event->banner_image))
@endif

@section('styles')
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    corePlugins: {
      preflight: false,
    }
  }
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Event",
  "name": "{{ $event->name }}",
  "description": "{{ strip_tags($event->short_description) }}",
  @if(!empty($event->dates) && count($event->dates) > 0)
  "startDate": "{{ \Carbon\Carbon::parse($event->dates[0]['date'])->toIso8601String() }}",
  @else
  "startDate": "{{ $event->event_date?->toIso8601String() }}",
  @endif
  @if(!empty($event->venues) && count($event->venues) > 0)
  "location": [
    @foreach($event->venues as $venue)
    {
      "@@type": "Place",
      "name": "{{ $venue['name'] ?? 'TBA' }}",
      "address": "{{ $venue['address'] ?? '' }}"
    }{{ !$loop->last ? ',' : '' }}
    @endforeach
  ],
  @else
  "location": {
    "@@type": "Place",
    "name": "{{ $event->venue_name ?? 'TBA' }}",
    "address": "{{ $event->venue_address ?? '' }}"
  },
  @endif
  "organizer": {
    "@@type": "Organization",
    "name": "The Ripple Effect Consult",
    "url": "{{ url('/') }}"
  },
  "image": "{{ $event->banner_image ? asset($event->banner_image) : '' }}"
}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

<style>
/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   DESIGN SYSTEM — TSCC Event Landing Page
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=DM+Serif+Display:ital@0;1&display=swap');

:root {
  --red: #dc2626;
  --red-dark: #991b1b;
  --red-glow: rgba(220,38,38,0.35);
  --navy: #050a18;
  --navy-mid: #0d1528;
  --ink: #0f172a;
  --ink-2: #1e293b;
  --muted: #64748b;
  --faint: #94a3b8;
  --border: #e2e8f0;
  --border-dark: rgba(255,255,255,0.1);
  --surface: #ffffff;
  --surface-2: #f8fafc;
  --surface-3: #f1f5f9;
  --radius: 1.5rem;
  --font-body: 'Outfit', system-ui, sans-serif;
  --font-display: 'DM Serif Display', Georgia, serif;
  --ease-spring: cubic-bezier(0.34, 1.56, 0.64, 1);
  --ease-out: cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

/* ── Global ──────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; }
html { scroll-behavior: smooth; scroll-padding-top: 80px; }
body {
  font-family: var(--font-body);
  background: var(--surface);
  color: var(--ink);
  padding-top: 0 !important;
  overflow-x: hidden;
}
.ep-display { font-family: var(--font-display); }

/* Hide global layout elements – this is a standalone landing page */
#mainNav, .hamburger, #mobMenu, #mobBackdrop, .mob-nav-section,
.mob-close, .trec-contact-widget, footer, .mob-footer, .trec-footer,
#scroll-progress {
  display: none !important;
}

/* ── Page-level Reading Progress ────────────────────────── */
#page-progress {
  position: fixed; top: 0; left: 0; height: 3px; z-index: 9999;
  background: linear-gradient(90deg, #dc2626 0%, #f87171 60%, #fca5a5 100%);
  width: 0%; transition: width 0.12s linear;
  border-radius: 0 3px 3px 0;
  box-shadow: 0 0 8px rgba(220,38,38,0.6);
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   FLOATING PILL NAV
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
#ep-nav {
  position: fixed; top: 1.25rem; left: 50%; transform: translateX(-50%);
  z-index: 200; width: calc(100% - 2rem); max-width: 860px;
  background: rgba(5,10,24,0.5); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
  border: 1px solid rgba(255,255,255,0.12); border-radius: 999px;
  transition: all 0.4s var(--ease-out);
  box-shadow: 0 4px 40px -8px rgba(0,0,0,0.6), 0 1px 0 rgba(255,255,255,0.06) inset;
}
#ep-nav.scrolled {
  background: rgba(255,255,255,0.94); border-color: rgba(0,0,0,0.07);
  box-shadow: 0 8px 32px -8px rgba(0,0,0,0.14);
  top: 0.75rem;
}
#ep-nav .nav-logo-text { color: rgba(255,255,255,0.9); transition: color 0.3s; }
#ep-nav.scrolled .nav-logo-text { color: var(--ink); }
#ep-nav .nav-link {
  color: rgba(255,255,255,0.6); font-size: 0.8125rem; font-weight: 500;
  transition: color 0.2s; position: relative; padding-bottom: 2px;
  text-decoration: none;
}
#ep-nav .nav-link::after {
  content: ''; position: absolute; bottom: -2px; left: 0; right: 0;
  height: 2px; background: var(--red); border-radius: 2px;
  transform: scaleX(0); transition: transform 0.2s var(--ease-spring);
}
#ep-nav .nav-link:hover, #ep-nav .nav-link.active { color: #fff; }
#ep-nav .nav-link:hover::after, #ep-nav .nav-link.active::after { transform: scaleX(1); }
#ep-nav.scrolled .nav-link { color: var(--muted); }
#ep-nav.scrolled .nav-link:hover, #ep-nav.scrolled .nav-link.active { color: var(--red); }
#ep-nav .nav-cta-pill {
  background: var(--red); color: #fff; font-size: 0.8rem; font-weight: 700;
  padding: 0.5rem 1.25rem; border-radius: 999px; letter-spacing: 0.01em;
  transition: all 0.2s; box-shadow: 0 4px 14px var(--red-glow);
  white-space: nowrap; text-decoration: none;
}
#ep-nav .nav-cta-pill:hover { background: var(--red-dark); transform: translateY(-1px); box-shadow: 0 6px 20px var(--red-glow); }
#ep-nav .nav-hamburger {
  display: none;
  cursor: pointer;
}
#ep-nav.is-open {
  border-radius: 1.5rem;
  background: rgba(5,10,24,0.96) !important;
  border-color: rgba(255,255,255,0.2);
}
#ep-nav.scrolled.is-open {
  background: rgba(255,255,255,0.98) !important;
  border-color: rgba(0,0,0,0.1);
}
#ep-nav.is-open .mobile-nav-links {
  display: flex !important;
}
#ep-nav.scrolled .mobile-nav-links {
  border-color: rgba(0,0,0,0.08);
}
#ep-nav.scrolled .mobile-nav-link {
  color: var(--muted);
}
#ep-nav.scrolled .mobile-nav-link:hover {
  color: var(--red);
}
@media (max-width: 700px) {
  #ep-nav .nav-links-group { display: none !important; }
  #ep-nav .nav-hamburger { display: flex; }
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   HERO
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.hero-section {
  min-height: 100svh; background: var(--navy); position: relative;
  overflow: hidden; display: flex; align-items: center;
}
.hero-bg-img {
  position: absolute; inset: 0;
  background-size: cover; background-position: center;
  opacity: 0.25; transform: scale(1.05);
  animation: slowZoom 20s ease-in-out infinite alternate;
}
@keyframes slowZoom { from { transform: scale(1.04); } to { transform: scale(1.14); } }
.hero-gradient {
  position: absolute; inset: 0;
  background: linear-gradient(135deg,
    rgba(5,10,24,0.92) 0%,
    rgba(5,10,24,0.70) 50%,
    rgba(120,0,0,0.18) 100%
  );
}
/* Particle-like noise texture overlay */
.hero-noise {
  position: absolute; inset: 0; z-index: 1; pointer-events: none;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  opacity: 0.4;
}
.hero-orb-1 {
  position: absolute; width: 700px; height: 700px; pointer-events: none;
  background: radial-gradient(circle, rgba(220,38,38,0.22) 0%, transparent 70%);
  top: -220px; right: -180px; animation: drift1 12s ease-in-out infinite alternate;
}
.hero-orb-2 {
  position: absolute; width: 500px; height: 500px; pointer-events: none;
  background: radial-gradient(circle, rgba(220,38,38,0.12) 0%, transparent 70%);
  bottom: -160px; left: -140px; animation: drift2 14s ease-in-out infinite alternate;
}
.hero-orb-3 {
  position: absolute; width: 300px; height: 300px; pointer-events: none;
  background: radial-gradient(circle, rgba(99,102,241,0.1) 0%, transparent 70%);
  top: 30%; left: 15%;
}
@keyframes drift1 { from { transform: translate(0,0) scale(1); } to { transform: translate(30px,-20px) scale(1.08); } }
@keyframes drift2 { from { transform: translate(0,0); } to { transform: translate(-20px,30px); } }

/* Hero grid line decoration */
.hero-grid {
  position: absolute; inset: 0; z-index: 1; pointer-events: none;
  background-image:
    linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
  background-size: 64px 64px;
}
.hero-line-top {
  position: absolute; top: 0; left: 0; right: 0; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(220,38,38,0.5) 40%, rgba(220,38,38,0.5) 60%, transparent);
}
.hero-line-bottom {
  position: absolute; bottom: 0; left: 0; right: 0; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.08) 50%, transparent);
}

/* ── Hero badges / chips ────────────────────────────────── */
.badge-live {
  display: inline-flex; align-items: center; gap: 7px;
  background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3);
  color: #4ade80; font-size: 0.68rem; font-weight: 700;
  letter-spacing: 0.12em; text-transform: uppercase;
  padding: 5px 14px; border-radius: 999px;
}
.badge-live .pulse-dot {
  width: 6px; height: 6px; border-radius: 50%; background: #4ade80;
  animation: pulse 1.6s ease-in-out infinite;
  box-shadow: 0 0 6px rgba(74,222,128,0.6);
}
@keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:0.5;transform:scale(0.8)} }

.meta-chip {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
  border-radius: 999px; padding: 6px 14px; font-size: 0.8125rem; color: rgba(255,255,255,0.7);
  backdrop-filter: blur(8px); transition: background 0.2s, border-color 0.2s;
}
.meta-chip svg { flex-shrink: 0; }
.meta-chip:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.18); }

/* ── Hero CTA buttons ───────────────────────────────────── */
.btn-hero-primary {
  display: inline-flex; align-items: center; gap: 10px;
  background: var(--red); color: #fff; font-weight: 800; font-size: 1rem;
  padding: 1rem 2rem; border-radius: 999px; border: none; cursor: pointer;
  text-decoration: none; transition: all 0.25s var(--ease-spring);
  box-shadow: 0 8px 30px var(--red-glow), 0 2px 0 rgba(255,255,255,0.1) inset;
  position: relative; overflow: hidden;
}
.btn-hero-primary::before {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 60%);
}
.btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 16px 40px var(--red-glow); background: #c81e1e; }
.btn-hero-primary:active { transform: translateY(0); }

.btn-hero-secondary {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.18);
  color: rgba(255,255,255,0.9); font-weight: 600; font-size: 0.9375rem;
  padding: 1rem 1.75rem; border-radius: 999px; text-decoration: none;
  transition: all 0.22s; backdrop-filter: blur(8px);
}
.btn-hero-secondary:hover { background: rgba(255,255,255,0.15); border-color: rgba(255,255,255,0.28); transform: translateY(-1px); }

/* ── Scroll indicator ───────────────────────────────────── */
.scroll-indicator {
  display: flex; flex-direction: column; align-items: center; gap: 6px;
  color: rgba(255,255,255,0.35); font-size: 0.65rem; font-weight: 600; letter-spacing: 0.12em;
  text-transform: uppercase;
}
.scroll-indicator .scroll-mouse {
  width: 20px; height: 32px; border: 2px solid rgba(255,255,255,0.25); border-radius: 12px;
  position: relative; display: flex; justify-content: center; padding-top: 5px;
}
.scroll-indicator .scroll-wheel {
  width: 3px; height: 7px; border-radius: 3px; background: rgba(255,255,255,0.4);
  animation: scrollWheel 2s ease-in-out infinite;
}
@keyframes scrollWheel { 0%,100%{opacity:1;transform:translateY(0)} 50%{opacity:0.3;transform:translateY(6px)} }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   COUNTDOWN / URGENCY SECTION
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.cd-box {
  background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);
  border-radius: 14px; padding: 14px 18px; min-width: 72px; text-align: center;
  backdrop-filter: blur(8px); position: relative; overflow: hidden;
}
.cd-box::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
}
.cd-num {
  font-size: 2.25rem; font-weight: 900; line-height: 1;
  font-variant-numeric: tabular-nums; color: #fff; letter-spacing: -0.02em;
}
.cd-label { font-size: 0.6rem; font-weight: 700; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.45); margin-top: 5px; }
@media (max-width: 480px) { .cd-num { font-size: 1.6rem; } .cd-box { padding: 10px 14px; min-width: 56px; } }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   SECTION UTILITIES
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.section-eyebrow {
  display: inline-flex; align-items: center; gap: 10px;
  font-size: 0.68rem; font-weight: 800; letter-spacing: 0.16em;
  text-transform: uppercase; color: var(--red); margin-bottom: 0.875rem;
}
.section-eyebrow .eyebrow-line {
  width: 28px; height: 2px; border-radius: 2px;
  background: linear-gradient(90deg, var(--red), rgba(220,38,38,0.3));
}
.section-eyebrow.centered { justify-content: center; }

/* ── Section dividers ───────────────────────────────────── */
.section-white { background: #fff; }
.section-mist { background: #f8fafc; }
.section-dark { background: var(--navy); }
.section-dark-mid { background: var(--navy-mid); }

/* Diagonal section separator */
.wave-up {
  position: relative; padding-top: 6rem !important;
}
.wave-up::before {
  content: ''; position: absolute; top: -2px; left: 0; right: 0; height: 6rem;
  background: inherit; clip-path: polygon(0 100%, 100% 0, 100% 100%);
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   WHY ATTEND — BENEFIT CARDS
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.benefit-card {
  background: #fff; border: 1.5px solid var(--border); border-radius: 1.25rem;
  padding: 1.5rem; transition: all 0.3s var(--ease-out); position: relative; overflow: hidden;
}
.benefit-card::before {
  content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, var(--red), transparent);
  transform: scaleX(0); transform-origin: left;
  transition: transform 0.35s var(--ease-spring);
}
.benefit-card:hover { transform: translateY(-4px); box-shadow: 0 20px 50px -16px rgba(0,0,0,0.12), 0 0 0 1px rgba(220,38,38,0.12); border-color: rgba(220,38,38,0.2); }
.benefit-card:hover::before { transform: scaleX(1); }
.benefit-icon {
  width: 48px; height: 48px; border-radius: 14px;
  background: linear-gradient(135deg, #fff1f2, #ffe4e6);
  border: 1px solid #fecdd3; display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; margin-bottom: 1rem; transition: all 0.3s;
}
.benefit-card:hover .benefit-icon { background: linear-gradient(135deg, var(--red), #ef4444); border-color: transparent; }
.benefit-card:hover .benefit-icon svg, .benefit-card:hover .benefit-icon i { color: #fff !important; }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   SPEAKERS
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.speaker-card { position: relative; overflow: hidden; border-radius: 1.5rem; cursor: pointer; }
.speaker-card img { transition: transform 0.6s ease; width: 100%; height: 100%; object-fit: cover; display: block; }
.speaker-card:hover img { transform: scale(1.09); }
.speaker-overlay {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(5,10,24,0.92) 0%, rgba(5,10,24,0.3) 55%, transparent 100%);
  display: flex; flex-direction: column; justify-content: flex-end; padding: 1.25rem;
  opacity: 0.7; transition: opacity 0.35s ease;
}
.speaker-card:hover .speaker-overlay { opacity: 1; }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   PROGRAMME SCHEDULE
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.track-keynote { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
.track-workshop { background: #eff6ff; color: #2563eb; border-color: #bfdbfe; }
.track-panel { background: #f0fdf4; color: #16a34a; border-color: #bbf7d0; }
.track-networking { background: #fdf4ff; color: #9333ea; border-color: #e9d5ff; }
.track-break { background: #f8fafc; color: #64748b; border-color: #e2e8f0; }
.track-other { background: #fffbeb; color: #d97706; border-color: #fde68a; }

.day-tab {
  flex: none; padding: 0.625rem 1.25rem; border-radius: 999px;
  border: 2px solid var(--border); font-size: 0.85rem; font-weight: 600;
  cursor: pointer; white-space: nowrap; transition: all 0.22s; background: #fff; color: var(--muted);
}
.day-tab:hover { border-color: #fca5a5; color: var(--red); }
.day-tab.active-day { background: var(--red); color: #fff; border-color: var(--red); box-shadow: 0 4px 14px var(--red-glow); }

.session-row {
  display: flex; gap: 0; border: 1.5px solid var(--border); border-radius: 1.125rem;
  overflow: hidden; background: #fff; transition: all 0.22s;
}
.session-row:hover { border-color: rgba(220,38,38,0.25); box-shadow: 0 8px 24px -8px rgba(0,0,0,0.1); transform: translateX(3px); }
.session-time {
  width: 88px; flex-shrink: 0; display: flex; flex-direction: column;
  align-items: center; justify-content: center; padding: 1.25rem 0.75rem;
  background: var(--surface-2); border-right: 1.5px solid var(--border); text-align: center;
}
.session-time-line { width: 1px; height: 18px; background: var(--border); margin: 4px 0; }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   STATS BAR
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.stat-pill {
  display: flex; flex-direction: column; align-items: center;
  padding: 2.5rem 1rem; position: relative;
}
.stat-pill + .stat-pill::before {
  content: ''; position: absolute; left: 0; top: 20%; bottom: 20%;
  width: 1px; background: rgba(255,255,255,0.08);
}
.stat-num { font-feature-settings: "tnum"; letter-spacing: -0.02em; }
@media (max-width: 640px) {
  .stat-pill + .stat-pill::before { display: none; }
  .stat-pill { border-bottom: 1px solid rgba(255,255,255,0.06); }
  .stat-pill:last-child { border-bottom: none; }
}

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   TESTIMONIAL CAROUSEL
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.testi-track { display: flex; transition: transform 0.5s var(--ease-out); }
.testi-slide { flex: 0 0 100%; padding: 0 1rem; }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   TICKET CARDS — Premium "Pass" design
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.ticket-card {
  background: #fff; border: 2px solid var(--border);
  border-radius: 1.75rem; overflow: hidden;
  transition: all 0.3s var(--ease-out);
  display: flex; flex-direction: column; position: relative;
}
.ticket-card:hover { transform: translateY(-6px); box-shadow: 0 30px 70px -20px rgba(0,0,0,0.16); }
.ticket-card.is-featured {
  border-color: var(--red);
  box-shadow: 0 0 0 4px rgba(220,38,38,0.1);
}
.ticket-card.is-featured::before {
  content: '★ MOST POPULAR';
  position: absolute; top: 0; right: 0;
  background: var(--red); color: #fff;
  font-size: 0.6rem; font-weight: 900; letter-spacing: 0.14em;
  padding: 6px 16px 6px 24px; border-bottom-left-radius: 1.25rem;
}
.ticket-card.is-sold-out::after {
  content: 'SOLD OUT'; position: absolute; inset: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.5rem; font-weight: 900; letter-spacing: 0.2em; color: var(--red);
  background: rgba(255,255,255,0.8); backdrop-filter: blur(4px);
}
/* Dashed ticket perforation line */
.ticket-perf {
  display: flex; align-items: center; gap: 0; position: relative;
  margin: 0; height: 1px;
}
.ticket-perf-line {
  flex: 1; height: 1.5px;
  background-image: repeating-linear-gradient(90deg, var(--border) 0, var(--border) 10px, transparent 10px, transparent 18px);
}
.ticket-perf-circle {
  width: 20px; height: 20px; border-radius: 50%; background: var(--surface-2);
  border: 1.5px solid var(--border); flex-shrink: 0; margin: 0 -10px;
  z-index: 1; box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}

/* ── Ticket radio ───────────────────────────────────────── */
.ticket-radio-item {
  position: relative; cursor: pointer;
  border: 2px solid var(--border); border-radius: 1rem;
  padding: 1rem 1.25rem; transition: all 0.18s;
}
.ticket-radio-item:hover { border-color: #fca5a5; background: #fff9f9; }
.ticket-radio-item.is-selected { border-color: var(--red); background: #fff5f5; }
.ticket-radio-item input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }
.ticket-radio-dot {
  width: 20px; height: 20px; border-radius: 50%; border: 2px solid var(--border); flex-shrink: 0;
  transition: all 0.18s; display: flex; align-items: center; justify-content: center;
}
.ticket-radio-item.is-selected .ticket-radio-dot { border-color: var(--red); background: var(--red); }
.ticket-radio-item.is-selected .ticket-radio-dot::after {
  content: ''; width: 8px; height: 8px; border-radius: 50%; background: #fff;
}

/* ── Scarcity bar ───────────────────────────────────────── */
.scarcity-bar { height: 5px; border-radius: 999px; background: #f1f5f9; overflow: hidden; }
.scarcity-bar-fill { height: 100%; border-radius: 999px; background: linear-gradient(90deg, var(--red), #f87171); transition: width 1.2s var(--ease-out); }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   REGISTRATION FORM
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.ep-input {
  width: 100%; background: var(--surface-2); border: 1.5px solid var(--border);
  border-radius: 0.875rem; padding: 0.8125rem 1rem;
  font-size: 0.9375rem; font-family: var(--font-body); color: var(--ink);
  outline: none; transition: all 0.2s; -webkit-appearance: none;
}
.ep-input:focus { border-color: var(--red); background: #fff; box-shadow: 0 0 0 4px rgba(220,38,38,0.08); }
.ep-input::placeholder { color: var(--faint); }
.ep-label { display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem; }
.ep-hint { font-size: 0.75rem; color: var(--faint); margin-top: 0.35rem; }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   FAQ
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.faq-item { border-bottom: 1px solid #f1f5f9; }
.faq-item:last-child { border-bottom: none; }
.faq-item.is-open .faq-q { color: var(--red); }
.faq-icon { transition: transform 0.32s var(--ease-spring); color: var(--muted); }
.faq-item.is-open .faq-icon { transform: rotate(45deg); color: var(--red); }
.faq-body { max-height: 0; overflow: hidden; transition: max-height 0.36s ease; }
.faq-body.open { max-height: 500px; }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   SPONSOR TIERS
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.tier-platinum img { max-height: 80px; }
.tier-gold img { max-height: 64px; }
.tier-silver img { max-height: 50px; }
.tier-bronze img { max-height: 40px; }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   FLOATING ELEMENTS
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
#floating-bar {
  position: fixed; bottom: 0; left: 0; right: 0; z-index: 90;
  transform: translateY(110%); transition: transform 0.38s var(--ease-out);
}
#floating-bar.visible { transform: translateY(0); }

.wa-fab {
  position: fixed; bottom: 5.5rem; right: 1.5rem; z-index: 80;
  width: 54px; height: 54px; background: #25d366; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 8px 28px rgba(37,211,102,0.5);
  transition: transform 0.22s var(--ease-spring), box-shadow 0.22s;
}
.wa-fab:hover { transform: scale(1.12) rotate(-5deg); box-shadow: 0 14px 36px rgba(37,211,102,0.55); }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   ANIMATIONS
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.65s ease, transform 0.65s ease; }
.reveal.visible { opacity: 1; transform: none; }
.reveal-left { opacity: 0; transform: translateX(-28px); transition: opacity 0.6s ease, transform 0.6s ease; }
.reveal-left.visible { opacity: 1; transform: none; }
.reveal-right { opacity: 0; transform: translateX(28px); transition: opacity 0.6s ease, transform 0.6s ease; }
.reveal-right.visible { opacity: 1; transform: none; }

/* ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
   EVENT-PAGE FOOTER
   ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━ */
.ep-footer {
  background: var(--navy); border-top: 1px solid rgba(255,255,255,0.07);
  padding: 2rem 1.5rem; text-align: center;
}
</style>

@endsection

@section('content')

{{-- ═══ Page Progress Bar ═══════════════════════════════════════════════════ --}}
<div id="page-progress"></div>

{{-- ═══ STICKY NAV ════════════════════════════════════════════════════════════
     Clean, minimal. Transforms from transparent → frosted glass on scroll.
══════════════════════════════════════════════════════════════════════════════ --}}
<nav id="ep-nav" class="px-4 py-2.5 md:py-3 md:px-5 flex flex-col justify-center">
  <div class="flex items-center justify-between w-full">
    {{-- Logo --}}
    <a href="{{ url('/') }}" class="flex items-center gap-2.5 flex-shrink-0">
      <img src="{{ asset('images/tscc-logo.png') }}" alt="TSCC Logo" class="h-10 w-auto object-contain">
      <span class="nav-logo-text font-bold text-base tracking-tight hidden sm:block">TREC</span>
    </a>

    {{-- Desktop nav links --}}
    <div class="nav-links-group hidden md:flex items-center gap-6">
      @if(is_array($event->objectives) && count($event->objectives) > 0)
      <a href="#why-attend" class="nav-link section-link">Why Attend</a>
      @endif
      @if($allSpeakers->count() > 0)
      <a href="#speakers" class="nav-link section-link">Speakers</a>
      @endif
      @if($sessionsByDay->count() > 0)
      <a href="#programme" class="nav-link section-link">Programme</a>
      @endif
      @if($event->ticketTypes->count() > 0)
      <a href="#tickets" class="nav-link section-link">Tickets</a>
      @endif
      <a href="#faq" class="nav-link section-link">FAQ</a>
    </div>

    {{-- CTA + mobile hamburger --}}
    <div class="flex items-center gap-3">
      @if($event->status === 'registration_open' || $showWaitlist)
      <!-- COMMENTED OUT: Local registration - redirecting to Selar -->
      {{-- <a href="#register" class="nav-cta-pill">{{ $showWaitlist ? 'Join Waitlist' : 'Register Now' }}</a> --}}
      <a href="https://selar.com/tscc2026" class="nav-cta-pill">{{ $showWaitlist ? 'Join Waitlist' : 'Register Now' }}</a>
      @endif
      <button class="nav-hamburger md:hidden w-9 h-9 rounded-full border border-white/20 bg-white/10 flex items-center justify-center text-white" aria-label="Menu">
        <svg width="16" height="12" viewBox="0 0 16 12" fill="none"><rect width="16" height="2" rx="1" fill="currentColor"/><rect y="5" width="16" height="2" rx="1" fill="currentColor"/><rect y="10" width="16" height="2" rx="1" fill="currentColor"/></svg>
      </button>
    </div>
  </div>

  {{-- Mobile Nav Links Panel --}}
  <div class="mobile-nav-links hidden flex-col gap-3.5 pt-4 pb-2 border-t border-white/10 mt-3.5 w-full">
    @if(is_array($event->objectives) && count($event->objectives) > 0)
    <a href="#why-attend" class="mobile-nav-link text-sm font-medium text-white/70 hover:text-white transition-colors">Why Attend</a>
    @endif
    @if($allSpeakers->count() > 0)
    <a href="#speakers" class="mobile-nav-link text-sm font-medium text-white/70 hover:text-white transition-colors">Speakers</a>
    @endif
    @if($sessionsByDay->count() > 0)
    <a href="#programme" class="mobile-nav-link text-sm font-medium text-white/70 hover:text-white transition-colors">Programme</a>
    @endif
    @if($event->ticketTypes->count() > 0)
    <a href="#tickets" class="mobile-nav-link text-sm font-medium text-white/70 hover:text-white transition-colors">Tickets</a>
    @endif
    <a href="#faq" class="mobile-nav-link text-sm font-medium text-white/70 hover:text-white transition-colors">FAQ</a>
  </div>
</nav>

{{-- ═══ SECTION 1 · HERO ══════════════════════════════════════════════════════
     Full-viewport hero with animated background, bold typography, trust chips.
══════════════════════════════════════════════════════════════════════════════ --}}
<section class="hero-section" id="top">

  {{-- Layers --}}
  @if($event->banner_image)
  <div class="hero-bg-img" style="background-image: url('{{ asset($event->banner_image) }}')"></div>
  @endif
  <div class="hero-gradient"></div>
  <div class="hero-grid"></div>
  <div class="hero-noise"></div>
  <div class="hero-line-top"></div>
  <div class="hero-line-bottom"></div>
  <div class="hero-orb-1"></div>
  <div class="hero-orb-2"></div>
  <div class="hero-orb-3"></div>

  <div class="relative z-10 w-full max-w-7xl mx-auto px-5 md:px-8 pt-32 pb-24 md:pt-40 md:pb-32">

    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10 lg:gap-16">
      
      {{-- TSCC Hero Logo (Creative Left Placement) --}}
      <div class="flex-shrink-0 relative group lg:mt-6">
        {{-- Soft glowing aura behind the logo --}}
        <div class="absolute inset-0 bg-red-500/20 blur-[80px] rounded-full scale-150 transition-all duration-700 pointer-events-none"></div>
        <img src="{{ asset('images/tscc-logo.png') }}" alt="TSCC Logo" class="relative h-48 md:h-64 lg:h-[340px] w-auto object-contain drop-shadow-[0_20px_40px_rgba(0,0,0,0.4)] hover:scale-105 transition-transform duration-500">
      </div>

      {{-- Main Text Content --}}
      <div class="flex-1 text-center lg:text-left flex flex-col items-center lg:items-start">
        
        {{-- Event meta badges --}}
        <div class="flex flex-wrap items-center gap-3 mb-6 justify-center lg:justify-start">
          @if($showWaitlist)
            <span class="inline-flex items-center gap-2 bg-amber-900/40 border border-amber-800/40 text-amber-400 text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full"><span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>Waitlist Open</span>
          @elseif($event->status === 'registration_open')
            <span class="badge-live"><span class="pulse-dot"></span>Registration Open</span>
          @elseif($event->status === 'registration_closed')
            <span class="inline-flex items-center gap-2 bg-red-900/40 border border-red-800/40 text-red-400 text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full">Registration Closed</span>
          @elseif($event->status === 'completed')
            <span class="inline-flex items-center gap-2 bg-slate-800/60 border border-slate-700/40 text-slate-400 text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full">Past Event</span>
          @else
            <span class="inline-flex items-center gap-2 bg-blue-900/40 border border-blue-800/40 text-blue-400 text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full">Coming Soon</span>
          @endif
          <span class="text-white/35 text-xs font-medium">by The Ripple Effect Consult</span>
        </div>

        {{-- Title --}}
        <h1 class="ep-display text-5xl md:text-7xl lg:text-8xl font-bold text-white leading-[1.05] mb-5 max-w-4xl">
          {{ $event->name }}
        </h1>

    {{-- Theme --}}
    @if($event->theme)
    <p class="text-xl md:text-2xl text-red-400/90 italic font-medium mb-7 text-center lg:text-left max-w-2xl">
      "{{ $event->theme }}"
    </p>
    @endif

    {{-- Short description --}}
    @if($event->short_description)
    <p class="text-base md:text-lg text-white/60 max-w-2xl mb-10 leading-relaxed text-center lg:text-left">
      {{ $event->short_description }}
    </p>
    @endif

    {{-- Event metadata chips --}}
    <div class="flex flex-wrap gap-3 mb-10 justify-center lg:justify-start">
      @if(!empty($event->dates) && count($event->dates) > 0)
        @foreach($event->dates as $dt)
        <div class="flex items-center gap-2.5 bg-white/6 border border-white/10 rounded-full px-4 py-2 text-sm text-white/75 backdrop-blur-sm">
          <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          {{ \Carbon\Carbon::parse($dt['date'])->format('l, F j, Y') }}
          @if(!empty($dt['start_time']))
            <span class="opacity-50">|</span> {{ \Carbon\Carbon::parse($dt['start_time'])->format('h:i A') }}{{ !empty($dt['end_time']) ? ' – '.\Carbon\Carbon::parse($dt['end_time'])->format('h:i A') : '' }}
          @endif
        </div>
        @endforeach
      @elseif($event->event_date)
      <div class="flex items-center gap-2.5 bg-white/6 border border-white/10 rounded-full px-4 py-2 text-sm text-white/75 backdrop-blur-sm">
        <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        {{ $event->event_date->format('l, F j, Y') }}@if($event->end_date && $event->end_date->neq($event->event_date)) &mdash; {{ $event->end_date->format('l, F j, Y') }}@endif
      </div>
      @endif
      @if(empty($event->dates) && $event->start_time)
      <div class="flex items-center gap-2.5 bg-white/6 border border-white/10 rounded-full px-4 py-2 text-sm text-white/75 backdrop-blur-sm">
        <svg class="w-4 h-4 text-red-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}{{ $event->end_time ? ' – '.\Carbon\Carbon::parse($event->end_time)->format('h:i A') : '' }}
      </div>
      @endif
      @if(!empty($event->venues) && count($event->venues) > 0)
        @foreach($event->venues as $venue)
        <div class="meta-chip">
          <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          {{ $venue['name'] }}
        </div>
        @endforeach
      @elseif($event->venue_name)
      <div class="meta-chip">
        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        {{ $event->venue_name }}
      </div>
      @endif
      @if($totalRegistrations > 0)
      <div class="meta-chip">
        <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        {{ number_format($totalRegistrations) }}+ Registered
      </div>
      @endif
    </div>

    {{-- Hero CTAs --}}
    <div class="flex flex-wrap gap-4 mb-14 justify-center lg:justify-start">
      @if($event->status === 'registration_open')
      {{-- COMMENTED OUT: Local registration form - redirecting to Selar --}}
      {{-- <a href="#register" class="btn-hero-primary"> --}}
      <a href="https://selar.com/tscc2026" class="btn-hero-primary">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
        Secure Your Spot
        @if($activeTicket && (float)$activeTicket->price > 0)
        @if($activeTicket->strike_price && (float)$activeTicket->strike_price > (float)$activeTicket->price)
        <span class="bg-white/20 rounded-full px-3 py-0.5 text-sm font-semibold line-through">₦{{ number_format((float)$activeTicket->strike_price) }}</span>
        <span class="bg-green-500/30 rounded-full px-3 py-0.5 text-sm font-semibold">Save {{ $activeTicket->discount_percent }}%</span>
        @else
        <span class="bg-white/20 rounded-full px-3 py-0.5 text-sm font-semibold">from ₦{{ number_format((float)$activeTicket->price) }}</span>
        @endif
        @endif
      </a>
      @endif
      @if($sessionsByDay->count() > 0)
      <a href="#programme" class="btn-hero-secondary">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        View Schedule
      </a>
      @endif
    </div>

    {{-- Trust bar: key benefits --}}
    @if(is_array($event->objectives) && count($event->objectives) > 0)
    <div class="pt-10 border-t border-white/8">
      <p class="text-xs font-bold uppercase tracking-widest text-white/30 mb-5 text-center lg:text-left">What you'll gain</p>
      <div class="flex flex-wrap gap-2.5 justify-center lg:justify-start">
        @foreach(array_slice($event->objectives, 0, 6) as $benefit)
        <span class="inline-flex items-center gap-2 bg-white/5 border border-white/10 rounded-full px-4 py-1.5 text-sm text-white/65 backdrop-blur-sm hover:bg-white/10 transition-colors">
          <svg class="w-3 h-3 text-red-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
          {{ $benefit }}
        </span>
        @endforeach
      </div>
    </div>
    @endif

      </div>
    </div>

  </div>

  {{-- Creative scroll indicator --}}
  <div class="absolute bottom-10 left-1/2 -translate-x-1/2 z-10 scroll-indicator">
    <span>Scroll</span>
    <div class="scroll-mouse">
      <div class="scroll-wheel"></div>
    </div>
  </div>

</section>

{{-- ═══ SECTION 2 · URGENCY BANNER ════════════════════════════════════════════
     Countdown + current price snapshot — only shown when registration is open.
══════════════════════════════════════════════════════════════════════════════ --}}
@if($event->status === 'registration_open' && $registrationDeadline)
<section class="bg-gradient-to-r from-red-700 via-red-600 to-rose-600 text-white">
  <div class="max-w-6xl mx-auto px-5 md:px-8 py-10 md:py-14">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">

      {{-- Countdown --}}
      <div class="text-center lg:text-left">
        <p class="text-red-200 text-xs font-bold uppercase tracking-widest mb-5">
          @if($activeTicket && $activeTicket->sales_end) {{ $activeTicket->name }} Price Ends In
          @else Registration Closes In @endif
        </p>
        <div class="flex gap-3 justify-center lg:justify-start" id="countdown-timer"
             data-deadline="{{ ($activeTicket?->sales_end ?? $registrationDeadline)?->toIso8601String() }}">
          <div class="cd-box"><div class="cd-num" id="cd-days">--</div><div class="cd-label">Days</div></div>
          <div class="cd-box"><div class="cd-num" id="cd-hours">--</div><div class="cd-label">Hrs</div></div>
          <div class="cd-box"><div class="cd-num" id="cd-mins">--</div><div class="cd-label">Min</div></div>
          <div class="cd-box"><div class="cd-num" id="cd-secs">--</div><div class="cd-label">Sec</div></div>
        </div>
      </div>

      {{-- Pricing snapshot --}}
      <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/15">
        @if($activeTicket)
        <div class="flex items-start justify-between mb-4">
          <div>
            <p class="text-red-200 text-xs font-bold uppercase tracking-widest">Current Price</p>
            <p class="text-4xl font-black mt-1">
              @if((float)$activeTicket->price === 0.0) Free
              @elseif($activeTicket->strike_price && (float)$activeTicket->strike_price > (float)$activeTicket->price)
                <span class="line-through text-2xl text-white/50">₦{{ number_format((float)$activeTicket->strike_price) }}</span>
                <br>
                <span class="text-green-400">Save {{ $activeTicket->discount_percent }}%</span>
                <br>
                ₦{{ number_format((float)$activeTicket->price) }}
              @else ₦{{ number_format((float)$activeTicket->price) }} @endif
            </p>
            <p class="text-red-200 text-sm mt-1">{{ $activeTicket->name }}</p>
          </div>
          @if($nextTicket && (float)$nextTicket->price > (float)$activeTicket->price)
          <div class="text-right">
            <p class="text-red-200 text-xs font-bold uppercase tracking-widest">Next Price</p>
            <p class="text-2xl font-black text-white/50 mt-1 line-through">₦{{ number_format((float)$nextTicket->price) }}</p>
            <p class="text-red-200 text-xs mt-0.5">{{ $nextTicket->name }}</p>
          </div>
          @endif
        </div>
        @if($nextTicket && $nextTicket->sales_start)
        <div class="flex items-center gap-2 py-3 border-t border-white/15 mb-4">
          <svg class="w-4 h-4 text-red-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
          <p class="text-sm text-red-100">Price increases to <strong>₦{{ number_format((float)$nextTicket->price) }}</strong> on {{ $nextTicket->sales_start->format('M d, Y') }}</p>
        </div>
        @endif
        @else
        <p class="text-red-100 mb-4">Check our ticket options below.</p>
        @endif
        {{-- COMMENTED OUT: Local registration - redirecting to Selar --}}
        {{-- <a href="#register" --}}
        <a href="https://selar.com/tscc2026"
           class="flex items-center justify-center gap-2 w-full bg-white text-red-700 hover:bg-red-50 font-bold py-3.5 rounded-xl transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
          Lock In This Price Now
        </a>
      </div>

    </div>
  </div>
</section>
@endif

{{-- ═══ SECTION 3 · WHY ATTEND ════════════════════════════════════════════════ --}}
@if(is_array($event->objectives) && count($event->objectives) > 0)
<section class="py-20 md:py-28 bg-white" id="why-attend">
  <div class="max-w-6xl mx-auto px-5 md:px-8">

    <div class="text-center mb-14 reveal">
      <div class="section-eyebrow justify-center">Why Attend</div>
      <h2 class="ep-display text-4xl md:text-5xl text-slate-900 font-bold mb-4 leading-tight">What You Will <em>Gain</em></h2>
      <p class="text-slate-500 max-w-lg mx-auto text-base">Every session is built to deliver tangible, career-transforming outcomes.</p>
    </div>

    @php $icons = ['award','brain','users','trending-up','star','zap','globe','heart','lightbulb','shield','check-circle','book-open']; @endphp
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
      @foreach($event->objectives as $i => $obj)
      <div class="benefit-card p-6 flex items-start gap-4 reveal" style="transition-delay: {{ $i * 40 }}ms">
        <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center flex-shrink-0">
          <i data-lucide="{{ $icons[$i % count($icons)] }}" class="w-5 h-5 text-red-600"></i>
        </div>
        <div class="pt-0.5">
          <p class="font-semibold text-slate-800 leading-snug">{{ $obj }}</p>
        </div>
      </div>
      @endforeach
    </div>

    @if($event->target_audience)
    <div class="mt-12 max-w-3xl mx-auto bg-gradient-to-br from-red-50 to-rose-50 border border-red-100 rounded-2xl p-7 text-center reveal">
      <div class="section-eyebrow justify-center text-red-600">Who Should Attend</div>
      <p class="text-slate-700 leading-relaxed text-base">{{ $event->target_audience }}</p>
    </div>
    @endif

  </div>
</section>
@endif

{{-- ═══ SECTION 4 · SPEAKERS ══════════════════════════════════════════════════ --}}
@if($allSpeakers->count() > 0)
<section class="py-20 md:py-28 bg-slate-50" id="speakers">
  <div class="max-w-6xl mx-auto px-5 md:px-8">

    <div class="text-center mb-14 reveal">
      <div class="section-eyebrow justify-center">Speakers</div>
      <h2 class="ep-display text-4xl md:text-5xl text-slate-900 font-bold mb-4">Meet the Experts</h2>
      <p class="text-slate-500 max-w-lg mx-auto">Industry leaders sharing actionable insights you can apply immediately.</p>
    </div>

    {{-- Featured speakers --}}
    @if($featuredSpeakers->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
      @foreach($featuredSpeakers as $speaker)
      <div class="speaker-card group h-80 bg-slate-200 reveal relative overflow-hidden rounded-3xl cursor-pointer">
        @if($speaker->photo)
        <img src="{{ asset($speaker->photo) }}" alt="{{ $speaker->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" loading="lazy">
        @else
        <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center transition-transform duration-700 group-hover:scale-110">
          <i data-lucide="user" class="w-20 h-20 text-slate-400"></i>
        </div>
        @endif
        
        <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-black px-3 py-1 rounded-full uppercase tracking-wide z-20">Featured</span>
        
        {{-- Always visible bottom gradient --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent z-10 pointer-events-none opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>

        <div class="absolute inset-x-0 bottom-0 p-5 z-20 flex flex-col justify-end">
          {{-- Biography and socials that expand on hover --}}
          <div class="grid grid-rows-[0fr] group-hover:grid-rows-[1fr] transition-all duration-500 ease-in-out">
            <div class="overflow-hidden">
              @if($speaker->biography)
              <p class="text-white/90 text-sm leading-relaxed line-clamp-3 mb-3">{{ $speaker->biography }}</p>
              @endif
              <div class="flex gap-2 mb-3">
                @if(isset($speaker->social_links['linkedin']) && $speaker->social_links['linkedin'])
                <a href="{{ $speaker->social_links['linkedin'] }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors backdrop-blur-sm pointer-events-auto">
                  <i data-lucide="linkedin" class="w-4 h-4 text-white"></i>
                </a>
                @endif
                @if(isset($speaker->social_links['twitter']) && $speaker->social_links['twitter'])
                <a href="{{ $speaker->social_links['twitter'] }}" target="_blank" class="w-8 h-8 rounded-full bg-white/20 hover:bg-white/40 flex items-center justify-center transition-colors backdrop-blur-sm pointer-events-auto">
                  <i data-lucide="twitter" class="w-4 h-4 text-white"></i>
                </a>
                @endif
              </div>
            </div>
          </div>

          {{-- Always visible name and title --}}
          <div>
            <h3 class="text-white font-bold text-lg leading-tight">{{ $speaker->name }}</h3>
            @if($speaker->title)<p class="text-red-300 text-sm font-medium">{{ $speaker->title }}</p>@endif
            @if($speaker->organization)<p class="text-white/50 text-xs">{{ $speaker->organization }}</p>@endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif

    {{-- Other speakers --}}
    @php $otherSpeakers = $allSpeakers->filter(fn($s) => !$s->is_featured); @endphp
    @if($otherSpeakers->count() > 0)
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
      @foreach($otherSpeakers as $speaker)
      <div class="text-center reveal">
        <div class="speaker-card h-36 mb-3 rounded-2xl">
          @if($speaker->photo)
          <img src="{{ asset($speaker->photo) }}" alt="{{ $speaker->name }}" loading="lazy">
          @else
          <div class="w-full h-full bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
            <i data-lucide="user" class="w-10 h-10 text-slate-400"></i>
          </div>
          @endif
        </div>
        <h4 class="font-bold text-slate-900 text-sm">{{ $speaker->name }}</h4>
        @if($speaker->title)<p class="text-red-600 text-xs mt-0.5">{{ $speaker->title }}</p>@endif
        @if($speaker->organization)<p class="text-slate-400 text-xs">{{ Str::limit($speaker->organization, 22) }}</p>@endif
      </div>
      @endforeach
    </div>
    @endif

  </div>
</section>
@endif

{{-- ═══ SECTION 5 · PROGRAMME ═════════════════════════════════════════════════ --}}
@if($sessionsByDay->count() > 0)
<section class="py-20 md:py-28 bg-white" id="programme">
  <div class="max-w-6xl mx-auto px-5 md:px-8">

    <div class="text-center mb-14 reveal">
      <div class="section-eyebrow justify-center">Programme</div>
      <h2 class="ep-display text-4xl md:text-5xl text-slate-900 font-bold mb-4">Event Schedule</h2>
      <p class="text-slate-500 max-w-lg mx-auto">A curated programme designed to maximise learning and professional networking.</p>
    </div>

    {{-- Day switcher --}}
    @if($sessionsByDay->count() > 1)
    <div class="flex overflow-x-auto gap-2 mb-10 pb-1 justify-center" style="scrollbar-width:none">
      @foreach($sessionsByDay as $dayKey => $daySessions)
      <button onclick="switchDay('{{ $dayKey }}')"
              class="day-tab flex-none px-5 py-2.5 rounded-full text-sm font-semibold border-2 transition-all whitespace-nowrap {{ $loop->first ? 'bg-red-600 text-white border-red-600' : 'bg-white text-slate-600 border-slate-200 hover:border-red-300' }}"
              data-day="{{ $dayKey }}">
        {{ \Carbon\Carbon::parse($dayKey)->format('D, M d') }}
      </button>
      @endforeach
    </div>
    @endif

    {{-- Session list --}}
    @foreach($sessionsByDay as $dayKey => $daySessions)
    <div class="day-schedule max-w-4xl mx-auto" id="day-{{ $dayKey }}" style="{{ !$loop->first ? 'display:none' : '' }}">
      <div class="space-y-3">
        @foreach($daySessions as $session)
        <div class="group flex gap-0 rounded-2xl border border-slate-100 hover:border-slate-200 hover:shadow-md overflow-hidden bg-white transition-all">

          {{-- Time column --}}
          <div class="w-20 md:w-24 flex-shrink-0 flex flex-col items-center justify-center py-5 px-3 bg-slate-50 border-r border-slate-100 text-center">
            @if($session->start_time)
            <p class="text-sm font-bold text-slate-700 leading-none">{{ \Carbon\Carbon::parse($session->start_time)->format('h:i') }}</p>
            <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($session->start_time)->format('A') }}</p>
            @if($session->end_time)
            <div class="w-px h-4 bg-slate-200 my-1"></div>
            <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($session->end_time)->format('h:i A') }}</p>
            @endif
            @else
            <p class="text-xs text-slate-400">TBA</p>
            @endif
          </div>

          {{-- Content --}}
          <div class="flex-1 p-5">
            <div class="flex flex-wrap items-center gap-2 mb-2">
              <span class="track-{{ $session->category }} text-xs font-bold px-2.5 py-0.5 rounded-full border capitalize">{{ $session->category }}</span>
              @if($session->venue_room)
              <span class="text-xs text-slate-400 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                {{ $session->venue_room }}
              </span>
              @endif
            </div>
            <h4 class="font-bold text-slate-900 text-base leading-snug mb-1">{{ $session->title }}</h4>
            @if($session->description)
            <p class="text-sm text-slate-500 line-clamp-2 mb-2">{{ $session->description }}</p>
            @endif
            @if($session->speaker)
            <div class="flex items-center gap-2 mt-2">
              @if($session->speaker->photo)
              <img src="{{ asset($session->speaker->photo) }}" alt="{{ $session->speaker->name }}" class="w-6 h-6 rounded-full object-cover ring-1 ring-slate-200" loading="lazy">
              @endif
              <span class="text-xs font-semibold text-red-600">{{ $session->speaker->name }}</span>
              @if($session->speaker->organization)
              <span class="text-xs text-slate-400">· {{ $session->speaker->organization }}</span>
              @endif
            </div>
            @endif
          </div>

        </div>
        @endforeach
      </div>
    </div>
    @endforeach

  </div>
</section>
@endif

{{-- ═══ SECTION 6 · SOCIAL PROOF STATS ══════════════════════════════════════ --}}
@if($totalRegistrations > 0 || $allSpeakers->count() > 0)
<section class="py-16 bg-slate-950" id="social-proof">
  <div class="max-w-6xl mx-auto px-5 md:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-white/8">
      @if($totalRegistrations > 0)
      <div class="stat-card">
        <p class="stat-num text-4xl md:text-5xl font-black text-white mb-1">{{ number_format($totalRegistrations) }}<span class="text-red-500">+</span></p>
        <p class="text-slate-500 text-sm font-medium">Registrations</p>
      </div>
      @endif
      @if($allSpeakers->count() > 0)
      <div class="stat-card">
        <p class="stat-num text-4xl md:text-5xl font-black text-white mb-1">{{ $allSpeakers->count() }}</p>
        <p class="text-slate-500 text-sm font-medium">Expert Speakers</p>
      </div>
      @endif
      @php $totalSessions = $sessionsByDay->sum(fn($d) => $d->count()); @endphp
      @if($totalSessions > 0)
      <div class="stat-card">
        <p class="stat-num text-4xl md:text-5xl font-black text-white mb-1">{{ $totalSessions }}</p>
        <p class="text-slate-500 text-sm font-medium">Sessions</p>
      </div>
      @endif
      @if($event->ticketTypes->count() > 0)
      <div class="stat-card">
        <p class="stat-num text-4xl md:text-5xl font-black text-white mb-1">{{ $event->ticketTypes->count() }}</p>
        <p class="text-slate-500 text-sm font-medium">Ticket Options</p>
      </div>
      @endif
    </div>
  </div>
</section>
@endif

{{-- ═══ SECTION 7 · TESTIMONIALS ══════════════════════════════════════════════ --}}
@php
$testimonials = [
  ['name'=>'Adaeze Okonkwo','role'=>'School Counsellor, Lagos','quote'=>'TSCC completely transformed how I approach student wellbeing. The speakers were exceptional and the networking opportunities invaluable.','initials'=>'AO','color'=>'from-red-500 to-rose-600'],
  ['name'=>'Dr. Emeka Nwachukwu','role'=>'Psychologist, Abuja','quote'=>'The quality of sessions at TSCC surpassed any conference I have attended in years. I left with actionable frameworks I applied immediately.','initials'=>'EN','color'=>'from-blue-500 to-indigo-600'],
  ['name'=>'Ngozi Eze','role'=>'Head of Counselling, Rivers State','quote'=>'Attending TSCC was a turning point for our school counselling programme. The community you build here stays with you long after the event.','initials'=>'NE','color'=>'from-emerald-500 to-teal-600'],
];
@endphp
<section class="py-20 md:py-28 bg-white" id="testimonials">
  <div class="max-w-6xl mx-auto px-5 md:px-8">

    <div class="text-center mb-14 reveal">
      <div class="section-eyebrow justify-center">Testimonials</div>
      <h2 class="ep-display text-4xl md:text-5xl text-slate-900 font-bold mb-4">Voices From Our Community</h2>
    </div>

    <div class="relative overflow-hidden" id="testi-carousel">
      <div class="testi-track" id="testi-track">
        @foreach($testimonials as $t)
        <div class="testi-slide px-4">
          <div class="max-w-2xl mx-auto">
            <div class="bg-slate-50 border border-slate-100 rounded-3xl p-8 md:p-12 text-center">
              {{-- Stars --}}
              <div class="flex justify-center gap-1 mb-6">
                @for($s=0;$s<5;$s++)
                <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
              </div>
              <blockquote class="text-slate-700 text-lg md:text-xl leading-relaxed italic mb-8 font-medium">
                "{{ $t['quote'] }}"
              </blockquote>
              <div class="flex items-center justify-center gap-3">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br {{ $t['color'] }} text-white font-bold text-sm flex items-center justify-center shadow-lg">{{ $t['initials'] }}</div>
                <div class="text-left">
                  <p class="font-bold text-slate-900">{{ $t['name'] }}</p>
                  <p class="text-slate-500 text-sm">{{ $t['role'] }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="flex justify-center items-center gap-4 mt-8">
        <button onclick="prevTesti()" class="w-10 h-10 rounded-full border-2 border-slate-200 hover:border-red-300 hover:bg-red-50 flex items-center justify-center transition-all">
          <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <div class="flex gap-2 items-center" id="testi-dots">
          @foreach($testimonials as $ti => $t)
          <button onclick="goTesti({{ $ti }})" class="testi-dot rounded-full transition-all {{ $ti === 0 ? 'w-6 h-2.5 bg-red-600' : 'w-2.5 h-2.5 bg-slate-200' }}"></button>
          @endforeach
        </div>
        <button onclick="nextTesti()" class="w-10 h-10 rounded-full border-2 border-slate-200 hover:border-red-300 hover:bg-red-50 flex items-center justify-center transition-all">
          <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
      </div>
    </div>

  </div>
</section>

{{-- ═══ SECTION 8 · TICKETS ════════════════════════════════════════════════════ --}}
@if($event->ticketTypes->count() > 0)
<section class="py-20 md:py-28 bg-slate-50" id="tickets">
  <div class="max-w-6xl mx-auto px-5 md:px-8">

    <div class="text-center mb-14 reveal">
      <div class="section-eyebrow justify-center">Tickets</div>
      <h2 class="ep-display text-4xl md:text-5xl text-slate-900 font-bold mb-4">Choose Your Pass</h2>
      <p class="text-slate-500 max-w-xl mx-auto">Prices increase as the event date approaches. Register early to save.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 max-w-5xl mx-auto">
      @foreach($event->ticketTypes as $ticket)
      @php
        $isSoldOut   = $ticket->is_sold_out;
        $isOnSale    = $ticket->is_on_sale;
        $isScheduled = $ticket->status === 'scheduled';
        $isEnded     = $ticket->status === 'ended';
        $isVip       = $ticket->type === 'vip';
        $isEarlyBird = $ticket->type === 'early_bird';
      @endphp
      <div class="ticket-card {{ $isVip ? 'is-featured' : '' }} {{ $isSoldOut ? 'is-sold-out' : '' }} reveal">

        {{-- Card header --}}
        <div class="p-6 {{ $isVip ? 'bg-gradient-to-br from-red-600 to-rose-700 text-white' : 'bg-white border-b border-slate-100' }}">
          <div class="flex items-start justify-between mb-5">
            <div>
              <h3 class="text-xl font-bold {{ $isVip ? 'text-white' : 'text-slate-900' }}">{{ $ticket->name }}</h3>
              @if($ticket->type)
              <span class="inline-block mt-1.5 text-xs font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full
                {{ $isEarlyBird ? 'bg-amber-100 text-amber-700' : ($isVip ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-500') }}">
                {{ str_replace('_', ' ', $ticket->type) }}
              </span>
              @endif
            </div>
            @if($isSoldOut)
              <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-red-100 text-red-600">Sold Out</span>
            @elseif($isOnSale)
              <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $isVip ? 'bg-white/20 text-white' : 'bg-green-100 text-green-700' }} flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full {{ $isVip ? 'bg-white' : 'bg-green-500' }} animate-pulse inline-block"></span>
                On Sale
              </span>
            @elseif($isScheduled)
              <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">Opens {{ $ticket->sales_start?->format('M d') }}</span>
            @elseif($isEnded)
              <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-500">Sale Ended</span>
            @endif
          </div>

          {{-- Price --}}
          <div class="flex items-baseline gap-1 mb-1">
            @if((float)$ticket->price === 0.0)
            <span class="text-5xl font-black {{ $isVip ? 'text-white' : 'text-slate-900' }}">Free</span>
            @else
            @if($ticket->strike_price && (float)$ticket->strike_price > (float)$ticket->price)
            {{-- Show strike price with discount --}}
            <div class="flex items-start gap-3 mb-2">
              <div>
                <div class="flex items-baseline gap-2">
                  <span class="text-sm font-semibold {{ $isVip ? 'text-white/60' : 'text-slate-400' }} line-through">₦{{ number_format((float)$ticket->strike_price) }}</span>
                  <span class="inline-block px-2.5 py-1 rounded-lg {{ $isVip ? 'bg-white/20' : 'bg-green-100' }} font-bold text-xs {{ $isVip ? 'text-white' : 'text-green-700' }}">
                    Save {{ $ticket->discount_percent }}%
                  </span>
                </div>
                <div class="flex items-baseline gap-1 mt-2">
                  <span class="text-2xl font-bold {{ $isVip ? 'text-white/70' : 'text-slate-400' }}">₦</span>
                  <span class="text-5xl font-black {{ $isVip ? 'text-white' : 'text-slate-900' }}">{{ number_format((float)$ticket->price) }}</span>
                </div>
              </div>
            </div>
            @else
            {{-- No strike price, show regular price --}}
            <span class="text-2xl font-bold {{ $isVip ? 'text-white/70' : 'text-slate-400' }}">₦</span>
            <span class="text-5xl font-black {{ $isVip ? 'text-white' : 'text-slate-900' }}">{{ number_format((float)$ticket->price) }}</span>
            @endif
            @endif
          </div>

          {{-- Compliance: Service Fee & Total Payable Breakdown --}}
          @if((float)$ticket->price > 0)
          @php
            $serviceFee = 500; // Example fixed platform/service fee
            $totalPayable = (float)$ticket->price + $serviceFee;
          @endphp
          <div class="mt-4 pt-4 border-t {{ $isVip ? 'border-white/20' : 'border-slate-200' }}">
            <div class="flex justify-between items-center text-sm mb-1.5 {{ $isVip ? 'text-white/80' : 'text-slate-500' }}">
              <span>Base Price:</span>
              <span class="font-medium">₦{{ number_format((float)$ticket->price) }}</span>
            </div>
            <div class="flex justify-between items-center text-sm mb-2 {{ $isVip ? 'text-white/80' : 'text-slate-500' }}">
              <span>Service Fee:</span>
              <span class="font-medium">₦{{ number_format($serviceFee) }}</span>
            </div>
            <div class="flex justify-between items-center text-base font-bold {{ $isVip ? 'text-white' : 'text-slate-900' }}">
              <span>Total Payable:</span>
              <span>₦{{ number_format($totalPayable) }}</span>
            </div>
          </div>
          @else
          <div class="mt-4 pt-4 border-t border-slate-200">
            <div class="flex justify-between items-center text-base font-bold text-green-600">
              <span>Total Payable:</span>
              <span>₦0 (Free)</span>
            </div>
          </div>
          @endif
          @if($ticket->team_size)
          <p class="text-xs {{ $isVip ? 'text-white/60' : 'text-slate-400' }} mt-1">Per team of {{ $ticket->team_size }} members</p>
          @endif
          @if($ticket->description)
          <p class="text-sm {{ $isVip ? 'text-white/75' : 'text-slate-500' }} mt-3 leading-relaxed">{{ $ticket->description }}</p>
          @endif
          @if($ticket->sales_start || $ticket->sales_end)
          <div class="mt-3 text-xs {{ $isVip ? 'text-white/50' : 'text-slate-400' }} flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            @if($ticket->sales_start && $ticket->sales_end)
              {{ $ticket->sales_start->format('M d') }} – {{ $ticket->sales_end->format('M d, Y') }}
            @elseif($ticket->sales_end)
              Ends {{ $ticket->sales_end->format('M d, Y') }}
            @endif
          </div>
          @endif
        </div>

        {{-- Benefits + CTA --}}
        <div class="p-6 bg-white flex-1 flex flex-col">
          @if(is_array($ticket->benefits) && count($ticket->benefits) > 0)
          <ul class="space-y-2.5 mb-6 flex-1">
            @foreach($ticket->benefits as $benefit)
            <li class="flex items-start gap-2.5 text-sm text-slate-700">
              <svg class="w-4 h-4 text-green-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
              {{ $benefit }}
            </li>
            @endforeach
          </ul>
          @else
          <div class="flex-1"></div>
          @endif

          {{-- Scarcity bar --}}
          @if($ticket->quantity_available && !$isSoldOut)
          @php $pct = min(100, ($ticket->quantity_sold / $ticket->quantity_available) * 100); @endphp
          <div class="mb-5">
            <div class="flex justify-between text-xs text-slate-500 mb-1.5">
              <span class="font-medium text-{{ $pct > 80 ? 'red' : 'slate' }}-600">{{ $ticket->available_count }} spots left</span>
              <span>{{ round($pct) }}% filled</span>
            </div>
            <div class="scarcity-bar">
              <div class="scarcity-bar-fill" style="width: {{ $pct }}%"></div>
            </div>
          </div>
          @endif

          {{-- CTA --}}
          @if($event->status === 'registration_open' && $isOnSale && !$isSoldOut)
          {{-- COMMENTED OUT: Local ticket registration - redirecting to Selar --}}
          {{-- <a href="#register" onclick="selectTicket({{ $ticket->id }})" --}}
          <a href="https://selar.com/tscc2026"
             class="flex items-center justify-center gap-2 w-full py-3.5 rounded-2xl font-bold text-sm transition-all
                    {{ $isVip ? 'bg-red-600 hover:bg-red-700 text-white shadow-lg shadow-red-500/30 hover:-translate-y-0.5' : 'bg-slate-900 hover:bg-slate-800 text-white hover:-translate-y-0.5' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
            Get This Ticket
          </a>
          @elseif($isSoldOut)
          <button disabled class="w-full py-3.5 rounded-2xl font-bold text-sm bg-slate-100 text-slate-400 cursor-not-allowed">Sold Out</button>
          @elseif($isScheduled)
          <button disabled class="w-full py-3.5 rounded-2xl font-bold text-sm bg-blue-50 text-blue-400 cursor-not-allowed flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Opens {{ $ticket->sales_start?->format('M d') }}
          </button>
          @elseif($isEnded)
          <button disabled class="w-full py-3.5 rounded-2xl font-bold text-sm bg-slate-100 text-slate-400 cursor-not-allowed">Sale Ended</button>
          @else
          <a href="#register" class="flex items-center justify-center gap-2 w-full py-3.5 rounded-2xl font-bold text-sm bg-slate-900 hover:bg-slate-800 text-white transition-all hover:-translate-y-0.5">Register Now</a>
          @endif

        </div>
      </div>
      @endforeach
    </div>

    @if($event->status !== 'registration_open')
    <p class="text-center text-slate-500 mt-10 text-sm">Registration is currently <strong>{{ str_replace('_', ' ', $event->status) }}</strong>.</p>
    @endif

  </div>
</section>
@endif

{{-- ═══ SECTION 9 · REGISTRATION FORM ════════════════════════════════════════
     COMMENTED OUT: Using Selar for ticket sales (Third-party platform)
     Redirect button pointing to: https://selar.com/tscc2026
══════════════════════════════════════════════════════════════════════════════ --}}
@if($event->status === 'registration_open' || $showWaitlist)
<section id="register" class="py-20 md:py-28 relative overflow-hidden"
         style="background: linear-gradient(135deg, #0a0f1e 0%, #0f172a 60%, #1a0a0a 100%)">
  {{-- Background texture --}}
  <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(ellipse at 30% 50%, rgba(220,38,38,0.15) 0%, transparent 60%), radial-gradient(ellipse at 80% 20%, rgba(220,38,38,0.08) 0%, transparent 50%);"></div>
  <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-red-600/60 to-transparent"></div>

  <div class="relative z-10 max-w-6xl mx-auto px-5 md:px-8">
    {{-- SELAR REDIRECT NOTICE --}}
    <div class="text-center max-w-2xl mx-auto mb-12 py-12 px-8 bg-white/5 border border-white/10 rounded-3xl backdrop-blur-sm">
      <div class="mb-6">
        <svg class="w-16 h-16 mx-auto text-red-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
      </div>
      <h2 class="text-3xl font-bold text-white mb-3">Tickets Now on Selar! 🎟️</h2>
      <p class="text-slate-300 text-lg mb-8">We've moved ticket sales to <strong>Selar</strong> for a better purchasing experience. Click the button below to complete your registration.</p>
      
      <a href="https://selar.com/tscc2026" class="inline-flex items-center gap-3 bg-red-600 hover:bg-red-700 text-white font-bold text-lg px-8 py-4 rounded-xl transition-all hover:-translate-y-0.5 shadow-lg shadow-red-600/40 mb-6">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        Proceed to Selar to Buy Tickets
      </a>
      
      <p class="text-slate-400 text-sm">✓ Secure payment processing  ✓ Instant ticket delivery  ✓ Mobile-friendly checkout</p>
    </div>

    {{-- OLD FORM COMMENTED OUT --}}
    <!-- 
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16 items-start">

      {{-- LEFT: Trust signals --}}
      <div class="lg:col-span-2 text-white">
        @if($showWaitlist)
        <div class="section-eyebrow text-amber-400">Join the Waitlist</div>
        <h2 class="ep-display text-4xl md:text-5xl font-bold text-white leading-tight mb-6">
          Be First in Line
        </h2>
        <p class="text-slate-400 text-base leading-relaxed mb-10">
          Tickets will be available soon. Join our waitlist now and we'll notify you the moment registration opens. Early joiners get priority!
        </p>

        {{-- Waitlist benefits --}}
        <div class="space-y-5">
          @foreach([
            ['icon'=>'bell','title'=>'Instant Notification','desc'=>'Be the first to know when tickets become available.'],
            ['icon'=>'zap','title'=>'Priority Access','desc'=>'Waitlist members get early access before general registration.'],
            ['icon'=>'shield-check','title'=>'No Commitment','desc'=>'Joining the waitlist doesn\'t obligate you to purchase.'],
          ] as $tp)
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-amber-900/40 border border-amber-800/30 flex items-center justify-center flex-shrink-0">
              <i data-lucide="{{ $tp['icon'] }}" class="w-5 h-5 text-amber-400"></i>
            </div>
            <div>
              <p class="font-semibold text-white text-sm">{{ $tp['title'] }}</p>
              <p class="text-slate-500 text-sm mt-0.5">{{ $tp['desc'] }}</p>
            </div>
          </div>
          @endforeach
        </div>

        {{-- Waitlist stats --}}
        <div class="mt-8 p-5 rounded-2xl bg-amber-900/20 border border-amber-800/30">
          <p class="text-amber-400 font-bold text-lg mb-1">Don't Miss Out!</p>
          <p class="text-slate-400 text-sm">{{ $totalRegistrations }}+ educators have already joined. Secure your spot on the waitlist today.</p>
        </div>
        @else
        <div class="section-eyebrow text-red-400">Register Now</div>
        <h2 class="ep-display text-4xl md:text-5xl font-bold text-white leading-tight mb-6">
          Your seat is waiting.
        </h2>
        <p class="text-slate-400 text-base leading-relaxed mb-10">
          Join hundreds of educators, counsellors, and wellbeing professionals who are shaping the future of mental health in schools.
        </p>

        {{-- Trust points --}}
        <div class="space-y-5">
          @foreach([
            ['icon'=>'shield-check','title'=>'Secure Registration','desc'=>'Your data is encrypted and never shared with third parties.'],
            ['icon'=>'mail','title'=>'Instant Confirmation','desc'=>'Your ticket and QR code arrive in your inbox immediately.'],
            ['icon'=>'clock','title'=>'Limited Spots','desc'=>'Registration closes once capacity is reached. Don\'t wait.'],
          ] as $tp)
          <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-xl bg-red-900/40 border border-red-800/30 flex items-center justify-center flex-shrink-0">
              <i data-lucide="{{ $tp['icon'] }}" class="w-5 h-5 text-red-400"></i>
            </div>
            <div>
              <p class="font-semibold text-white text-sm">{{ $tp['title'] }}</p>
              <p class="text-slate-500 text-sm mt-0.5">{{ $tp['desc'] }}</p>
            </div>
          </div>
          @endforeach
        </div>
        @endif

        {{-- Active ticket --}}
        @if($activeTicket)
        <div class="mt-10 p-5 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-sm">
          <p class="text-xs font-bold uppercase tracking-widest text-slate-500 mb-3">Current Offer</p>
          <div class="flex items-center justify-between">
            <div>
              <p class="font-bold text-white text-lg">{{ $activeTicket->formatted_price }}</p>
              <p class="text-slate-400 text-sm">{{ $activeTicket->name }}</p>
            </div>
            @if($activeTicket->sales_end)
            <div class="text-right">
              <p class="text-xs text-amber-400 font-semibold">Ends {{ $activeTicket->sales_end->format('M d, Y') }}</p>
            </div>
            @endif
          </div>
        </div>
        @endif
      </div>

      {{-- RIGHT: Form card --}}
      <div class="lg:col-span-3">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

          {{-- Form header --}}
          @if($showWaitlist)
          <div class="bg-gradient-to-r from-amber-600 to-amber-500 px-8 py-7">
            <h3 class="font-bold text-white text-xl">Join the Waitlist for <span class="italic">{{ $event->name }}</span></h3>
            <p class="text-amber-100 text-sm mt-1">Be notified as soon as tickets become available. It's quick and free!</p>
          </div>
          @else
          <div class="bg-gradient-to-r from-red-700 to-red-600 px-8 py-7">
            <h3 class="font-bold text-white text-xl">Register for <span class="italic">{{ $event->name }}</span></h3>
            <p class="text-red-200 text-sm mt-1">Complete the form below to secure your place.</p>
          </div>
          @endif

          {{-- Errors --}}
          @if($errors->any())
          <div class="mx-8 mt-6 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-800">
            <p class="font-bold text-sm mb-2 flex items-center gap-2">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
              Please fix the following:
            </p>
            <ul class="list-disc list-inside text-sm space-y-1">
              @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
          </div>
          @endif

          {{-- Form body --}}
          <form action="{{ route('event.register', $event->slug) }}" method="POST" id="registration-form" class="p-8 space-y-6">
            @csrf
            <input type="hidden" name="utm_source"   value="{{ request('utm_source') }}">
            <input type="hidden" name="utm_medium"   value="{{ request('utm_medium') }}">
            <input type="hidden" name="utm_campaign" value="{{ request('utm_campaign') }}">
            <input type="hidden" name="ref"          value="{{ request('ref') }}">

            {{-- Step 1: Ticket selector (only for registration, not waitlist) --}}
            @if(!$showWaitlist)
            <div>
              <p class="ep-label mb-3">Select Your Ticket <span class="text-red-500">*</span></p>
              <div class="space-y-3" id="ticket-selector">
                @foreach($event->ticketTypes as $ticket)
                @if($ticket->is_on_sale && !$ticket->is_sold_out)
                <label class="ticket-radio-item flex items-center gap-4 {{ old('ticket_type_id') == $ticket->id ? 'is-selected' : '' }}"
                       id="ticket-label-{{ $ticket->id }}"
                       onclick="selectRadioUI({{ $ticket->id }})">
                  <input type="radio" name="ticket_type_id" value="{{ $ticket->id }}"
                         {{ old('ticket_type_id') == $ticket->id ? 'checked' : '' }} required>
                  <div class="ticket-radio-dot"></div>
                  <div class="flex-1 min-w-0">
                    <p class="font-bold text-slate-900 text-sm">{{ $ticket->name }}</p>
                    @if($ticket->description)
                    <p class="text-xs text-slate-500 mt-0.5 line-clamp-1">{{ $ticket->description }}</p>
                    @endif
                    @if($ticket->sales_end)
                    <p class="text-xs text-amber-600 mt-1 font-semibold">
                      Sale ends {{ $ticket->sales_end->format('M d, Y') }}
                    </p>
                    @endif
                  </div>
                  <div class="text-right flex-shrink-0">
                    <p class="font-black text-lg text-slate-900">{{ $ticket->formatted_price }}</p>
                    @if($ticket->team_size)
                    <p class="text-xs text-slate-400">Team of {{ $ticket->team_size }}</p>
                    @endif
                  </div>
                </label>
                @endif
                @endforeach
              </div>
            </div>
            @else
            {{-- Waitlist message --}}
            <div class="p-5 bg-amber-50 border border-amber-200 rounded-2xl">
              <p class="text-amber-900 font-semibold text-sm mb-2">📅 Tickets Coming Soon!</p>
              <p class="text-amber-800 text-sm leading-relaxed">
                We'll send you an email notification as soon as {{ $event->name }} tickets go on sale. Be the first to register by joining the waitlist!
              </p>
            </div>
            @endif

            {{-- Divider --}}
            <div class="border-t border-slate-100 pt-6">
              <p class="ep-label text-xs uppercase tracking-widest text-slate-400 mb-5">Your Details</p>

              {{-- Name row --}}
              <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                  <label class="ep-label">First Name <span class="text-red-500">*</span></label>
                  <input type="text" name="first_name" required value="{{ old('first_name') }}" placeholder="Jane" class="ep-input">
                </div>
                <div>
                  <label class="ep-label">Last Name <span class="text-red-500">*</span></label>
                  <input type="text" name="last_name" required value="{{ old('last_name') }}" placeholder="Doe" class="ep-input">
                </div>
              </div>

              {{-- Email --}}
              <div class="mb-4">
                <label class="ep-label">Email Address <span class="text-red-500">*</span></label>
                <input type="email" name="email" required value="{{ old('email') }}" placeholder="jane@example.com" class="ep-input">
                <p class="ep-hint">Your ticket & QR code will be sent here.</p>
              </div>

              {{-- Phone --}}
              <div class="mb-4">
                <label class="ep-label">Phone Number</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+234 800 000 0000" class="ep-input">
              </div>

              {{-- Organisation + Role --}}
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="ep-label">Organisation / School</label>
                  <input type="text" name="organization" value="{{ old('organization') }}" placeholder="Your organisation" class="ep-input">
                </div>
                <div>
                  <label class="ep-label">Profession / Role</label>
                  <input type="text" name="profession" value="{{ old('profession') }}" placeholder="e.g. School Counsellor" class="ep-input">
                </div>
              </div>
            </div>

            {{-- Ticket prices map for JS --}}
            <script id="ticket-prices-data" type="application/json">
            {!! json_encode(
                $event->ticketTypes
                    ->where('is_active', true)
                    ->mapWithKeys(fn($t) => [$t->id => ['price' => $t->price, 'label' => $t->formatted_price, 'currency' => $t->currency]])
            ) !!}
            </script>

            {{-- Submit --}}
            @if($showWaitlist)
            <button type="submit" id="register-btn"
                    class="w-full bg-amber-600 hover:bg-amber-700 text-white font-bold text-base py-4 rounded-2xl transition-all shadow-xl shadow-amber-600/25 hover:shadow-amber-600/40 flex items-center justify-center gap-3 mt-2 hover:-translate-y-0.5 active:translate-y-0">
              <span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
              </span>
              <span id="register-btn-label">Join the Waitlist</span>
            </button>
            @else
            <button type="submit" id="register-btn"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold text-base py-4 rounded-2xl transition-all shadow-xl shadow-red-600/25 hover:shadow-red-600/40 flex items-center justify-center gap-3 mt-2 hover:-translate-y-0.5 active:translate-y-0">
              <span id="btn-icon-check">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              </span>
              <span id="btn-icon-pay" class="hidden">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
              </span>
              <span id="register-btn-label">Complete Registration</span>
            </button>
            @endif

            {{-- Secure badges --}}
            <div id="paystack-badge" class="hidden text-center">
              <p class="text-xs text-slate-400 flex items-center justify-center gap-1.5 mt-1">
                <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Secured by Paystack · 256-bit SSL
              </p>
            </div>
            <p id="ssl-badge" class="text-center text-xs text-slate-400 flex items-center justify-center gap-1.5">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
              256-bit SSL secure. Your info stays private.
            </p>
          </form>


        </div>

        {{-- WhatsApp help link --}}
        <div class="text-center mt-6">
          <p class="text-slate-500 text-sm mb-3">Having trouble? We're here to help.</p>
          <a href="https://wa.me/2349056057502?text=Hi,%20I%20need%20help%20registering%20for%20{{ urlencode($event->name) }}"
             target="_blank" rel="noopener"
             class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-2.5 rounded-full transition-colors text-sm shadow-lg shadow-green-500/25">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Chat on WhatsApp
          </a>
        </div>
      </div>

    --> <!-- END OF COMMENTED OUT REGISTRATION FORM -->
    </div>
  </div>
</section>
@endif

{{-- ═══ SECTION 10 · SPONSORS ══════════════════════════════════════════════════ --}}
@if($sponsorsByTier->count() > 0)
<section class="py-16 md:py-20 bg-white" id="sponsors">
  <div class="max-w-6xl mx-auto px-5 md:px-8">
    <div class="text-center mb-12 reveal">
      <div class="section-eyebrow justify-center">Sponsors</div>
      <h2 class="ep-display text-3xl md:text-4xl text-slate-900 font-bold mb-3">Supported By</h2>
      <p class="text-slate-500 text-sm max-w-md mx-auto">We are grateful to our partners who help make this event possible.</p>
    </div>
    @php
    $tierLabels = ['platinum'=>'Platinum','gold'=>'Gold','silver'=>'Silver','bronze'=>'Bronze','supporting'=>'Supporting Partners'];
    $tierClasses = ['platinum'=>'tier-platinum','gold'=>'tier-gold','silver'=>'tier-silver','bronze'=>'tier-bronze','supporting'=>''];
    @endphp
    @foreach(['platinum','gold','silver','bronze','supporting'] as $tier)
    @if(isset($sponsorsByTier[$tier]) && $sponsorsByTier[$tier]->count() > 0)
    <div class="mb-10 reveal">
      <p class="text-center text-xs font-bold uppercase tracking-widest text-slate-300 mb-6">{{ $tierLabels[$tier] }}</p>
      <div class="flex flex-wrap justify-center items-center gap-8 md:gap-14">
        @foreach($sponsorsByTier[$tier] as $sponsor)
        <div class="{{ $tierClasses[$tier] }} grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all duration-300">
          @if($sponsor->logo)
            @if($sponsor->website_url)
            <a href="{{ $sponsor->website_url }}" target="_blank" rel="noopener"><img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}" class="object-contain" loading="lazy"></a>
            @else
            <img src="{{ asset($sponsor->logo) }}" alt="{{ $sponsor->name }}" class="object-contain" loading="lazy">
            @endif
          @else
          <span class="font-bold text-slate-600 text-sm px-5 py-2.5 border border-slate-200 rounded-xl">{{ $sponsor->name }}</span>
          @endif
        </div>
        @endforeach
      </div>
    </div>
    @endif
    @endforeach
    <div class="text-center mt-6">
      <a href="#register" class="text-red-600 hover:text-red-700 font-semibold text-sm underline underline-offset-4 transition-colors">Interested in sponsoring? Get in touch →</a>
    </div>
  </div>
</section>
@endif

{{-- ═══ SECTION 11 · FAQ ═══════════════════════════════════════════════════════ --}}
@php
$faqs = [
  ['q'=>'Will certificates be issued?','a'=>'Yes. All confirmed attendees will receive a Certificate of Participation issued by The Ripple Effect Consult after the event.'],
  ['q'=>'Is virtual attendance available?','a'=>'Please check the ticket options above. A Virtual ticket type will be listed if virtual attendance is offered for this event.'],
  ['q'=>'Are tickets refundable?','a'=>'Tickets are generally non-refundable. However, you may transfer your ticket to another eligible person. Contact us via WhatsApp at least 48 hours before the event.'],
  ['q'=>'Can schools register groups?','a'=>'Yes. Select the Team Registration ticket type if available. For larger groups, please contact us directly to arrange a group rate.'],
  ['q'=>'How do I receive my ticket?','a'=>'Your ticket and unique QR code are sent immediately to your registered email address upon successful registration.'],
  ['q'=>'What if I registered but cannot attend?','a'=>'You may transfer your registration to a colleague. Contact us via WhatsApp with the full name and email of the new attendee.'],
];
@endphp
<section class="py-20 md:py-28 bg-slate-50" id="faq">
  <div class="max-w-6xl mx-auto px-5 md:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

      {{-- Left: Intro --}}
      <div class="lg:sticky lg:top-24">
        <div class="section-eyebrow">FAQ</div>
        <h2 class="ep-display text-4xl md:text-5xl text-slate-900 font-bold mb-5 leading-tight">Frequently Asked Questions</h2>
        <p class="text-slate-500 text-base leading-relaxed mb-8">Everything you need to know about {{ $event->name }}. Can't find what you're looking for?</p>
        <a href="https://wa.me/2349056057502" target="_blank" rel="noopener"
           class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-5 py-3 rounded-full transition-all shadow-lg shadow-green-500/25 text-sm">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
          Ask us on WhatsApp
        </a>
      </div>

      {{-- Right: Accordion --}}
      <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        @foreach($faqs as $i => $faq)
        <div class="faq-item" id="faqitem-{{ $i }}">
          <button onclick="toggleFaq({{ $i }})"
                  class="w-full flex items-center justify-between px-6 py-5 text-left hover:bg-slate-50/80 transition-colors">
            <span class="font-semibold text-slate-800 pr-4 text-sm md:text-base leading-snug">{{ $faq['q'] }}</span>
            <span class="faq-icon w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center flex-shrink-0 text-slate-500">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </span>
          </button>
          <div class="faq-body" id="faqbody-{{ $i }}">
            <p class="text-slate-600 text-sm leading-relaxed px-6 pb-5">{{ $faq['a'] }}</p>
          </div>
        </div>
        @endforeach
      </div>

    </div>
  </div>
</section>

{{-- ═══ SECTION 12 · FINAL CTA ═════════════════════════════════════════════════ --}}
<section class="py-20 md:py-32 relative overflow-hidden" style="background: #050a18">
  <div class="absolute inset-0" style="background: radial-gradient(ellipse at 50% 0%, rgba(220,38,38,0.2) 0%, transparent 60%)"></div>
  <div class="absolute inset-0" style="background: radial-gradient(ellipse at 100% 100%, rgba(220,38,38,0.1) 0%, transparent 50%)"></div>

  <div class="relative z-10 max-w-4xl mx-auto px-5 md:px-8 text-center">
    <div class="section-eyebrow justify-center text-red-400">Don't Miss Out</div>
    <h2 class="ep-display text-4xl md:text-6xl lg:text-7xl font-bold text-white leading-[1.05] mb-6">
      Join educators shaping<br><em class="text-red-400">the future.</em>
    </h2>
    <p class="text-slate-400 text-base md:text-lg max-w-xl mx-auto mb-10 leading-relaxed">
      {{ $event->name }} is where conversations begin that transform practice. Your seat is waiting.
    </p>

    <div class="flex flex-wrap gap-4 justify-center">
      @if($event->status === 'registration_open')
      <a href="#register"
         class="inline-flex items-center gap-3 bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-4 rounded-full text-lg transition-all shadow-2xl shadow-red-600/40 hover:-translate-y-1">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
        Register Now
        @if($activeTicket && (float)$activeTicket->price > 0)
        <span class="bg-red-700/60 rounded-full px-3 py-0.5 text-sm font-semibold text-red-200">₦{{ number_format((float)$activeTicket->price) }}</span>
        @endif
      </a>
      @endif
      @if(!empty($event->dates) && count($event->dates) > 0)
      <div class="inline-flex items-center gap-2 text-slate-500 text-sm py-4 px-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        @foreach($event->dates as $dt)
          {{ \Carbon\Carbon::parse($dt['date'])->format('l, F j, Y') }}@if(!$loop->last), @endif
        @endforeach
        @if(!empty($event->venues) && count($event->venues) > 0)
          · {{ collect($event->venues)->pluck('name')->join(', ') }}
        @elseif($event->venue_name) 
          · {{ $event->venue_name }} 
        @endif
      </div>
      @elseif($event->event_date)
      <div class="inline-flex items-center gap-2 text-slate-500 text-sm py-4 px-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        {{ $event->event_date->format('l, F j, Y') }}@if($event->end_date && $event->end_date->neq($event->event_date)) &mdash; {{ $event->end_date->format('l, F j, Y') }}@endif
        @if(!empty($event->venues) && count($event->venues) > 0)
          · {{ collect($event->venues)->pluck('name')->join(', ') }}
        @elseif($event->venue_name) 
          · {{ $event->venue_name }} 
        @endif
      </div>
      @endif

    </div>
  </div>
</section>

{{-- ═══ FLOATING MOBILE CTA ════════════════════════════════════════════════════ --}}
@if($event->status === 'registration_open')
<div id="floating-bar" class="md:hidden bg-gradient-to-r from-red-700 to-red-600 shadow-2xl shadow-red-900/50">
  <a href="#register" class="flex items-center justify-center gap-2.5 text-white font-bold text-base py-4 px-5">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
    Register Now
    @if($activeTicket && (float)$activeTicket->price > 0)
    @if($activeTicket->strike_price && (float)$activeTicket->strike_price > (float)$activeTicket->price)
    <span class="text-red-200 font-normal text-sm line-through">· ₦{{ number_format((float)$activeTicket->strike_price) }}</span>
    <span class="text-green-400 font-semibold text-sm"> Save {{ $activeTicket->discount_percent }}%</span>
    <span class="text-red-200 font-normal text-sm">· ₦{{ number_format((float)$activeTicket->price) }}</span>
    @else
    <span class="text-red-200 font-normal text-sm">· ₦{{ number_format((float)$activeTicket->price) }}</span>
    @endif
    @endif
  </a>
</div>
@endif

{{-- ═══ EVENT-PAGE FOOTER ══════════════════════════════════════════════════════ --}}
<footer class="ep-footer">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
    <div class="flex items-center gap-2.5">
      <span class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center text-white text-xs font-black shadow-lg shadow-red-600/40">T</span>
      <span class="text-white font-bold text-sm tracking-tight">TREC</span>
    </div>
    <p class="text-white/40 text-sm">
      &copy; {{ date('Y') }} The Ripple Effect Consult. All rights reserved.
    </p>
    <div class="flex items-center gap-6">
      <a href="{{ url('/') }}" class="text-white/40 hover:text-white text-sm transition-colors">Main Site</a>
      <a href="{{ url('/contact') }}" class="text-white/40 hover:text-white text-sm transition-colors">Support</a>
    </div>
  </div>
</footer>

{{-- WhatsApp FAB --}}
<a href="https://wa.me/2349056057502?text=Hi,%20I%20need%20help%20with%20{{ urlencode($event->name) }}"
   target="_blank" rel="noopener" class="wa-fab" title="Chat on WhatsApp">
  <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
</a>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

  // ── Lucide icons ──────────────────────────────────────────────────────
  if (typeof lucide !== 'undefined') lucide.createIcons();

  // ── Mobile Navigation Menu Toggle ──────────────────────────────────────
  const hamburger = document.querySelector('#ep-nav .nav-hamburger');
  const navContainer = document.getElementById('ep-nav');
  if (hamburger && navContainer) {
    hamburger.addEventListener('click', (e) => {
      e.stopPropagation();
      navContainer.classList.toggle('is-open');
    });

    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!navContainer.contains(e.target)) {
        navContainer.classList.remove('is-open');
      }
    });

    // Close menu when clicking a link
    navContainer.querySelectorAll('.mobile-nav-link').forEach(link => {
      link.addEventListener('click', () => {
        navContainer.classList.remove('is-open');
      });
    });
  }

  // ── Page progress bar ─────────────────────────────────────────────────
  const progressBar = document.getElementById('page-progress');
  window.addEventListener('scroll', () => {
    const pct = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
    if (progressBar) progressBar.style.width = Math.min(pct, 100) + '%';
  }, { passive: true });

  // ── Sticky nav & Scrollspy ───────────────────────────────────────────
  const nav = document.getElementById('ep-nav');
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('#ep-nav .section-link');

  window.addEventListener('scroll', () => {
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 60);

    let current = '';
    sections.forEach(sec => {
      const secTop = sec.offsetTop;
      if (window.scrollY >= secTop - 200) {
        current = sec.getAttribute('id');
      }
    });

    navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href') === '#' + current) {
        link.classList.add('active');
      }
    });
  }, { passive: true });

  // ── Countdown timer ───────────────────────────────────────────────────
  const timer = document.getElementById('countdown-timer');
  if (timer) {
    const deadline = new Date(timer.dataset.deadline);
    function tick() {
      const diff = deadline - Date.now();
      if (diff <= 0) {
        ['cd-days','cd-hours','cd-mins','cd-secs'].forEach(id => { const el = document.getElementById(id); if(el) el.textContent = '00'; });
        return;
      }
      const pad = n => String(Math.floor(n)).padStart(2,'0');
      const set = (id, v) => { const el = document.getElementById(id); if(el) el.textContent = v; };
      set('cd-days',  pad(diff / 86400000));
      set('cd-hours', pad((diff % 86400000) / 3600000));
      set('cd-mins',  pad((diff % 3600000) / 60000));
      set('cd-secs',  pad((diff % 60000) / 1000));
    }
    tick(); setInterval(tick, 1000);
  }

  // ── Floating mobile CTA ───────────────────────────────────────────────
  const floatingBar = document.getElementById('floating-bar');
  const regSection  = document.getElementById('register');
  if (floatingBar) {
    window.addEventListener('scroll', () => {
      const y = window.scrollY;
      const heroH = window.innerHeight * 0.65;
      const pastReg = regSection ? y > regSection.offsetTop + regSection.offsetHeight : false;
      floatingBar.classList.toggle('visible', y > heroH && !pastReg);
    }, { passive: true });
  }

  // ── Ticket radio UI ───────────────────────────────────────────────────
  window.selectRadioUI = function(id) {
    document.querySelectorAll('.ticket-radio-item').forEach(el => el.classList.remove('is-selected'));
    const el = document.getElementById('ticket-label-' + id);
    if (el) {
      el.classList.add('is-selected');
      el.querySelector('input[type="radio"]').checked = true;
    }
  };

  window.selectTicket = function(id) {
    selectRadioUI(id);
    setTimeout(() => {
      const reg = document.getElementById('register');
      if (reg) reg.scrollIntoView({ behavior: 'smooth' });
    }, 100);
  };

  window.highlightTicket = window.selectRadioUI;

  // ── Day switcher ──────────────────────────────────────────────────────
  window.switchDay = function(key) {
    document.querySelectorAll('.day-schedule').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.day-tab').forEach(btn => {
      btn.classList.remove('bg-red-600','text-white','border-red-600');
      btn.classList.add('bg-white','text-slate-600','border-slate-200');
    });
    const panel = document.getElementById('day-' + key);
    if (panel) panel.style.display = 'block';
    const tab = document.querySelector('.day-tab[data-day="' + key + '"]');
    if (tab) {
      tab.classList.add('bg-red-600','text-white','border-red-600');
      tab.classList.remove('bg-white','text-slate-600','border-slate-200');
    }
  };

  // ── Testimonial carousel ──────────────────────────────────────────────
  let cur = 0;
  const track  = document.getElementById('testi-track');
  const dotsEl = document.querySelectorAll('.testi-dot');
  const total  = dotsEl.length;

  window.goTesti = function(n) {
    cur = (n + total) % total;
    if (track) track.style.transform = 'translateX(-' + (cur * 100) + '%)';
    dotsEl.forEach((d, i) => {
      d.classList.toggle('bg-red-600', i === cur);
      d.classList.toggle('w-6', i === cur);
      d.classList.toggle('bg-slate-200', i !== cur);
      d.classList.toggle('w-2.5', i !== cur);
    });
  };
  window.nextTesti = () => goTesti(cur + 1);
  window.prevTesti = () => goTesti(cur - 1);
  setInterval(nextTesti, 6000);

  // ── FAQ accordion ─────────────────────────────────────────────────────
  window.toggleFaq = function(i) {
    const item   = document.getElementById('faqitem-' + i);
    const body   = document.getElementById('faqbody-' + i);
    const isOpen = item?.classList.contains('is-open');
    document.querySelectorAll('.faq-item').forEach(el => el.classList.remove('is-open'));
    document.querySelectorAll('.faq-body').forEach(el => el.classList.remove('open'));
    if (!isOpen && item && body) {
      item.classList.add('is-open');
      body.classList.add('open');
    }
  };

  // ── Scroll-reveal ─────────────────────────────────────────────────────
  const reveals = document.querySelectorAll('.reveal');
  const revealObs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); revealObs.unobserve(e.target); } });
  }, { threshold: 0.1 });
  reveals.forEach(el => revealObs.observe(el));

  // ── Smooth anchors ────────────────────────────────────────────────────
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', function(e) {
      const href = this.getAttribute('href').split('?')[0];
      const target = document.querySelector(href);
      if (target) { e.preventDefault(); target.scrollIntoView({ behavior:'smooth', block:'start' }); }
    });
  });

  // ── Form submit loading state ─────────────────────────────────────────
  const form = document.getElementById('registration-form');
  const btn  = document.getElementById('register-btn');
  if (form && btn) {
    form.addEventListener('submit', () => {
      btn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Processing...';
      btn.disabled = true;
    });
  }

  // ── Dynamic button: free vs paid ticket ───────────────────────────────
  (function() {
    const pricesRaw  = document.getElementById('ticket-prices-data');
    const showWaitlist = {{ $showWaitlist ? 'true' : 'false' }};
    
    // For waitlist, don't apply dynamic button logic
    if (showWaitlist || !pricesRaw) return;
    
    const prices     = JSON.parse(pricesRaw.textContent);
    const btnLabel   = document.getElementById('register-btn-label');
    const iconCheck  = document.getElementById('btn-icon-check');
    const iconPay    = document.getElementById('btn-icon-pay');
    const paystackBadge = document.getElementById('paystack-badge');
    const sslBadge   = document.getElementById('ssl-badge');

    function updateButton(ticketId) {
      const info = prices[ticketId];
      if (!info) return;
      const isPaid = parseFloat(info.price) > 0;
      btnLabel.textContent = isPaid
        ? 'Proceed to Payment – ' + info.label
        : 'Complete Registration';
      iconCheck.classList.toggle('hidden', isPaid);
      iconPay.classList.toggle('hidden', !isPaid);
      if (paystackBadge) paystackBadge.classList.toggle('hidden', !isPaid);
      if (sslBadge)   sslBadge.classList.toggle('hidden', isPaid);
    }

    // On page load – check if a ticket is pre-selected (e.g. old input)
    const checked = document.querySelector('input[name="ticket_type_id"]:checked');
    if (checked) updateButton(checked.value);

    // On ticket selection change
    document.querySelectorAll('input[name="ticket_type_id"]').forEach(input => {
      input.addEventListener('change', () => updateButton(input.value));
    });
  })();

});</script>
@endsection

@push('scripts')
<script>
// Meta Pixel — Event Ticket Page Events
document.addEventListener('DOMContentLoaded', function () {

  // Fire ViewContent when the ticket section is visible
  if (typeof fbq === 'function') {
    fbq('track', 'ViewContent', {
      content_name: '{{ addslashes($event->name) }}',
      content_category: 'Event Ticket',
      content_ids: ['{{ $event->slug }}'],
      content_type: 'product'
    });
  }

  // Fire InitiateCheckout when any ticket CTA is clicked
  document.querySelectorAll('a[href*="selar.com"]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      if (typeof fbq === 'function') {
        fbq('track', 'InitiateCheckout', {
          content_name: '{{ addslashes($event->name) }}',
          content_category: 'Event Ticket',
          content_ids: ['{{ $event->slug }}'],
          content_type: 'product',
          currency: 'NGN'
        });
      }
    });
  });

});
</script>
@endpush
