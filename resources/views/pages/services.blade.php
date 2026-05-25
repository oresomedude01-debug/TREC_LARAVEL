@extends('layouts.app')
@section('title', 'Services')
@section('meta_desc', 'Explore TREC\'s full range of counselling, training, and consultation services — designed to create lasting change for individuals, schools, and organisations.')

@section('styles')
<style>
/* ── HERO ── */
.svc-hero{
  background:var(--black);padding:7rem 2rem 6rem;
  position:relative;overflow:hidden;
}
.svc-hero-bg{
  position:absolute;inset:0;
  background:
    radial-gradient(ellipse 50% 80% at 0% 50%,rgba(107,143,26,.14),transparent 55%),
    radial-gradient(ellipse 40% 60% at 100% 30%,rgba(216,45,55,.12),transparent 55%);
}
.svc-hero-bar{position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))}
.svc-hero-inner{max-width:1200px;margin:0 auto;position:relative;z-index:2;display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center}
.svc-hero h1{font-family:var(--font-h);font-size:clamp(2.8rem,5vw,4.2rem);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-2px;margin-bottom:1.25rem}
.svc-hero p{font-size:1.05rem;font-weight:300;color:rgba(255,255,255,.55);max-width:500px;line-height:1.9}

/* Floating badge list */
.svc-badge-list{display:flex;flex-direction:column;gap:.75rem}
.svc-badge{
  display:flex;align-items:center;gap:.75rem;
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);
  border-radius:10px;padding:.75rem 1rem;
  font-size:13px;font-weight:500;color:rgba(255,255,255,.7);
  transition:background .2s,border-color .2s;
}
.svc-badge:hover{background:rgba(255,255,255,.09);border-color:rgba(255,255,255,.15)}
.svc-badge-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}
.bd-r{background:var(--red)}
.bd-o{background:var(--orange)}
.bd-g{background:var(--green)}
.bd-w{background:rgba(255,255,255,.4)}

/* ── SERVICES LIST ── */
.svc-list-sec{padding:6rem 2rem;background:var(--white)}
.svc-item{
  display:grid;grid-template-columns:80px 1fr;
  gap:2.5rem;padding:3rem 0;
  border-bottom:1px solid var(--mid);
  align-items:start;
  transition:background .2s;
}
.svc-item:last-child{border-bottom:none}
.svc-item-num{
  font-family:var(--font-h);font-size:4rem;font-weight:900;
  color:var(--light);line-height:1;user-select:none;
  transition:color .3s;
}
.svc-item:hover .svc-item-num{color:var(--mid)}
.svc-item-body{flex:1}
.svc-item-head{display:flex;align-items:center;gap:1rem;margin-bottom:1rem;flex-wrap:wrap}
.svc-item-head h3{font-family:var(--font-h);font-size:1.45rem;font-weight:700;color:var(--black)}
.svc-item-tag{
  font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
  padding:4px 12px;border-radius:100px;
}
.tag-r{background:rgba(216,45,55,.1);color:var(--red)}
.tag-o{background:rgba(229,105,24,.1);color:var(--orange)}
.tag-g{background:rgba(107,143,26,.1);color:var(--green)}
.svc-item p{font-size:.93rem;font-weight:300;line-height:1.9;color:var(--charcoal);max-width:680px;margin-bottom:1.25rem}
.svc-item-bullets{
  display:flex;flex-wrap:wrap;gap:.5rem;margin-bottom:1.5rem;
}
.svc-bullet{
  font-size:12px;font-weight:500;color:var(--charcoal);
  background:var(--light);padding:5px 12px;border-radius:100px;
}
.svc-item-cta{
  display:inline-flex;align-items:center;gap:8px;
  font-size:13px;font-weight:700;color:var(--red);
  letter-spacing:.5px;text-transform:uppercase;
  transition:gap .2s;
}
.svc-item:hover .svc-item-cta{gap:12px}

/* ── PROCESS SECTION ── */
.process-sec{background:var(--cream);padding:5.5rem 2rem}
.process-track{
  display:grid;grid-template-columns:repeat(4,1fr);
  gap:0;margin-top:3rem;position:relative;
}
.process-track::before{
  content:'';position:absolute;top:32px;left:12%;right:12%;
  height:1px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green));
  z-index:0;
}
.proc-step{text-align:center;padding:0 1.5rem;position:relative;z-index:1}
.proc-num{
  width:64px;height:64px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-h);font-size:1.3rem;font-weight:900;
  margin:0 auto 1.25rem;color:#fff;
}
.ps-r{background:var(--red);box-shadow:0 4px 20px rgba(216,45,55,.3)}
.ps-o{background:var(--orange);box-shadow:0 4px 20px rgba(229,105,24,.3)}
.ps-g{background:var(--green);box-shadow:0 4px 20px rgba(107,143,26,.3)}
.ps-b{background:var(--black);box-shadow:0 4px 20px rgba(0,0,0,.25)}
.proc-step h4{font-family:var(--font-h);font-size:1.05rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.proc-step p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.75}

