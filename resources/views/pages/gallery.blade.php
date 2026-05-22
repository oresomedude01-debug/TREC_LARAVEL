@extends('layouts.app')
@section('title', 'Gallery - TREC')
@section('content')
<div style="background:var(--black);padding:6rem 2rem 5rem">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--orange)"><span style="background:var(--orange);display:inline-block;width:24px;height:2px"></span>Gallery</div>
    <h1 style="color:#fff;font-family:var(--font-h);font-size:clamp(2.5rem,5vw,3.8rem);font-weight:900">Moments of Impact</h1>
    <p style="color:rgba(255,255,255,.6);font-size:1rem;font-weight:300;max-width:480px;line-height:1.85">A visual story of TREC's work — conferences, workshops, counselling sessions, and the communities we're honoured to serve.</p>
  </div>
</div>
<div style="max-width:1200px;margin:0 auto;padding:4rem 2rem">
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:2rem">
    @forelse($galleryItems as $item)
      <div style="position:relative;overflow:hidden;background:var(--light);cursor:pointer">
        <div style="height:200px;background:linear-gradient(135deg,{{ $item->color1 }},{{ $item->color2 }});display:flex;align-items:center;justify-content:center;font-family:var(--font-h);font-size:3rem;font-weight:900;opacity:.15;color:#fff">
          {{ strtoupper(substr($item->label, 0, 1)) }}
        </div>
        <div style="position:absolute;bottom:0;left:0;right:0;padding:.75rem 1rem;background:linear-gradient(transparent,rgba(0,0,0,.7));color:#fff;font-size:12px;font-weight:500">
          {{ $item->label }}
        </div>
      </div>
    @empty
      <div style="grid-column:1/-1;text-align:center;padding:3rem">
        <p style="color:var(--charcoal);font-weight:300">Gallery items coming soon. Check back for updates!</p>
      </div>
    @endforelse
  </div>
</div>
@endsection
