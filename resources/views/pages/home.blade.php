@extends('layouts.app')

@section('title', 'Home - TREC')

@section('styles')
<style>
/* ── HERO ── */
.hero{position:relative;background:var(--cream);min-height:88vh;display:flex;align-items:center;overflow:hidden}
.hero-pattern{position:absolute;inset:0;background-image:radial-gradient(circle,var(--mid) 1px,transparent 1px);background-size:32px 32px;opacity:.6}
.hero-blob{position:absolute;right:-120px;top:-80px;width:640px;height:640px;border-radius:50%;background:radial-gradient(circle at 40% 40%,rgba(215,45,55,.12),rgba(229,105,24,.08) 50%,rgba(119,155,28,.06) 80%,transparent)}
.hero-inner{position:relative;z-index:2;max-width:1200px;margin:0 auto;padding:4rem 2rem;display:grid;grid-template-columns:1.1fr 1fr;gap:5rem;align-items:center}
.hero-tag{display:inline-flex;align-items:center;gap:10px;background:#fff;border:1px solid var(--mid);padding:7px 18px 7px 10px;border-radius:100px;font-size:12px;font-weight:600;color:var(--charcoal);letter-spacing:.5px;margin-bottom:2rem;box-shadow:0 2px 12px rgba(0,0,0,.06)}
.hero-tag .dot{width:8px;height:8px;border-radius:50%;background:var(--green);animation:blink 2s infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.3}}
h1.htitle{font-family:var(--font-h);font-size:clamp(3rem,5.5vw,4.4rem);font-weight:900;color:var(--black);line-height:1.02;letter-spacing:-1px;margin-bottom:1.5rem}
h1.htitle .r{color:var(--red)}
h1.htitle .o{color:var(--orange)}
.hero-sub{font-size:1.05rem;font-weight:300;color:var(--charcoal);line-height:1.85;max-width:440px;margin-bottom:2.5rem}
.hbtns{display:flex;gap:1rem;flex-wrap:wrap}

/* VALUES STRIP */
.vals{background:var(--black);padding:1.75rem 2rem}
.vals-inner{max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:2rem;flex-wrap:wrap}
.val-item{display:flex;align-items:center;gap:10px;color:rgba(255,255,255,.7);font-size:13px;font-weight:500;letter-spacing:.3px}
.val-icon{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
.vi-r{background:rgba(215,45,55,.2);color:var(--red)}
.vi-o{background:rgba(229,105,24,.2);color:var(--orange)}
.vi-g{background:rgba(119,155,28,.2);color:var(--green)}

/* SERVICES GRID */
.svc-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(310px,1fr));gap:1px;background:var(--mid);margin-top:3.5rem}
.svc-card{background:var(--white);padding:2.25rem;transition:background .25s;cursor:default;position:relative;overflow:hidden}
.svc-card::after{content:'';position:absolute;bottom:0;left:0;width:0;height:3px;background:var(--red);transition:width .35s var(--ease)}
.svc-card:hover{background:var(--cream)}
.svc-card:hover::after{width:100%}
.svc-num{font-family:var(--font-h);font-size:3.5rem;font-weight:900;color:var(--light);line-height:1;margin-bottom:1rem;user-select:none}
.svc-card h3{font-family:var(--font-h);font-size:1.2rem;font-weight:700;color:var(--black);margin-bottom:.65rem}
.svc-card p{font-size:.88rem;font-weight:300;line-height:1.8;color:var(--charcoal)}
.svc-more{display:inline-flex;align-items:center;gap:6px;margin-top:1.25rem;font-size:12px;font-weight:600;color:var(--red);letter-spacing:.5px;text-transform:uppercase;cursor:pointer;transition:gap .2s}
.svc-more:hover{gap:10px}

