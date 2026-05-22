@extends('layouts.app')
@section('title', 'Services - TREC')
@section('content')
<div style="background:var(--black);padding:6rem 2rem 5rem">
  <div class="wrap">
    <div class="eyebrow" style="color:var(--green)"><span style="background:var(--green);display:inline-block;width:24px;height:2px"></span>What We Offer</div>
    <h1 style="color:#fff;font-family:var(--font-h);font-size:clamp(2.5rem,5vw,3.8rem);font-weight:900">Our Services</h1>
    <p style="color:rgba(255,255,255,.6);font-size:1.05rem;font-weight:300;max-width:560px">Comprehensive counselling, training, and consultation — tailored to your context, your people, and your goals.</p>
  </div>
</div>
<section class="sec">
  <div class="wrap">
    <h2 class="stitle">Seven Core Service Areas</h2>
    <div style="display:flex;flex-direction:column;gap:0">
      @foreach(['Individual Counselling', 'Group Counselling', 'Corporate Training', 'School Wellbeing Programs', 'Parenting Workshops', 'Consultation & Advisory', 'TSCC & Strategic Events'] as $index => $service)
      <div style="display:grid;grid-template-columns:160px 1fr;gap:3rem;padding:3rem 0;border-bottom:1px solid var(--mid);align-items:start">
        <div style="font-family:var(--font-h);font-size:4rem;font-weight:900;color:var(--light);line-height:1">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
        <div>
          <h3 style="font-family:var(--font-h);font-size:1.4rem;font-weight:700;color:var(--black);margin-bottom:.75rem">{{ $service }}</h3>
          <p style="font-size:.93rem;font-weight:300;line-height:1.9;color:var(--charcoal)">Comprehensive service offering transformative solutions tailored to your specific needs and context.</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
