@extends('layouts.app')

@section('title', 'Home')
@section('meta_desc', 'The Ripple Effect Consult — Professional counselling, training, and consultation transforming individuals, schools, and organisations in Nigeria.')

@section('styles')
<style>
/* ══════════════════════════════════════
   HERO
══════════════════════════════════════ */
.hero{
  position:relative;min-height:calc(100vh - var(--nav-h));
  background:var(--black);
  display:flex;align-items:center;overflow:hidden;
}

/* Custom hero SVG illustration */
.hero-svg-art{
  position:absolute;right:0;top:0;bottom:0;width:55%;
  display:flex;align-items:center;justify-content:flex-end;
  pointer-events:none;overflow:hidden;padding-right:3%;
}
.hero-svg-art svg{width:100%;max-width:580px;opacity:.85}
.conn-line{animation:dashFlow 3s linear infinite}
.conn-line:nth-child(8){animation-delay:-.5s}
.conn-line:nth-child(9){animation-delay:-1s}
.conn-line:nth-child(10){animation-delay:-1.5s}
.conn-line:nth-child(11){animation-delay:-2s}
.conn-line:nth-child(12){animation-delay:-2.5s}
.conn-line:nth-child(13){animation-delay:-3s}
@keyframes dashFlow{to{stroke-dashoffset:-10}}
@keyframes outerRingPulse{0%,100%{opacity:.35;transform:scale(1)}50%{opacity:.65;transform:scale(1.03)}}
.ring-1{animation:outerRingPulse 4s ease-in-out infinite}
.ring-2{animation:outerRingPulse 4s ease-in-out infinite 1.3s}
.ring-3{animation:outerRingPulse 4s ease-in-out infinite 2.6s}

/* Ripple SVG background */
.hero-ripples{
  position:absolute;inset:0;display:flex;align-items:center;justify-content:center;
  pointer-events:none;overflow:hidden;
}
.ripple-ring{
  position:absolute;border-radius:50%;border:1px solid rgba(255,255,255,.06);
  animation:rippleExpand 6s ease-out infinite;
}
.ripple-ring:nth-child(1){width:200px;height:200px;animation-delay:0s}
.ripple-ring:nth-child(2){width:400px;height:400px;animation-delay:1s}
.ripple-ring:nth-child(3){width:620px;height:620px;animation-delay:2s}
.ripple-ring:nth-child(4){width:860px;height:860px;animation-delay:3s}
.ripple-ring:nth-child(5){width:1100px;height:1100px;animation-delay:4s}
.ripple-ring:nth-child(6){width:1380px;height:1380px;animation-delay:5s}
@keyframes rippleExpand{
  0%{opacity:.8;transform:scale(.88)}
  100%{opacity:0;transform:scale(1)}
}

/* Gradient overlays */
.hero-glow{
  position:absolute;inset:0;
  background:
    radial-gradient(ellipse 60% 70% at 20% 50%,rgba(216,45,55,.18) 0%,transparent 60%),
    radial-gradient(ellipse 50% 60% at 80% 60%,rgba(107,143,26,.12) 0%,transparent 55%);
}
.hero-noise{
  position:absolute;inset:0;
  background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
  opacity:.4;
}

.hero-inner{
  position:relative;z-index:2;
  max-width:1200px;margin:0 auto;padding:5rem 2rem;
  display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;
  width:100%;
}

/* Badge */
.hero-badge{
  display:inline-flex;align-items:center;gap:10px;
  background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);
  padding:7px 18px 7px 10px;border-radius:100px;
  font-size:12px;font-weight:600;color:rgba(255,255,255,.7);
  letter-spacing:.5px;margin-bottom:2rem;
  backdrop-filter:blur(8px);
}
.hero-badge .dot{
  width:8px;height:8px;border-radius:50%;background:var(--green);
  box-shadow:0 0 0 3px rgba(107,143,26,.25);
  animation:pulse 2.5s ease-in-out infinite;
}
@keyframes pulse{
  0%,100%{box-shadow:0 0 0 3px rgba(107,143,26,.25)}
  50%{box-shadow:0 0 0 7px rgba(107,143,26,.08)}
}