/* CTA */
.cta-sec{background:var(--black);padding:5rem 2rem;text-align:center;position:relative;overflow:hidden}
.cta-sec::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at center,rgba(215,45,55,.15) 0%,transparent 65%)}
.cta-sec h2{font-family:var(--font-h);color:#fff;font-size:clamp(2rem,4vw,3rem);font-weight:900;margin-bottom:1rem;position:relative}
.cta-sec p{color:rgba(255,255,255,.6);font-size:1rem;font-weight:300;max-width:440px;margin:0 auto 2.5rem;position:relative;line-height:1.85}

/* TESTIMONIALS */
.testi-sec{background:var(--cream)}
.testi-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:2rem;margin-top:3rem}
.tcard{background:#fff;padding:2rem;border-left:3px solid var(--red);position:relative}
.tcard.g{border-left-color:var(--green)}
.tcard.o{border-left-color:var(--orange)}
.tcard-q{font-family:var(--font-h);font-size:4.5rem;color:var(--light);line-height:.6;position:absolute;top:1.5rem;right:1.25rem;user-select:none}
.tcard p{font-size:.92rem;font-weight:300;font-style:italic;line-height:1.85;color:var(--charcoal);margin-bottom:1.5rem}
.tcard-au{display:flex;align-items:center;gap:12px}
.au-av{width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-h);font-size:14px;font-weight:700;color:#fff;flex-shrink:0}
.av-r{background:var(--red)}
.av-g{background:var(--green)}
.av-o{background:var(--orange)}
.au-name{font-size:14px;font-weight:600;color:var(--black)}
.au-role{font-size:12px;color:var(--charcoal);opacity:.6;margin-top:2px}
</style>
@endsection

@section('content')

<!-- HERO -->
<div class="hero">
  <div class="hero-pattern"></div>
  <div class="hero-blob"></div>
  <div class="hero-inner">
    <div>
      <div class="hero-tag"><span class="dot"></span> Creating Ripples of Change Since 2017</div>
      <h1 class="htitle">People.<br><span class="r">Purpose.</span><br><span class="o">Impact.</span></h1>
      <p class="hero-sub">Professional counselling, training, and consultation that transforms individuals, schools, and organisations — one ripple at a time.</p>
      <div class="hbtns">
        <a href="{{ route('services') }}" class="btn-red">Explore Services</a>
        <a href="{{ route('contact') }}" class="btn-ghost">Book a Consultation</a>
      </div>
    </div>
  </div>
</div>

<!-- VALUES STRIP -->
<div class="vals">
  <div class="vals-inner">
    <div class="val-item"><div class="val-icon vi-r">⟳</div> We Collaborate — Better Together, Stronger Impact</div>
    <div class="val-item"><div class="val-icon vi-o">✦</div> We Innovate — Bold Ideas, Smarter Solutions</div>
    <div class="val-item"><div class="val-icon vi-g">◎</div> We Deliver — Excellence in Action</div>
  </div>
</div>

<!-- SERVICES OVERVIEW -->
<section class="sec" style="background:var(--white)">
  <div class="wrap">
    <div class="eyebrow">What We Offer</div>
    <h2 class="stitle">Our Services</h2>
    <p class="slead">A comprehensive range of counselling, training, and consultation programmes designed to create lasting, meaningful change.</p>
    <div class="svc-grid">
      <div class="svc-card"><div class="svc-num">01</div><h3>Individual Counselling</h3><p>Confidential one-on-one therapeutic support tailored to each person's unique journey — healing, growth, and transformation.</p><span class="svc-more">Learn more →</span></div>
      <div class="svc-card"><div class="svc-num">02</div><h3>Group Counselling</h3><p>Facilitated group sessions harnessing collective healing, peer support, and shared experience for transformative growth.</p><span class="svc-more">Learn more →</span></div>
      <div class="svc-card"><div class="svc-num">03</div><h3>Corporate Training</h3><p>Bespoke workplace mental health training — emotional intelligence, resilience, and building psychologically safe organisations.</p><span class="svc-more">Learn more →</span></div>
      <div class="svc-card"><div class="svc-num">04</div><h3>School Wellbeing Programs</h3><p>Holistic frameworks embedding emotional health into school culture — for students, staff, and school leadership alike.</p><span class="svc-more">Learn more →</span></div>
      <div class="svc-card"><div class="svc-num">05</div><h3>Parenting Workshops</h3><p>Evidence-based workshops empowering intentional parents to raise confident, emotionally resilient children.</p><span class="svc-more">Learn more →</span></div>
      <div class="svc-card"><div class="svc-num">06</div><h3>TSCC & Education Events</h3><p>Nigeria's premier school counselling conference and strategic education events — driving sector-wide change.</p><span class="svc-more">Learn more →</span></div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS -->
<section class="sec testi-sec">
  <div class="wrap">
    <div class="eyebrow">Testimonials</div>
    <h2 class="stitle">What Our Clients Say</h2>
    <div class="testi-grid">
      <div class="tcard">
        <div class="tcard-q">"</div>
        <p>TREC transformed how our school approaches student wellbeing. The ripple effect we've seen across staff, students, and parents has been truly remarkable.</p>
        <div class="tcard-au"><div class="au-av av-r">AO</div><div><div class="au-name">Adaeze Okonkwo</div><div class="au-role">School Principal, Lagos</div></div></div>
      </div>
      <div class="tcard g">
        <div class="tcard-q" style="color:var(--light)">"</div>
        <p>The parenting workshop gave me tools I never had. I now understand my child's emotional world and our relationship has flourished beyond what I imagined possible.</p>
        <div class="tcard-au"><div class="au-av av-g">EM</div><div><div class="au-name">Emmanuel Musa</div><div class="au-role">Parent & Workshop Participant</div></div></div>
      </div>
      <div class="tcard o">
        <div class="tcard-q" style="color:var(--light)">"</div>
        <p>TSCC was a turning point for our NGO's approach to community mental health. World-class speakers, deep networking, and insights we still use today.</p>
        <div class="tcard-au"><div class="au-av av-o">FK</div><div><div class="au-name">Fatima Kuti</div><div class="au-role">Programme Director, NGO Sector</div></div></div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<div class="cta-sec">
  <h2>Ready to Create Your Ripple?</h2>
  <p>One conversation can be the beginning of lasting change — for you, your team, or your entire institution.</p>
  <a href="{{ route('contact') }}" class="btn-red" style="padding:15px 40px;font-size:15px">Book a Free Consultation</a>
</div>

@endsection
