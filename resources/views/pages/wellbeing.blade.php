@extends('layouts.app')
@section('title', 'School Wellbeing - TREC')
@section('content')
<div style="background:var(--cream);padding:6rem 2rem 5rem;position:relative;overflow:hidden">
  <div style="height:5px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green));position:absolute;bottom:0;left:0;right:0"></div>
  <div class="wrap">
    <div class="eyebrow"><span style="background:var(--red);display:inline-block;width:24px;height:2px"></span>School Wellbeing Package</div>
    <h1 style="font-family:var(--font-h);font-size:clamp(2.2rem,5vw,3.8rem);font-weight:900;color:var(--black);margin-bottom:1.25rem">Healthy Schools.<br>Thriving Communities.</h1>
    <p style="font-size:1.05rem;font-weight:300;max-width:560px;line-height:1.85;color:var(--charcoal)">A comprehensive, structured package designed for forward-thinking schools committed to making student and staff mental health a genuine institutional priority.</p>
  </div>
</div>
<section class="sec">
  <div class="wrap">
    <h2 class="stitle">The Complete Package</h2>
    <p class="slead">End-to-end support — from assessment and policy development through implementation to ongoing review and reporting.</p>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1px;background:var(--mid);margin-top:3rem">
      @foreach(['Wellbeing Audit & Needs Assessment', 'Customised Wellbeing Policy', 'Student Counselling Sessions', 'Teacher & Staff Training', 'Parent Engagement Programme', 'Quarterly Reviews & Reporting'] as $item)
      <div style="background:#fff;padding:2rem">
        <div style="height:3px;background:var(--green);margin-bottom:1.5rem"></div>
        <h4 style="font-family:var(--font-h);font-size:1.05rem;font-weight:700;color:var(--black);margin-bottom:.65rem">{{ $item }}</h4>
        <p style="font-size:.88rem;font-weight:300;line-height:1.8;color:var(--charcoal)">{{ $item }} programme component providing comprehensive support for your school's mental health initiatives.</p>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
