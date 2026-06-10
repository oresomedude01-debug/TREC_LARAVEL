@extends('layouts.app')
@section('title', 'School Management Wellbeing Package - TREC Nigeria')
@section('meta_desc', 'TREC\'s comprehensive School Wellbeing Package provides integrated counselling, training, reporting, advisory, and crisis-response services — measurable psychosocial support for your entire school community all year long.')
@section('og_title', 'School Wellbeing Package — TREC Nigeria')
@section('og_desc', 'The complete, all-in-one wellbeing solution for schools. TREC\'s structured annual package delivers counselling, training, reporting, and crisis response in one seamless programme.')
@section('breadcrumb_title', 'Wellbeing Package')

@section('styles')
<style>
:root{--svc-accent:#D82D37;--svc-accent-light:rgba(216,45,55,.12)}
.sd-hero{background:var(--black);padding:8rem 2rem 5rem;position:relative;overflow:hidden}
.sd-hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at -10% 50%,rgba(216,45,55,.16),transparent 60%),radial-gradient(ellipse 40% 60% at 110% 20%,rgba(216,45,55,.08),transparent 55%)}
.sd-hero-bar{position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))}
.sd-hero-inner{max-width:1200px;margin:0 auto;position:relative;z-index:2}
.sd-back{display:inline-flex;align-items:center;gap:8px;font-size:12px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:rgba(255,255,255,.4);text-decoration:none;margin-bottom:2.5rem;transition:color .2s}
.sd-back:hover{color:rgba(255,255,255,.75)}
.sd-back svg{width:16px;height:16px}
.sd-hero-grid{display:grid;grid-template-columns:1fr 480px;gap:5rem;align-items:center}
.sd-category{display:inline-flex;align-items:center;gap:8px;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--svc-accent);margin-bottom:1.25rem}
.sd-category-dot{width:6px;height:6px;border-radius:50%;background:var(--svc-accent)}
.sd-hero h1{font-family:var(--font-display);font-size:clamp(2.6rem,4.5vw,3.8rem);font-weight:400;color:#fff;line-height:1.05;letter-spacing:-1.5px;margin-bottom:1.5rem}
.sd-hero-lead{font-size:1.05rem;font-weight:300;color:rgba(255,255,255,.55);max-width:540px;line-height:1.95;margin-bottom:2.5rem}
.sd-hero-actions{display:flex;gap:1rem;flex-wrap:wrap;align-items:center}
.sd-hero-img{border-radius:20px;overflow:hidden;box-shadow:0 30px 80px rgba(0,0,0,.5);border:1px solid rgba(255,255,255,.07);position:relative}
.sd-hero-img img{width:100%;height:360px;object-fit:cover;display:block}
.sd-hero-img-badge{position:absolute;bottom:20px;left:20px;background:rgba(0,0,0,.75);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,.12);border-radius:10px;padding:.65rem 1rem;font-size:12px;font-weight:600;color:#fff;display:flex;align-items:center;gap:.5rem}
.sd-hero-img-badge-dot{width:6px;height:6px;border-radius:50%;background:var(--svc-accent)}
.sd-stats{background:rgba(0,0,0,.85);border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06);padding:2rem}
.sd-stats-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:2rem}
.sd-stat{text-align:center}
.sd-stat-num{font-family:var(--font-display);font-size:2.2rem;font-weight:400;color:#fff;letter-spacing:-1px;display:block;margin-bottom:.3rem}
.sd-stat-label{font-size:12px;font-weight:500;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:1px}
.sd-section{padding:5.5rem 2rem}
.sd-section-inner{max-width:1200px;margin:0 auto}
.sd-section--cream{background:var(--cream)}
.sd-section--white{background:#fff}
.sd-section--dark{background:var(--black)}
.sd-overview-grid{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:start}
.sd-overview-lead{font-size:1.1rem;font-weight:300;line-height:2;color:var(--charcoal);margin-bottom:1.75rem}
.sd-overview-lead strong{color:var(--black);font-weight:700}
.sd-benefit-list{display:flex;flex-direction:column;gap:.85rem;margin-top:2rem}
.sd-benefit{display:flex;align-items:flex-start;gap:1rem;padding:1rem 1.25rem;background:#fff;border:1px solid var(--mid);border-radius:12px;transition:border-color .2s,box-shadow .2s}
.sd-benefit:hover{border-color:var(--svc-accent);box-shadow:0 4px 20px rgba(216,45,55,.1)}
.sd-benefit-icon{width:36px;height:36px;border-radius:8px;background:var(--svc-accent-light);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sd-benefit-icon svg{width:18px;height:18px;stroke:var(--svc-accent)}
.sd-benefit-text h4{font-size:.95rem;font-weight:700;color:var(--black);margin-bottom:.2rem}
.sd-benefit-text p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}
.sd-process-grid{display:flex;flex-direction:column;gap:0}
.sd-proc-item{display:grid;grid-template-columns:80px 1fr;gap:2rem;padding:2.5rem 0;border-bottom:1px solid rgba(255,255,255,.07);align-items:start}
.sd-proc-item:last-child{border-bottom:none}
.sd-proc-num{width:64px;height:64px;border-radius:16px;background:var(--svc-accent-light);border:1px solid rgba(216,45,55,.25);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.4rem;font-weight:400;color:var(--svc-accent);flex-shrink:0}
.sd-proc-body h3{font-family:var(--font-h);font-size:1.15rem;font-weight:700;color:#fff;margin-bottom:.65rem}
.sd-proc-body p{font-size:.92rem;font-weight:300;color:rgba(255,255,255,.55);line-height:1.9}
.sd-deliverables-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sd-deliverable{background:#fff;border:1px solid var(--mid);border-radius:16px;padding:2rem 1.75rem;transition:transform .25s,box-shadow .25s}
.sd-deliverable:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.08)}
.sd-deliverable-num{font-family:var(--font-display);font-size:2.5rem;font-weight:400;color:var(--light);line-height:1;margin-bottom:1rem}
.sd-deliverable h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.65rem}
.sd-deliverable p{font-size:.87rem;font-weight:300;color:var(--charcoal);line-height:1.8}
.sd-audience-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sd-audience-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:2rem 1.75rem;transition:background .2s,border-color .2s}
.sd-audience-card:hover{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.15)}
.sd-audience-icon{width:48px;height:48px;border-radius:12px;background:var(--svc-accent-light);display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem}
.sd-audience-icon svg{width:22px;height:22px;stroke:var(--svc-accent)}
.sd-audience-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:#fff;margin-bottom:.5rem}
.sd-audience-card p{font-size:.87rem;font-weight:300;color:rgba(255,255,255,.5);line-height:1.75}
.sd-faq-list{display:flex;flex-direction:column;gap:1rem;max-width:820px;margin:0 auto}
.sd-faq-item{border:1px solid var(--mid);border-radius:14px;overflow:hidden;background:#fff}
.sd-faq-q{width:100%;display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:1.4rem 1.75rem;cursor:pointer;background:none;border:none;text-align:left}
.sd-faq-q h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black)}
.sd-faq-icon{width:28px;height:28px;border-radius:50%;background:var(--light);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:background .2s,transform .3s}
.sd-faq-item.open .sd-faq-icon{background:var(--svc-accent);transform:rotate(45deg)}
.sd-faq-icon svg{width:14px;height:14px;stroke:var(--charcoal)}
.sd-faq-item.open .sd-faq-icon svg{stroke:#fff}
.sd-faq-a{max-height:0;overflow:hidden;padding:0 1.75rem;transition:max-height .4s ease,padding .4s ease;font-size:.92rem;font-weight:300;color:var(--charcoal);line-height:1.9}
.sd-faq-item.open .sd-faq-a{max-height:400px;padding:.25rem 1.75rem 1.5rem}
.sd-cta{background:var(--black);padding:6rem 2rem;text-align:center;position:relative;overflow:hidden}
.sd-cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 100%,rgba(216,45,55,.18),transparent 65%)}
.sd-cta-inner{position:relative;z-index:1;max-width:640px;margin:0 auto}
.sd-cta h2{font-family:var(--font-display);font-size:clamp(2rem,4vw,3rem);color:#fff;font-weight:400;letter-spacing:-.5px;margin-bottom:1rem}
.sd-cta p{color:rgba(255,255,255,.5);font-size:1rem;font-weight:300;line-height:1.9;margin-bottom:2.5rem}
.sd-cta-actions{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.sd-related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sd-related-card{border:1px solid var(--mid);border-radius:16px;padding:1.75rem;text-decoration:none;background:#fff;transition:transform .25s,box-shadow .25s,border-color .25s;display:block}
.sd-related-card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.08);border-color:rgba(216,45,55,.3)}
.sd-related-tag{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--svc-accent);margin-bottom:.75rem}
.sd-related-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.sd-related-card p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}
.sd-related-arrow{display:inline-flex;align-items:center;gap:6px;margin-top:1rem;font-size:12px;font-weight:700;color:var(--svc-accent);text-transform:uppercase;letter-spacing:.5px}
/* Package pillars */
.pkg-pillars{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3.5rem}
.pkg-pillar{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:16px;padding:2rem;transition:background .2s,border-color .2s}
.pkg-pillar:hover{background:rgba(255,255,255,.07);border-color:rgba(216,45,55,.25)}
.pkg-pillar-icon{width:44px;height:44px;border-radius:10px;background:var(--svc-accent-light);display:flex;align-items:center;justify-content:center;margin-bottom:1.25rem}
.pkg-pillar-icon svg{width:20px;height:20px;stroke:var(--svc-accent)}
.pkg-pillar h4{font-family:var(--font-h);font-size:.95rem;font-weight:700;color:#fff;margin-bottom:.5rem}
.pkg-pillar p{font-size:.85rem;font-weight:300;color:rgba(255,255,255,.45);line-height:1.75}
@media(max-width:1024px){.sd-hero-grid{grid-template-columns:1fr;gap:3rem}.sd-hero-img{max-width:560px}.sd-deliverables-grid{grid-template-columns:1fr 1fr}.sd-related-grid{grid-template-columns:1fr 1fr}.pkg-pillars{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.sd-stats-inner{grid-template-columns:1fr 1fr;gap:1.5rem}.sd-overview-grid{grid-template-columns:1fr;gap:2.5rem}.sd-proc-item{grid-template-columns:60px 1fr;gap:1.25rem}.sd-deliverables-grid{grid-template-columns:1fr}.sd-audience-grid{grid-template-columns:1fr 1fr}.sd-related-grid{grid-template-columns:1fr}.pkg-pillars{grid-template-columns:1fr}}
@media(max-width:480px){.sd-stats-inner{grid-template-columns:1fr 1fr}.sd-audience-grid{grid-template-columns:1fr}.sd-hero-actions{flex-direction:column;align-items:flex-start}}
</style>
@endsection

@section('content')

<div class="sd-hero">
  <div class="sd-hero-bg"></div>
  <div class="sd-hero-bar"></div>
  <div class="sd-hero-inner">
    <a href="{{ route('services') }}" class="sd-back">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
      All Services
    </a>
    <div class="sd-hero-grid">
      <div>
        <div class="sd-category reveal"><span class="sd-category-dot"></span>Comprehensive School Support</div>
        <h1 class="reveal" style="transition-delay:.1s">School<br>Wellbeing<br>Package</h1>
        <p class="sd-hero-lead reveal" style="transition-delay:.2s">
          An all-in-one, structured wellbeing programme designed for schools that want professional, consistent, and measurable psychosocial support — across students, staff, parents, and management — delivered by TREC throughout the school year.
        </p>
        <div class="sd-hero-actions reveal" style="transition-delay:.3s">
          <a href="{{ route('contact') }}" class="btn-red" style="padding:15px 36px">Request a Proposal</a>
          <a href="#overview" class="btn-ghost" style="padding:15px 36px">See What's Included</a>
        </div>
      </div>
      <div class="sd-hero-img reveal-right">
        <img src="{{ asset('images/services/wellbeing.png') }}" alt="School Wellbeing Package" loading="lazy">
        <div class="sd-hero-img-badge">
          <span class="sd-hero-img-badge-dot"></span>
          Full-Year Retainer Programme
        </div>
      </div>
    </div>
  </div>
</div>

<div class="sd-stats">
  <div class="sd-stats-inner">
    <div class="sd-stat reveal"><span class="sd-stat-num">360°</span><span class="sd-stat-label">Whole-School Coverage</span></div>
    <div class="sd-stat reveal" style="transition-delay:.1s"><span class="sd-stat-num">5</span><span class="sd-stat-label">Core Pillars</span></div>
    <div class="sd-stat reveal" style="transition-delay:.2s"><span class="sd-stat-num">Term</span><span class="sd-stat-label">By Term Reporting</span></div>
    <div class="sd-stat reveal" style="transition-delay:.3s"><span class="sd-stat-num">Crisis</span><span class="sd-stat-label">Response Included</span></div>
  </div>
</div>

<section class="sd-section sd-section--white" id="overview">
  <div class="sd-section-inner">
    <div class="sd-overview-grid">
      <div>
        <div class="eyebrow reveal">What It Is</div>
        <h2 class="stitle reveal" style="transition-delay:.1s">The Complete Wellbeing Solution for Schools</h2>
        <p class="sd-overview-lead reveal" style="transition-delay:.2s">
          Instead of commissioning individual services on an ad-hoc basis, the TREC Wellbeing Package gives your school a <strong>seamless, integrated programme</strong> where all the pieces — counselling, training, curriculum, reporting, advisory, and crisis response — work together under one professional partnership.
        </p>
        <p class="sd-overview-lead reveal" style="transition-delay:.25s">
          Schools on the Wellbeing Package benefit from <strong>priority access, consistent professional relationships, and measurable outcomes</strong> reported to leadership every term — making wellbeing visible, accountable, and strategic.
        </p>
      </div>
      <div>
        <div class="eyebrow reveal">Key Benefits</div>
        <div class="sd-benefit-list">
          <div class="sd-benefit reveal" style="transition-delay:.1s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Consistent, Reliable Support</h4>
              <p>Your school has a dedicated TREC team throughout the year — not a one-off consultant but a true professional partner.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.15s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Measurable, Evidenced Impact</h4>
              <p>Termly reports with data, case summaries, and impact metrics — so your leadership can demonstrate wellbeing ROI.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.2s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Crisis Response Ready</h4>
              <p>When something critical happens, TREC responds rapidly — providing professional support to individuals and the wider community.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.25s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Whole-Community Reach</h4>
              <p>Students, teachers, parents, and management are all supported — creating a truly holistic wellbeing ecosystem.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 5 PILLARS -->
    <div style="margin-top:4rem">
      <div class="eyebrow reveal" style="justify-content:center">The Five Pillars</div>
      <h3 class="reveal" style="font-family:var(--font-h);font-size:1.4rem;font-weight:700;color:var(--black);text-align:center;margin-bottom:.5rem;transition-delay:.1s">Everything the Package Covers</h3>
    </div>
  </div>
</section>

<section class="sd-section sd-section--dark" style="padding-top:0">
  <div class="sd-section-inner">
    <div class="pkg-pillars">
      <div class="pkg-pillar reveal">
        <div class="pkg-pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg></div>
        <h4>Individual &amp; Group Counselling</h4>
        <p>Scheduled one-to-one and group sessions for students in need of therapeutic support throughout the school year.</p>
      </div>
      <div class="pkg-pillar reveal" style="transition-delay:.1s">
        <div class="pkg-pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></div>
        <h4>Staff &amp; Parent Training</h4>
        <p>Termly training sessions for teachers and parents to build their mental health literacy and student support skills.</p>
      </div>
      <div class="pkg-pillar reveal" style="transition-delay:.2s">
        <div class="pkg-pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
        <h4>Curriculum Delivery</h4>
        <p>Structured wellbeing curriculum sessions delivered to student groups across the school year by TREC professionals.</p>
      </div>
      <div class="pkg-pillar reveal" style="transition-delay:.3s">
        <div class="pkg-pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
        <h4>Termly Impact Reporting</h4>
        <p>Comprehensive termly reports presenting data, case summaries, programme insights, and strategic recommendations for leadership.</p>
      </div>
      <div class="pkg-pillar reveal" style="transition-delay:.4s">
        <div class="pkg-pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
        <h4>Crisis Response &amp; Advisory</h4>
        <p>Priority access to TREC professionals in the event of a mental health crisis, plus ongoing strategic advisory to leadership.</p>
      </div>
      <div class="pkg-pillar reveal" style="transition-delay:.5s">
        <div class="pkg-pillar-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
        <h4>Annual Review &amp; Planning</h4>
        <p>End-of-year strategic review with leadership to evaluate impact, adjust the programme, and plan for the following school year.</p>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--white">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3.5rem">
      <div class="eyebrow reveal" style="justify-content:center">How We Work</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">Getting Started with the Package</h2>
    </div>
    <div class="sd-process-grid" style="background:var(--cream);border-radius:20px;padding:2rem">
      <div class="sd-proc-item reveal" style="border-color:var(--mid)">
        <div class="sd-proc-num" style="background:rgba(216,45,55,.08);border-color:rgba(216,45,55,.2)">01</div>
        <div class="sd-proc-body">
          <h3 style="color:var(--black)">Initial Consultation</h3>
          <p style="color:var(--charcoal)">We meet with your leadership team to understand your school's current situation, specific challenges, and what you want to achieve. We listen before we propose.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.1s;border-color:var(--mid)">
        <div class="sd-proc-num" style="background:rgba(216,45,55,.08);border-color:rgba(216,45,55,.2)">02</div>
        <div class="sd-proc-body">
          <h3 style="color:var(--black)">Bespoke Proposal</h3>
          <p style="color:var(--charcoal)">We design a tailored package proposal specifying the exact scope, schedule, deliverables, and fees for your school — no generic off-the-shelf packages.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.2s;border-color:var(--mid)">
        <div class="sd-proc-num" style="background:rgba(216,45,55,.08);border-color:rgba(216,45,55,.2)">03</div>
        <div class="sd-proc-body">
          <h3 style="color:var(--black)">Programme Launch</h3>
          <p style="color:var(--charcoal)">We formally onboard with your school — briefing staff, communicating to parents, and beginning the programme with an initial school-wide wellbeing snapshot.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.3s;border-color:var(--mid)">
        <div class="sd-proc-num" style="background:rgba(216,45,55,.08);border-color:rgba(216,45,55,.2)">04</div>
        <div class="sd-proc-body">
          <h3 style="color:var(--black)">Ongoing Delivery</h3>
          <p style="color:var(--charcoal)">We deliver all agreed services across the school year — counselling sessions, training days, curriculum sessions, and advisory support — with regular communication to leadership.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.4s;border-color:transparent">
        <div class="sd-proc-num" style="background:rgba(216,45,55,.08);border-color:rgba(216,45,55,.2)">05</div>
        <div class="sd-proc-body">
          <h3 style="color:var(--black)">Annual Review &amp; Renewal</h3>
          <p style="color:var(--charcoal)">At year-end, we conduct a full impact review, celebrate progress, identify areas for strengthening, and plan for the following year — with most partner schools continuing and expanding their package.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--cream">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center">Package Deliverables</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">What's Included, Every Year</h2>
    </div>
    <div class="sd-deliverables-grid">
      <div class="sd-deliverable reveal">
        <div class="sd-deliverable-num">01</div>
        <h4>Individual Counselling Sessions</h4>
        <p>Weekly or fortnightly scheduled counselling sessions for students, with a clear referral and case management system.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.1s">
        <div class="sd-deliverable-num">02</div>
        <h4>Group Wellbeing Sessions</h4>
        <p>Structured therapeutic group sessions addressing common themes — anxiety, transitions, relationships, self-esteem.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.2s">
        <div class="sd-deliverable-num">03</div>
        <h4>Staff Training Days</h4>
        <p>CPD-certified mental health training for teaching and support staff — once or twice per term depending on package level.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.3s">
        <div class="sd-deliverable-num">04</div>
        <h4>Parent Wellbeing Workshops</h4>
        <p>Termly or half-termly parent sessions on supporting children's mental health at home and navigating common challenges.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.4s">
        <div class="sd-deliverable-num">05</div>
        <h4>Termly Impact Reports</h4>
        <p>Professional reports for school leadership — case summary data, programme metrics, wellbeing trends, and recommendations.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.5s">
        <div class="sd-deliverable-num">06</div>
        <h4>Crisis Response Protocol</h4>
        <p>Priority access to TREC professionals for rapid response to mental health emergencies — including immediate consultation and debrief support.</p>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--dark">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.4)">Ideal For</div>
      <h2 class="stitle reveal" style="color:#fff;text-align:center;transition-delay:.1s">Who This Package Is For</h2>
    </div>
    <div class="sd-audience-grid">
      <div class="sd-audience-card reveal">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg></div>
        <h4>Committed Schools</h4>
        <p>Schools that are serious about wellbeing as a strategic priority — not just a compliance checkbox — and want a professional partner to make it real.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.1s">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
        <h4>Premium &amp; International Schools</h4>
        <p>Schools whose parents expect the highest standard of student care and want evidence of a comprehensive, professionally managed wellbeing programme.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.2s">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></div>
        <h4>Schools Without In-House Expertise</h4>
        <p>Schools that don't have the internal capacity to design and deliver a full wellbeing programme and want TREC to lead it on their behalf.</p>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--white">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center">Common Questions</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">Frequently Asked Questions</h2>
    </div>
    <div class="sd-faq-list">
      <div class="sd-faq-item reveal">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>Is the Wellbeing Package a fixed programme or customisable?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">It is always customised. The five pillars form the framework, but the specific scope, frequency, and format of each component is tailored to your school's size, budget, existing capacity, and priority needs. We don't believe in one-size-fits-all, and every package proposal is unique to the school it's designed for.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.1s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>How is the Wellbeing Package priced?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Pricing is based on the agreed scope — number of sessions, training days, group sizes, and reporting requirements. We structure fees as a termly or annual retainer, making it easy for schools to budget. We are transparent about pricing from the first conversation, and our proposals are always detailed and itemised.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.2s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>Can the package be combined with a department setup or curriculum we already have?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Absolutely. The Wellbeing Package works best when it sits on a strong structural foundation — so if you've already done a department setup or have a curriculum in place, we build the package around what you have. If not, we can establish those foundations as part of a phased engagement.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.3s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>What happens in a mental health crisis under this package?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Partner schools have priority access to TREC professionals during a crisis. We provide immediate consultation, on-site or remote crisis response support, and post-crisis debrief and recovery sessions for affected individuals and groups. We also help the school communicate appropriately with parents and staff during a crisis situation.</div>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--cream">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center">Explore More</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">Related Services</h2>
    </div>
    <div class="sd-related-grid">
      <a href="{{ route('services.dept-setup') }}" class="sd-related-card reveal">
        <div class="sd-related-tag">Schools</div>
        <h4>Department Setup</h4>
        <p>Build the structural foundation that makes the Wellbeing Package even more effective.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.needs-assessment') }}" class="sd-related-card reveal" style="transition-delay:.1s">
        <div class="sd-related-tag">Strategic</div>
        <h4>Needs Assessment</h4>
        <p>Start with a rigorous assessment to ensure the package is perfectly targeted to your community's real needs.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.training') }}" class="sd-related-card reveal" style="transition-delay:.2s">
        <div class="sd-related-tag">Development</div>
        <h4>Training &amp; Capacity Building</h4>
        <p>Standalone training to build your team's skills independently of a full package commitment.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
    </div>
  </div>
</section>

<section class="sd-cta">
  <div class="sd-cta-inner">
    <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.35)">Get Started</div>
    <h2 class="reveal" style="transition-delay:.1s">Ready for a Whole-School<br>Wellbeing Partner?</h2>
    <p class="reveal" style="transition-delay:.2s">Let's start with a conversation about your school and design a package that delivers real, measurable impact all year long.</p>
    <div class="sd-cta-actions reveal" style="transition-delay:.3s">
      <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Request a Proposal</a>
      <a href="{{ route('services') }}" class="btn-ghost" style="padding:16px 44px;font-size:15px;border-color:rgba(255,255,255,.2);color:#fff">View All Services</a>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
function toggleFaq(btn){
  const item = btn.closest('.sd-faq-item');
  const wasOpen = item.classList.contains('open');
  document.querySelectorAll('.sd-faq-item.open').forEach(el=>el.classList.remove('open'));
  if(!wasOpen) item.classList.add('open');
}
</script>
@endsection