h1.htitle{
  font-family:var(--font-h);
  font-size:clamp(3.2rem,5.5vw,4.8rem);
  font-weight:900;color:#fff;
  line-height:1.0;letter-spacing:-2px;margin-bottom:1.5rem;
}
h1.htitle .r{color:var(--red)}
h1.htitle .o{color:var(--orange)}
h1.htitle .g{color:#8fc430}

.hero-sub{
  font-size:1.05rem;font-weight:300;
  color:rgba(255,255,255,.58);
  line-height:1.9;max-width:430px;margin-bottom:2.5rem;
}
.hbtns{display:flex;gap:1rem;flex-wrap:wrap}

/* Right side stats panel */
.hero-stats-panel{
  background:rgba(255,255,255,.04);
  border:1px solid rgba(255,255,255,.1);
  border-radius:16px;padding:2.5rem;
  backdrop-filter:blur(12px);
}
.hero-stats-panel h3{
  font-family:var(--font-h);font-size:.95rem;font-weight:600;
  color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:2px;
  margin-bottom:1.75rem;padding-bottom:1rem;
  border-bottom:1px solid rgba(255,255,255,.08);
}
.hstat{
  display:flex;align-items:center;justify-content:space-between;
  padding:.9rem 0;border-bottom:1px solid rgba(255,255,255,.05);
}
.hstat:last-child{border:none}
.hstat-val{
  font-family:var(--font-h);font-size:2rem;font-weight:900;
  line-height:1;
}
.hstat-val.rv{color:var(--red)}
.hstat-val.ov{color:var(--orange)}
.hstat-val.gv{color:#8fc430}
.hstat-val.wv{color:#fff}
.hstat-label{font-size:12px;font-weight:400;color:rgba(255,255,255,.45);text-align:right;max-width:130px;line-height:1.4}
.hero-scroll-hint{
  position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);
  display:flex;flex-direction:column;align-items:center;gap:8px;
  color:rgba(255,255,255,.25);font-size:10px;letter-spacing:2px;text-transform:uppercase;
  z-index:2;
}
.scroll-mouse{
  width:20px;height:30px;border:1.5px solid rgba(255,255,255,.2);border-radius:10px;
  display:flex;justify-content:center;padding-top:5px;
}
.scroll-dot{
  width:3px;height:7px;background:rgba(255,255,255,.4);border-radius:2px;
  animation:scrollBounce 1.8s ease-in-out infinite;
}
@keyframes scrollBounce{0%{transform:translateY(0);opacity:1}100%{transform:translateY(8px);opacity:0}}

/* ══════════════════════════════════════
   MARQUEE STRIP
══════════════════════════════════════ */
.marquee-strip{
  background:var(--red);padding:.9rem 0;overflow:hidden;
  position:relative;
}
.marquee-track{
  display:flex;gap:0;white-space:nowrap;
  animation:marqueeScroll 25s linear infinite;
}
.marquee-item{
  display:inline-flex;align-items:center;gap:12px;
  color:#fff;font-size:12px;font-weight:700;letter-spacing:2px;
  text-transform:uppercase;padding:0 2rem;
  border-right:1px solid rgba(255,255,255,.2);flex-shrink:0;
}
.marquee-dot{width:5px;height:5px;border-radius:50%;background:rgba(255,255,255,.5);flex-shrink:0}
@keyframes marqueeScroll{from{transform:translateX(0)}to{transform:translateX(-50%)}}

/* ══════════════════════════════════════
   SERVICES
══════════════════════════════════════ */
.svc-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:1.5rem;margin-top:3.5rem;
}
.svc-card{
  background:var(--white);border:1px solid var(--mid);
  border-radius:12px;padding:2rem;
  position:relative;overflow:hidden;
  transition:transform .3s var(--ease),box-shadow .3s var(--ease),border-color .3s var(--ease);
  cursor:default;
}
.svc-card::before{
  content:'';position:absolute;inset:0;
  background:linear-gradient(135deg,rgba(216,45,55,.04),transparent 60%);
  opacity:0;transition:opacity .3s;
}
.svc-card:hover{transform:translateY(-6px);box-shadow:0 20px 50px rgba(0,0,0,.1);border-color:rgba(216,45,55,.25)}
.svc-card:hover::before{opacity:1}
.svc-icon{
  width:52px;height:52px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.4rem;margin-bottom:1.25rem;flex-shrink:0;
  transition:transform .3s ease;
}
.svc-card:hover .svc-icon{transform:scale(1.1)}
.si-r{background:rgba(216,45,55,.1);color:var(--red)}
.si-o{background:rgba(229,105,24,.1);color:var(--orange)}
.si-g{background:rgba(107,143,26,.1);color:var(--green)}
.svc-num{
  position:absolute;top:1.5rem;right:1.5rem;
  font-family:var(--font-h);font-size:2.5rem;font-weight:900;
  color:var(--light);line-height:1;user-select:none;
}
.svc-card h3{font-family:var(--font-h);font-size:1.1rem;font-weight:700;color:var(--black);margin-bottom:.6rem}
.svc-card p{font-size:.87rem;font-weight:300;line-height:1.8;color:var(--charcoal)}
.svc-more{
  display:inline-flex;align-items:center;gap:6px;margin-top:1.25rem;
  font-size:12px;font-weight:700;color:var(--red);
  letter-spacing:.5px;text-transform:uppercase;
  transition:gap .2s;
}
.svc-card:hover .svc-more{gap:10px}

/* ══════════════════════════════════════
   IMPACT NUMBERS
══════════════════════════════════════ */
.impact-sec{
  background:var(--black);padding:5rem 2rem;position:relative;overflow:hidden;
}
.impact-sec::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse 80% 60% at 50% 100%,rgba(216,45,55,.12),transparent 70%);
}
.impact-grid{
  display:grid;grid-template-columns:repeat(4,1fr);
  gap:2px;background:rgba(255,255,255,.06);
  position:relative;z-index:1;border-radius:12px;overflow:hidden;
}
.impact-item{
  background:var(--black);padding:3rem 2rem;text-align:center;
  border:none;transition:background .3s;
}
.impact-item:hover{background:rgba(255,255,255,.03)}
.impact-num{
  font-family:var(--font-h);font-size:3.2rem;font-weight:900;
  line-height:1;margin-bottom:.5rem;
}
.impact-num.in-r{color:var(--red)}
.impact-num.in-o{color:var(--orange)}
.impact-num.in-g{color:#8fc430}
.impact-num.in-w{color:#fff}
.impact-label{font-size:.85rem;font-weight:400;color:rgba(255,255,255,.4);letter-spacing:.3px}

/* ══════════════════════════════════════
   TESTIMONIALS
══════════════════════════════════════ */
.testi-sec{background:var(--cream);padding:5.5rem 2rem}
.testi-slider{position:relative;overflow:hidden;margin-top:3rem}
.testi-track{
  display:flex;
  transition:transform .55s var(--ease);
}
.tcard{
  min-width:100%;padding:0 1rem;box-sizing:border-box;
}
.tcard-inner{
  background:#fff;border-radius:16px;padding:2.75rem;
  max-width:680px;margin:0 auto;
  box-shadow:0 8px 48px rgba(0,0,0,.07);
  position:relative;
}
.tcard-quote{
  font-family:var(--font-h);font-size:5rem;
  color:var(--light);line-height:.7;margin-bottom:1rem;user-select:none;
}
.tcard-text{
  font-size:1.1rem;font-weight:300;font-style:italic;
  line-height:1.85;color:var(--charcoal);margin-bottom:2rem;
}
.tcard-au{display:flex;align-items:center;gap:14px}
.au-av{
  width:46px;height:46px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-h);font-size:15px;font-weight:700;color:#fff;flex-shrink:0;
}
.av-r{background:linear-gradient(135deg,var(--red),#f04050)}
.av-g{background:linear-gradient(135deg,var(--green),#8fc430)}
.av-o{background:linear-gradient(135deg,var(--orange),#f59e0b)}
.au-name{font-size:14px;font-weight:600;color:var(--black)}
.au-role{font-size:12px;color:var(--charcoal);opacity:.55;margin-top:2px}
.tcard-accent{
  position:absolute;bottom:0;left:0;right:0;height:4px;border-radius:0 0 16px 16px;
}
.ta-r{background:linear-gradient(90deg,var(--red),#f04050)}
.ta-g{background:linear-gradient(90deg,var(--green),#8fc430)}
.ta-o{background:linear-gradient(90deg,var(--orange),#f59e0b)}

.testi-controls{display:flex;justify-content:center;align-items:center;gap:1rem;margin-top:2rem}
.testi-dot{
  width:8px;height:8px;border-radius:50%;background:var(--mid);
  cursor:pointer;transition:all .25s;border:none;padding:0;
}
.testi-dot.act{background:var(--red);transform:scale(1.3)}
.testi-arrow{
  width:40px;height:40px;border-radius:50%;border:1.5px solid var(--mid);
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;transition:all .2s;background:transparent;
  color:var(--charcoal);font-size:1.1rem;
}
.testi-arrow:hover{background:var(--red);border-color:var(--red);color:#fff}

/* ══════════════════════════════════════
   CTA SECTION
══════════════════════════════════════ */
.cta-sec{
  background:var(--black);padding:6rem 2rem;
  text-align:center;position:relative;overflow:hidden;
}
.cta-sec::before{
  content:'';position:absolute;
  top:50%;left:50%;transform:translate(-50%,-50%);
  width:800px;height:400px;border-radius:50%;
  background:radial-gradient(ellipse,rgba(216,45,55,.2) 0%,transparent 70%);
}
.cta-sec::after{
  content:'';position:absolute;inset:0;
  border-top:1px solid rgba(255,255,255,.05);
  border-bottom:1px solid rgba(255,255,255,.05);
}
.cta-sec h2{
  font-family:var(--font-h);color:#fff;
  font-size:clamp(2.2rem,4vw,3.2rem);font-weight:900;
  margin-bottom:1rem;position:relative;z-index:1;
  letter-spacing:-1px;line-height:1.1;
}
.cta-sec p{
  color:rgba(255,255,255,.55);font-size:1.05rem;font-weight:300;
  max-width:460px;margin:0 auto 2.5rem;
  position:relative;z-index:1;line-height:1.85;
}
.cta-btns{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;position:relative;z-index:1}

/* ══════════════════════════════════════
   RESPONSIVE
══════════════════════════════════════ */
@media(max-width:960px){
  .hero-inner{grid-template-columns:1fr}
  .hero-stats-panel{display:none}
  .svc-grid{grid-template-columns:repeat(2,1fr)}
  .impact-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:600px){
  h1.htitle{font-size:2.8rem}
  .svc-grid{grid-template-columns:1fr}
  .impact-grid{grid-template-columns:1fr 1fr}
}
</style>
@endsection

@section('content')

<!-- ══ HERO ══ -->
<div class="hero">
  <div class="hero-glow"></div>
  <div class="hero-noise"></div>

  <!-- Custom SVG network illustration -->
  <div class="hero-svg-art" aria-hidden="true">
    <svg viewBox="0 0 560 480" fill="none" xmlns="http://www.w3.org/2000/svg">
      <!-- Concentric ripple rings -->
      <circle cx="280" cy="240" r="70"  class="ring-1" stroke="rgba(216,45,55,0.22)"  stroke-width="1.5"/>
      <circle cx="280" cy="240" r="130" class="ring-2" stroke="rgba(229,105,24,0.16)" stroke-width="1"/>
      <circle cx="280" cy="240" r="195" class="ring-3" stroke="rgba(107,143,26,0.12)" stroke-width="1"/>
      <circle cx="280" cy="240" r="255" stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
      <!-- Connection lines (animated dash flow) -->
      <line class="conn-line" x1="280" y1="240" x2="445" y2="125" stroke="rgba(216,45,55,0.28)"  stroke-width="1" stroke-dasharray="5 5"/>
      <line class="conn-line" x1="280" y1="240" x2="110" y2="150" stroke="rgba(229,105,24,0.22)" stroke-width="1" stroke-dasharray="5 5"/>
      <line class="conn-line" x1="280" y1="240" x2="470" y2="340" stroke="rgba(107,143,26,0.22)" stroke-width="1" stroke-dasharray="5 5"/>
      <line class="conn-line" x1="280" y1="240" x2="88"  y2="330" stroke="rgba(229,105,24,0.18)" stroke-width="1" stroke-dasharray="5 5"/>
      <line class="conn-line" x1="280" y1="240" x2="280" y2="72"  stroke="rgba(216,45,55,0.18)"  stroke-width="1" stroke-dasharray="5 5"/>
      <line class="conn-line" x1="280" y1="240" x2="280" y2="430" stroke="rgba(107,143,26,0.16)" stroke-width="1" stroke-dasharray="5 5"/>
      <!-- Tertiary links between satellites -->
      <line x1="445" y1="125" x2="470" y2="340" stroke="rgba(255,255,255,0.05)" stroke-width="1"/>
      <line x1="110" y1="150" x2="88"  y2="330" stroke="rgba(255,255,255,0.05)" stroke-width="1"/>
      <line x1="445" y1="125" x2="280" y2="72"  stroke="rgba(255,255,255,0.04)" stroke-width="1"/>
      <!-- Center node (glowing) -->
      <circle cx="280" cy="240" r="22" fill="rgba(216,45,55,0.12)"/>
      <circle cx="280" cy="240" r="12" fill="rgba(216,45,55,0.22)"/>
      <circle cx="280" cy="240" r="6"  fill="#D82D37" opacity="0.9"/>
      <circle cx="280" cy="240" r="2.5" fill="#fff" opacity="0.95"/>
      <!-- Satellite nodes -->
      <circle cx="445" cy="125" r="14" fill="rgba(229,105,24,0.12)"/>
      <circle cx="445" cy="125" r="7"  fill="#E56918" opacity="0.8"/>
      <circle cx="110" cy="150" r="10" fill="rgba(216,45,55,0.12)"/>
      <circle cx="110" cy="150" r="5"  fill="#D82D37" opacity="0.75"/>
      <circle cx="470" cy="340" r="16" fill="rgba(107,143,26,0.12)"/>
      <circle cx="470" cy="340" r="8"  fill="#6B8F1A" opacity="0.82"/>
      <circle cx="88"  cy="330" r="9"  fill="rgba(229,105,24,0.12)"/>
      <circle cx="88"  cy="330" r="4.5" fill="#E56918" opacity="0.72"/>
      <circle cx="280" cy="72"  r="7"  fill="rgba(216,45,55,0.1)"/>
      <circle cx="280" cy="72"  r="3.5" fill="#D82D37" opacity="0.68"/>
      <circle cx="280" cy="430" r="6"  fill="rgba(107,143,26,0.1)"/>
      <circle cx="280" cy="430" r="3"  fill="#6B8F1A" opacity="0.65"/>
      <!-- Dust particles -->
      <circle cx="390" cy="75"  r="2.5" fill="rgba(255,255,255,0.18)"/>
      <circle cx="515" cy="210" r="2"   fill="rgba(255,255,255,0.14)"/>
      <circle cx="500" cy="425" r="2.5" fill="rgba(255,255,255,0.16)"/>
      <circle cx="50"  cy="235" r="2"   fill="rgba(255,255,255,0.13)"/>
      <circle cx="145" cy="432" r="2.5" fill="rgba(255,255,255,0.16)"/>
      <circle cx="175" cy="55"  r="2"   fill="rgba(255,255,255,0.13)"/>
      <circle cx="365" cy="430" r="2"   fill="rgba(255,255,255,0.12)"/>
    </svg>
  </div>

  <div class="hero-inner">
    <div>
      <div class="hero-badge reveal">
        <span class="dot"></span>
        Creating Ripples of Change Since 2017
      </div>
      <h1 class="htitle reveal" style="transition-delay:.1s">
        People.<br>
        <span class="r">Purpose.</span><br>
        <span class="o">Impact.</span>
      </h1>
      <p class="hero-sub reveal" style="transition-delay:.2s">
        Professional counselling, training, and consultation that transforms individuals, schools, and organisations — one ripple at a time.
      </p>
      <div class="hbtns reveal" style="transition-delay:.3s">
        <a href="{{ route('services') }}" class="btn-red">Explore Services</a>
        <a href="{{ route('contact') }}" class="btn-ghost" style="border-color:rgba(255,255,255,.25);color:#fff">Book a Consultation</a>
      </div>
    </div>
    <div class="hero-stats-panel reveal-right" style="transition-delay:.25s">
      <h3>Our Impact at a Glance</h3>
      <div class="hstat">
        <div class="hstat-val rv" data-count="500" data-suffix="+">500+</div>
        <div class="hstat-label">Individuals served through counselling</div>
      </div>
      <div class="hstat">
        <div class="hstat-val ov" data-count="8" data-suffix="yrs">8yrs</div>
        <div class="hstat-label">Years of professional practice</div>
      </div>
      <div class="hstat">
        <div class="hstat-val gv" data-count="50" data-suffix="+">50+</div>
        <div class="hstat-label">Schools & institutions partnered</div>
      </div>
      <div class="hstat">
        <div class="hstat-val wv" data-count="6" data-suffix="">6</div>
        <div class="hstat-label">Annual TSCC conference editions</div>
      </div>
    </div>
  </div>
  <div class="hero-scroll-hint">
    <div class="scroll-mouse"><div class="scroll-dot"></div></div>
    <span>Scroll</span>
  </div>
</div>

<!-- ══ MARQUEE STRIP ══ -->
<div class="marquee-strip" aria-hidden="true">
  <div class="marquee-track">
    <div class="marquee-item">Individual Counselling</div>
    <div class="marquee-item">Corporate Training</div>
    <div class="marquee-item">School Wellbeing</div>
    <div class="marquee-item">TSCC Conference</div>
    <div class="marquee-item">Group Counselling</div>
    <div class="marquee-item">Parenting Workshops</div>
    <div class="marquee-item">Mental Health Advocacy</div>
    <div class="marquee-item">People · Purpose · Impact</div>
    <div class="marquee-item">Individual Counselling</div>
    <div class="marquee-item">Corporate Training</div>
    <div class="marquee-item">School Wellbeing</div>
    <div class="marquee-item">TSCC Conference</div>
    <div class="marquee-item">Group Counselling</div>
    <div class="marquee-item">Parenting Workshops</div>
    <div class="marquee-item">Mental Health Advocacy</div>
    <div class="marquee-item">People · Purpose · Impact</div>
  </div>
</div>

<!-- ══ SERVICES OVERVIEW ══ -->
<section class="sec" style="background:var(--white)">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">What We Offer</div>
      <h2 class="stitle">Our Core Services</h2>
      <p class="slead">A comprehensive range of counselling, training, and consultation programmes designed to create lasting, meaningful change.</p>
    </div>
    <div class="svc-grid reveal-stagger">
      <div class="svc-card">
        <div class="svc-num">01</div>
        <div class="svc-icon si-r"><i data-lucide="brain"></i></div>
        <h3>Individual Counselling</h3>
        <p>Confidential one-on-one therapeutic support tailored to each person's unique journey — healing, growth, and transformation.</p>
        <a href="{{ route('services') }}" class="svc-more">Learn more →</a>
      </div>
      <div class="svc-card">
        <div class="svc-num">02</div>
        <div class="svc-icon si-g"><i data-lucide="users"></i></div>
        <h3>Group Counselling</h3>
        <p>Facilitated group sessions harnessing collective healing, peer support, and shared experience for transformative growth.</p>
        <a href="{{ route('services') }}" class="svc-more">Learn more →</a>
      </div>
      <div class="svc-card">
        <div class="svc-num">03</div>
        <div class="svc-icon si-o"><i data-lucide="briefcase"></i></div>
        <h3>Corporate Training</h3>
        <p>Bespoke workplace mental health training — emotional intelligence, resilience, and psychologically safe organisations.</p>
        <a href="{{ route('services') }}" class="svc-more">Learn more →</a>
      </div>
      <div class="svc-card">
        <div class="svc-num">04</div>
        <div class="svc-icon si-g"><i data-lucide="school"></i></div>
        <h3>School Wellbeing Programs</h3>
        <p>Holistic frameworks embedding emotional health into school culture — for students, staff, and school leadership alike.</p>
        <a href="{{ route('wellbeing') }}" class="svc-more">Learn more →</a>
      </div>
      <div class="svc-card">
        <div class="svc-num">05</div>
        <div class="svc-icon si-r">👨‍👩‍👧</div>
        <h3>Parenting Workshops</h3>
        <p>Evidence-based workshops empowering intentional parents to raise confident, emotionally resilient children.</p>
        <a href="{{ route('services') }}" class="svc-more">Learn more →</a>
      </div>
      <div class="svc-card">
        <div class="svc-num">06</div>
        <div class="svc-icon si-o">🎤</div>
        <h3>TSCC & Education Events</h3>
        <p>Nigeria's premier school counselling conference and strategic education events — driving sector-wide change.</p>
        <a href="{{ route('tscc') }}" class="svc-more">Learn more →</a>
      </div>
    </div>
  </div>
</section>

<!-- ══ IMPACT NUMBERS ══ -->
<section class="impact-sec">
  <div class="wrap">
    <div class="reveal" style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow" style="justify-content:center;color:rgba(255,255,255,.4)">The Numbers</div>
      <h2 class="stitle wh">Our Ripple Effect in Numbers</h2>
    </div>
    <div class="impact-grid reveal-stagger">
      <div class="impact-item">
        <div class="impact-num in-r" data-count="500" data-suffix="+">500+</div>
        <div class="impact-label">Individuals Counselled</div>
      </div>
      <div class="impact-item">
        <div class="impact-num in-o" data-count="50" data-suffix="+">50+</div>
        <div class="impact-label">Schools Partnered</div>
      </div>
      <div class="impact-item">
        <div class="impact-num in-g" data-count="6" data-suffix="">6</div>
        <div class="impact-label">TSCC Conferences</div>
      </div>
      <div class="impact-item">
        <div class="impact-num in-w" data-count="8" data-suffix=" Yrs">8 Yrs</div>
        <div class="impact-label">Of Professional Practice</div>
      </div>
    </div>
  </div>
</section>

<!-- ══ TESTIMONIALS ══ -->
<section class="testi-sec">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">Testimonials</div>
      <h2 class="stitle">What Our Clients Say</h2>
    </div>
    <div class="testi-slider reveal" style="transition-delay:.15s">
      <div class="testi-track" id="testiTrack">
        <div class="tcard">
          <div class="tcard-inner">
            <div class="tcard-quote">"</div>
            <p class="tcard-text">TREC transformed how our school approaches student wellbeing. The ripple effect we've seen across staff, students, and parents has been truly remarkable.</p>
            <div class="tcard-au">
              <div class="au-av av-r">AO</div>
              <div>
                <div class="au-name">Adaeze Okonkwo</div>
                <div class="au-role">School Principal, Lagos</div>
              </div>
            </div>
            <div class="tcard-accent ta-r"></div>
          </div>
        </div>
        <div class="tcard">
          <div class="tcard-inner">
            <div class="tcard-quote">"</div>
            <p class="tcard-text">The parenting workshop gave me tools I never had. I now understand my child's emotional world and our relationship has flourished beyond what I imagined possible.</p>
            <div class="tcard-au">
              <div class="au-av av-g">EM</div>
              <div>
                <div class="au-name">Emmanuel Musa</div>
                <div class="au-role">Parent & Workshop Participant</div>
              </div>
            </div>
            <div class="tcard-accent ta-g"></div>
          </div>
        </div>
        <div class="tcard">
          <div class="tcard-inner">
            <div class="tcard-quote">"</div>
            <p class="tcard-text">TSCC was a turning point for our NGO's approach to community mental health. World-class speakers, deep networking, and insights we still use today.</p>
            <div class="tcard-au">
              <div class="au-av av-o">FK</div>
              <div>
                <div class="au-name">Fatima Kuti</div>
                <div class="au-role">Programme Director, NGO Sector</div>
              </div>
            </div>
            <div class="tcard-accent ta-o"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="testi-controls">
      <button class="testi-arrow" id="testiPrev" aria-label="Previous">←</button>
      <button class="testi-dot act" data-i="0" aria-label="Slide 1"></button>
      <button class="testi-dot" data-i="1" aria-label="Slide 2"></button>
      <button class="testi-dot" data-i="2" aria-label="Slide 3"></button>
      <button class="testi-arrow" id="testiNext" aria-label="Next">→</button>
    </div>
  </div>
</section>

<!-- ══ CTA ══ -->
<section class="cta-sec">
  <div class="reveal">
    <h2>Ready to Create Your Ripple?</h2>
    <p>One conversation can be the beginning of lasting change — for you, your team, or your entire institution.</p>
    <div class="cta-btns">
      <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Book a Free Consultation</a>
      <a href="{{ route('services') }}" class="btn-ghost" style="border-color:rgba(255,255,255,.2);color:#fff;padding:16px 44px;font-size:15px">Explore Services</a>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
// ── Testimonial Carousel
let testiCurrent = 0;
const track = document.getElementById('testiTrack');
const dots = document.querySelectorAll('.testi-dot');
const total = track.children.length;
let autoTimer;

function goToSlide(n) {
  testiCurrent = (n + total) % total;
  track.style.transform = `translateX(-${testiCurrent * 100}%)`;
  dots.forEach((d, i) => d.classList.toggle('act', i === testiCurrent));
}

document.getElementById('testiNext').addEventListener('click', () => { goToSlide(testiCurrent + 1); resetAuto(); });
document.getElementById('testiPrev').addEventListener('click', () => { goToSlide(testiCurrent - 1); resetAuto(); });
dots.forEach(d => d.addEventListener('click', () => { goToSlide(parseInt(d.dataset.i)); resetAuto(); }));

function resetAuto() { clearInterval(autoTimer); autoTimer = setInterval(() => goToSlide(testiCurrent + 1), 5000); }
resetAuto();
</script>
@endsection