/* ── CTA ── */
.svc-cta{background:var(--black);padding:5.5rem 2rem;text-align:center;position:relative;overflow:hidden}
.svc-cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 100%,rgba(216,45,55,.18),transparent 65%)}

@media(max-width:960px){
  .svc-hero-inner{grid-template-columns:1fr}
  .svc-badge-list{display:none}
  .svc-item{grid-template-columns:60px 1fr;gap:1.5rem}
  .process-track{grid-template-columns:1fr 1fr;gap:2rem}
  .process-track::before{display:none}
}
@media(max-width:600px){
  .svc-item{grid-template-columns:1fr}
  .svc-item-num{font-size:2.5rem}
  .process-track{grid-template-columns:1fr}
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
<div class="svc-hero">
  <div class="svc-hero-bg"></div>
  <div class="svc-hero-bar"></div>
  <div class="svc-hero-inner">
    <div>
      <div class="eyebrow reveal" style="color:var(--green)">What We Offer</div>
      <h1 class="reveal" style="transition-delay:.1s">Our Services</h1>
      <p class="reveal" style="transition-delay:.2s">Comprehensive counselling, training, and consultation — tailored to your context, your people, and your goals.</p>
    </div>
    <div class="svc-badge-list reveal-right">
      <div class="svc-badge"><span class="svc-badge-dot bd-r"></span>Individual & Group Counselling</div>
      <div class="svc-badge"><span class="svc-badge-dot bd-o"></span>Corporate Mental Health Training</div>
      <div class="svc-badge"><span class="svc-badge-dot bd-g"></span>School Wellbeing Programmes</div>
      <div class="svc-badge"><span class="svc-badge-dot bd-w"></span>Parenting & Family Workshops</div>
      <div class="svc-badge"><span class="svc-badge-dot bd-r"></span>TSCC & Strategic Events</div>
      <div class="svc-badge"><span class="svc-badge-dot bd-o"></span>Consultation & Advisory</div>
    </div>
  </div>
</div>

<!-- ── SERVICES LIST ── -->
<section class="svc-list-sec">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">Seven Core Areas</div>
      <h2 class="stitle">Everything We Do</h2>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">01</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Individual Counselling</h3>
          <span class="svc-item-tag tag-r">Core Service</span>
        </div>
        <p>Confidential, one-on-one therapeutic support tailored to each person's unique journey. Whether navigating anxiety, depression, grief, trauma, or relationship challenges — our sessions are a safe space for healing, growth, and meaningful transformation.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Anxiety & Stress</span>
          <span class="svc-bullet">Depression & Grief</span>
          <span class="svc-bullet">Trauma Recovery</span>
          <span class="svc-bullet">Career Transitions</span>
          <span class="svc-bullet">Relationship Issues</span>
        </div>
        <a href="{{ route('contact') }}" class="svc-item-cta">Book a Session →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">02</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Group Counselling</h3>
          <span class="svc-item-tag tag-g">Community</span>
        </div>
        <p>Facilitated group sessions that harness the power of collective healing, peer support, and shared experience. Groups create a sense of belonging and normalise emotional struggles — often producing breakthroughs that individual work alone cannot achieve.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Peer Support Groups</span>
          <span class="svc-bullet">Grief Circles</span>
          <span class="svc-bullet">Youth Groups</span>
          <span class="svc-bullet">Women's Circles</span>
        </div>
        <a href="{{ route('contact') }}" class="svc-item-cta">Book a Session →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">03</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Corporate Training</h3>
          <span class="svc-item-tag tag-o">Organisations</span>
        </div>
        <p>Bespoke workplace mental health training designed to build emotionally intelligent, resilient, and psychologically safe organisations. From leadership workshops to company-wide mental health campaigns — we transform workplace culture from the inside out.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Emotional Intelligence</span>
          <span class="svc-bullet">Stress Management</span>
          <span class="svc-bullet">Leadership Wellbeing</span>
          <span class="svc-bullet">Burnout Prevention</span>
          <span class="svc-bullet">Psychological Safety</span>
        </div>
        <a href="{{ route('contact') }}" class="svc-item-cta">Request a Proposal →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">04</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>School Wellbeing Programs</h3>
          <span class="svc-item-tag tag-g">Education</span>
        </div>
        <p>Holistic, structured frameworks that embed emotional health into the DNA of school culture. Our School Wellbeing Package touches every level — students, teachers, support staff, and school leadership — creating environments where everyone can genuinely thrive.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Wellbeing Audits</span>
          <span class="svc-bullet">Student Counselling</span>
          <span class="svc-bullet">Staff Training</span>
          <span class="svc-bullet">Policy Development</span>
        </div>
        <a href="{{ route('wellbeing') }}" class="svc-item-cta">See Full Package →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">05</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Parenting Workshops</h3>
          <span class="svc-item-tag tag-r">Families</span>
        </div>
        <p>Evidence-based workshops empowering parents to raise confident, emotionally resilient children. We equip parents with practical, culturally-grounded tools to understand their children's emotional world, strengthen bonds, and break generational cycles.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Emotional Literacy</span>
          <span class="svc-bullet">Positive Discipline</span>
          <span class="svc-bullet">Attachment Parenting</span>
          <span class="svc-bullet">Teen Mental Health</span>
        </div>
        <a href="{{ route('contact') }}" class="svc-item-cta">Register Interest →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">06</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Consultation & Advisory</h3>
          <span class="svc-item-tag tag-o">Strategic</span>
        </div>
        <p>Expert consultation for NGOs, government bodies, schools, and organisations designing mental health policies and programmes. We advise on frameworks, implementation strategies, and impact measurement — translating best practice into local reality.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Policy Design</span>
          <span class="svc-bullet">Programme Evaluation</span>
          <span class="svc-bullet">Training Design</span>
          <span class="svc-bullet">Research Support</span>
        </div>
        <a href="{{ route('contact') }}" class="svc-item-cta">Enquire Now →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">07</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>TSCC & Strategic Events</h3>
          <span class="svc-item-tag tag-g">Annual Event</span>
        </div>
        <p>Nigeria's premier school counselling conference and a growing portfolio of strategic education events — driving sector-wide conversations, building professional capacity, and creating a community of practice for counsellors and educators nationwide.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Annual Conference</span>
          <span class="svc-bullet">CPD Workshops</span>
          <span class="svc-bullet">Expert Keynotes</span>
          <span class="svc-bullet">Networking Events</span>
        </div>
        <a href="{{ route('tscc') }}" class="svc-item-cta">Learn About TSCC →</a>
      </div>
    </div>

  </div>
</section>

<!-- ── PROCESS ── -->
<section class="process-sec">
  <div class="wrap">
    <div class="reveal" style="text-align:center">
      <div class="eyebrow" style="justify-content:center">How We Work</div>
      <h2 class="stitle" style="text-align:center">Our Process</h2>
      <p class="slead" style="margin:0 auto;text-align:center">Every engagement follows a proven four-step approach — ensuring the work is grounded, personalised, and genuinely transformative.</p>
    </div>
    <div class="process-track reveal-stagger">
      <div class="proc-step">
        <div class="proc-num ps-r">01</div>
        <h4>Assess</h4>
        <p>We begin by deeply understanding your needs, context, and goals through conversation and exploration.</p>
      </div>
      <div class="proc-step">
        <div class="proc-num ps-o">02</div>
        <h4>Plan</h4>
        <p>Together we co-create a tailored programme or intervention designed for your specific situation.</p>
      </div>
      <div class="proc-step">
        <div class="proc-num ps-g">03</div>
        <h4>Deliver</h4>
        <p>We implement with excellence — whether individual sessions, group workshops, or full-scale programmes.</p>
      </div>
      <div class="proc-step">
        <div class="proc-num ps-b">04</div>
        <h4>Review</h4>
        <p>We measure impact, gather feedback, and iterate — ensuring lasting outcomes, not just temporary change.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section class="svc-cta">
  <div class="reveal" style="position:relative;z-index:1">
    <h2 style="font-family:var(--font-h);color:#fff;font-size:clamp(2rem,4vw,3rem);font-weight:900;letter-spacing:-1px;margin-bottom:1rem">Ready to Get Started?</h2>
    <p style="color:rgba(255,255,255,.55);font-size:1rem;font-weight:300;max-width:440px;margin:0 auto 2.5rem;line-height:1.85">One conversation can be the beginning of lasting change. Book a free consultation with our team today.</p>
    <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Book a Free Consultation</a>
  </div>
</section>

@endsection
