@extends('layouts.app')
@section('title', 'TSCC - TREC')
@section('content')
<div style="background:var(--black);padding:7rem 2rem 5.5rem;position:relative;overflow:hidden">
  <div style="position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))"></div>
  <div class="wrap" style="position:relative;z-index:2">
    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(229,105,24,.15);border:1px solid rgba(229,105,24,.35);color:var(--orange);font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;padding:6px 16px;margin-bottom:1.5rem">TREC Flagship Annual Event</div>
    <h1 style="color:#fff;font-family:var(--font-h);font-size:clamp(2.5rem,5.5vw,4.2rem);font-weight:900;margin-bottom:1.25rem;max-width:720px">The School<br>Counselling<br>Conference</h1>
    <p style="color:rgba(255,255,255,.65);font-size:1.05rem;font-weight:300;max-width:560px;line-height:1.85">Nigeria's premier annual gathering for school counsellors, educators, administrators, and mental health advocates — convened by The Ripple Effect Consult.</p>
    <div style="display:flex;gap:1rem;flex-wrap:wrap;margin-top:2rem">
      <button class="btn-red" style="background:var(--orange)">Become a Sponsor</button>
      <button style="background:transparent;border:1.5px solid rgba(255,255,255,.35);color:#fff;padding:13px 30px;font-size:14px;font-weight:500;cursor:pointer;font-family:var(--font-b)">Register Interest</button>
    </div>
  </div>
</div>
<section class="sec">
  <div class="wrap">
    <h2 class="stitle">Why TSCC Matters</h2>
    <p class="slead">TSCC is more than a conference — it is a growing movement to elevate school counselling as a national priority.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1.5rem;margin-top:3rem">
      @foreach(['Expert Keynotes', 'Skills Workshops', 'Networking & Community', 'Policy & Advocacy', 'Resource Exhibition', 'CPD Certification'] as $feature)
      <div style="padding:2rem;border:1px solid var(--mid)">
        <div style="width:36px;height:3px;background:var(--orange);margin-bottom:1.25rem"></div>
        <h4 style="font-family:var(--font-h);font-size:1.05rem;font-weight:700;color:var(--black);margin-bottom:.65rem">{{ $feature }}</h4>
        <p style="font-size:.88rem;font-weight:300;color:var(--charcoal);line-height:1.8">Transform your school's approach to mental health with {{ $feature }}.</p>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
