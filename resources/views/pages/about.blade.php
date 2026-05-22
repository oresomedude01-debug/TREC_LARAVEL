@extends('layouts.app')
@section('title', 'About - TREC')
@section('content')
<div style="background:var(--black);padding:6rem 2rem 5rem;position:relative;overflow:hidden">
  <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))"></div>
  <div class="wrap" style="position:relative;z-index:2">
    <div class="eyebrow" style="color:var(--orange)"><span style="background:var(--orange);display:inline-block;width:24px;height:2px"></span>Our Story</div>
    <h1 style="color:#fff;font-family:var(--font-h);font-size:clamp(2.5rem,5vw,4rem);font-weight:900">We Exist to<br>Create Ripples.</h1>
    <p style="color:rgba(255,255,255,.6);font-size:1.05rem;font-weight:300;max-width:560px;line-height:1.85">From a single conversation to community-wide transformation — TREC is on a mission to make mental health support accessible, impactful, and sustainable.</p>
  </div>
</div>
<section class="sec">
  <div class="wrap">
    <h2 class="stitle">Our Mission, Vision & Values</h2>
    <p class="slead" style="margin-bottom:3rem">TREC is built on a foundation of integrity, compassion, excellence, and meaningful impact.</p>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start">
      <div>
        <h3 style="font-family:var(--font-h);font-size:1.35rem;font-weight:700;color:var(--black);margin-bottom:.75rem;padding-left:1rem;border-left:3px solid var(--red)">Our Mission</h3>
        <p style="font-size:.93rem;font-weight:300;line-height:1.9;color:var(--charcoal)">To bridge the gap between mental health awareness and meaningful action. When one person heals, thrives, or grows — their transformation ripples outward into families, schools, and entire communities.</p>
      </div>
      <div>
        <h3 style="font-family:var(--font-h);font-size:1.35rem;font-weight:700;color:var(--black);margin-bottom:.75rem;padding-left:1rem;border-left:3px solid var(--orange)">Our Vision</h3>
        <p style="font-size:.93rem;font-weight:300;line-height:1.9;color:var(--charcoal)">A society where every school, organisation, and family has access to quality counselling, wellbeing support, and the knowledge needed to nurture emotional health from the ground up.</p>
      </div>
    </div>
  </div>
</section>
@endsection
