@extends('layouts.app')
@section('title', 'TSCC — The School Counselling Conference')
@section('meta_desc', 'Nigeria\'s premier annual school counselling conference — expert keynotes, CPD workshops, networking, and advocacy for counsellors and educators.')

@section('styles')
<style>
/* ── HERO ── */
.tscc-hero{
  background:var(--black);min-height:92vh;
  display:flex;align-items:center;
  position:relative;overflow:hidden;padding:7rem 2rem 6rem;
}
.tscc-hero-bg{
  position:absolute;inset:0;
  background:
    radial-gradient(ellipse 60% 80% at 10% 50%,rgba(229,105,24,.15),transparent 55%),
    radial-gradient(ellipse 50% 60% at 90% 30%,rgba(216,45,55,.10),transparent 55%);
}
.tscc-grid-overlay{
  position:absolute;inset:0;
  background-image:
    linear-gradient(rgba(255,255,255,.025) 1px,transparent 1px),
    linear-gradient(90deg,rgba(255,255,255,.025) 1px,transparent 1px);
  background-size:60px 60px;
}
.tscc-bar{position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))}
.tscc-hero-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1.1fr 1fr;gap:5rem;align-items:center;position:relative;z-index:2;width:100%}

/* Event badge */
.event-badge{
  display:inline-flex;align-items:center;gap:8px;
  background:rgba(229,105,24,.15);border:1px solid rgba(229,105,24,.35);
  color:var(--orange);font-size:10px;font-weight:700;
  letter-spacing:2.5px;text-transform:uppercase;
  padding:7px 16px;border-radius:6px;margin-bottom:1.75rem;
}
.event-badge-dot{width:6px;height:6px;border-radius:50%;background:var(--orange);animation:pulse 2s ease-in-out infinite}

.tscc-hero h1{
  font-family:var(--font-h);font-size:clamp(3rem,6vw,5.2rem);
  font-weight:900;color:#fff;line-height:.95;letter-spacing:-3px;
  margin-bottom:1.5rem;
}
.tscc-hero h1 span{color:var(--orange)}
.tscc-hero p{font-size:1.05rem;font-weight:300;color:rgba(255,255,255,.55);max-width:500px;line-height:1.9;margin-bottom:2.5rem}
.tscc-btns{display:flex;gap:1rem;flex-wrap:wrap}

/* Right: Key info card */
.tscc-info-card{
  background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);
  border-radius:16px;overflow:hidden;
}
.tscc-info-header{
  background:var(--orange);padding:1.5rem 2rem;
  font-family:var(--font-h);font-size:1.1rem;font-weight:700;color:#fff;
}
.tscc-info-body{padding:2rem}
.tscc-info-row{
  display:flex;justify-content:space-between;align-items:flex-start;
  padding:.9rem 0;border-bottom:1px solid rgba(255,255,255,.06);
  gap:1rem;
}
.tscc-info-row:last-child{border:none;padding-bottom:0}
.tscc-info-label{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,.3)}
.tscc-info-val{font-size:13px;font-weight:500;color:rgba(255,255,255,.75);text-align:right;line-height:1.4}

/* ── WHY TSCC ── */
.tscc-why{background:var(--white);padding:5.5rem 2rem}
.feat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem}
.feat-card{
  border:1px solid var(--mid);border-radius:12px;padding:2rem;
  transition:transform .3s var(--ease),box-shadow .3s,border-color .3s;
  position:relative;overflow:hidden;
}
.feat-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  background:var(--orange);transform:scaleX(0);transform-origin:left;
  transition:transform .35s var(--ease);
}
.feat-card:hover{transform:translateY(-6px);box-shadow:0 20px 50px rgba(0,0,0,.08);border-color:rgba(229,105,24,.25)}
.feat-card:hover::before{transform:scaleX(1)}
.feat-icon{font-size:1.75rem;margin-bottom:1rem}
.feat-card h4{font-family:var(--font-h);font-size:1.05rem;font-weight:700;color:var(--black);margin-bottom:.6rem}
.feat-card p{font-size:.88rem;font-weight:300;color:var(--charcoal);line-height:1.8}

/* ── SPONSORSHIP TIERS ── */
.sponsor-sec{background:var(--cream);padding:5.5rem 2rem}
.tier-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem}
.tier-card{
  border-radius:16px;padding:2.5rem;position:relative;
  transition:transform .3s var(--ease),box-shadow .3s;
}
.tier-card:hover{transform:translateY(-8px)}
.tier-card.tc-bronze{background:#fff;border:1px solid #d4a373;box-shadow:0 4px 20px rgba(212,163,115,.15)}
.tier-card.tc-silver{background:#fff;border:1px solid #9ca3af;box-shadow:0 4px 20px rgba(156,163,175,.15)}
.tier-card.tc-gold{
  background:linear-gradient(135deg,#0D0D0D,#1a1a1a);
  border:1px solid #d4a017;
  box-shadow:0 8px 40px rgba(212,160,23,.2);
}
.tier-badge{
  font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;
  padding:4px 12px;border-radius:100px;margin-bottom:1.25rem;display:inline-block;
}
.tb-bronze{background:rgba(212,163,115,.15);color:#c88a4a}
.tb-silver{background:rgba(156,163,175,.15);color:#6b7280}
.tb-gold{background:rgba(212,160,23,.2);color:#d4a017}
.tier-card h3{font-family:var(--font-h);font-size:1.5rem;font-weight:900;margin-bottom:.4rem}
.tc-bronze h3,.tc-silver h3{color:var(--black)}
.tc-gold h3{color:#fff}
.tier-price{font-size:.85rem;font-weight:300;margin-bottom:1.5rem;padding-bottom:1.5rem;border-bottom:1px solid}
.tc-bronze .tier-price{color:var(--charcoal);border-color:var(--mid)}
.tc-silver .tier-price{color:var(--charcoal);border-color:var(--mid)}
.tc-gold .tier-price{color:rgba(255,255,255,.45);border-color:rgba(255,255,255,.1)}
.tier-list{list-style:none;display:flex;flex-direction:column;gap:.65rem;margin-bottom:2rem}
.tier-list li{font-size:.88rem;font-weight:300;display:flex;align-items:center;gap:.6rem}
.tc-bronze .tier-list li,.tc-silver .tier-list li{color:var(--charcoal)}
.tc-gold .tier-list li{color:rgba(255,255,255,.7)}
.tier-list li::before{content:'✓';font-weight:700;font-size:.8rem;flex-shrink:0}
.tc-bronze .tier-list li::before{color:#c88a4a}
.tc-silver .tier-list li::before{color:#6b7280}
.tc-gold .tier-list li::before{color:#d4a017}
.tier-cta-btn{
  display:block;text-align:center;padding:12px;border-radius:8px;
  font-size:13px;font-weight:600;letter-spacing:.3px;transition:all .25s;
}
.tc-bronze .tier-cta-btn{background:rgba(212,163,115,.15);color:#c88a4a}
.tc-bronze .tier-cta-btn:hover{background:#c88a4a;color:#fff}
.tc-silver .tier-cta-btn{background:rgba(156,163,175,.15);color:#6b7280}
.tc-silver .tier-cta-btn:hover{background:#6b7280;color:#fff}
.tc-gold .tier-cta-btn{background:var(--orange);color:#fff;box-shadow:0 4px 14px rgba(229,105,24,.3)}
.tc-gold .tier-cta-btn:hover{background:#c95c15;transform:translateY(-2px)}

/* ── EDITIONS TIMELINE ── */
.editions-sec{background:var(--black);padding:5.5rem 2rem}
.editions-list{display:flex;flex-direction:column;gap:0;margin-top:3rem}
.edition-row{
  display:grid;grid-template-columns:120px 1fr;gap:2rem;
  padding:1.5rem 0;border-bottom:1px solid rgba(255,255,255,.06);align-items:center;
}
.edition-row:last-child{border:none}
.edition-year{
  font-family:var(--font-h);font-size:2rem;font-weight:900;
  color:rgba(255,255,255,.15);line-height:1;
  transition:color .3s;
}
.edition-row:hover .edition-year{color:var(--orange)}
.edition-body{display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:.75rem}
.edition-title{font-size:14px;font-weight:500;color:rgba(255,255,255,.7)}
.edition-tag{font-size:11px;font-weight:600;color:rgba(255,255,255,.3);letter-spacing:1px}

/* ── CTA ── */
.tscc-cta{background:var(--orange);padding:5rem 2rem;text-align:center;position:relative;overflow:hidden}
.tscc-cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 100%,rgba(0,0,0,.2),transparent 70%)}

@media(max-width:960px){
  .tscc-hero-inner{grid-template-columns:1fr}
  .tscc-info-card{display:none}
  .feat-grid{grid-template-columns:1fr 1fr}
  .tier-grid{grid-template-columns:1fr}
  .edition-row{grid-template-columns:80px 1fr;gap:1rem}
}
@media(max-width:600px){
  .feat-grid{grid-template-columns:1fr}
  .tscc-hero h1{letter-spacing:-2px}
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
<div class="tscc-hero">
  <div class="tscc-hero-bg"></div>
  <div class="tscc-grid-overlay"></div>
  <div class="tscc-bar"></div>
  <div class="tscc-hero-inner">
    <div>
      <div class="event-badge reveal"><span class="event-badge-dot"></span>TREC Flagship Annual Event</div>
      <h1 class="reveal" style="transition-delay:.1s">The<br><span>School</span><br>Counselling<br>Conference</h1>
      <p class="reveal" style="transition-delay:.2s">Nigeria's premier annual gathering for school counsellors, educators, administrators, and mental health advocates — convened by The Ripple Effect Consult since 2019.</p>
      <div class="tscc-btns reveal" style="transition-delay:.3s">
        <a href="{{ route('contact') }}" class="btn-orange">Become a Sponsor</a>
        <a href="{{ route('contact') }}" class="btn-ghost" style="border-color:rgba(255,255,255,.2);color:#fff">Register Interest</a>
      </div>
    </div>
    <div class="tscc-info-card reveal-right" style="transition-delay:.25s">
      <div class="tscc-info-header">📅 Next Edition — TSCC 2025</div>
      <div class="tscc-info-body">
        <div class="tscc-info-row">
          <div class="tscc-info-label">Status</div>
          <div class="tscc-info-val" style="color:var(--orange)">Coming Soon</div>
        </div>
        <div class="tscc-info-row">
          <div class="tscc-info-label">Location</div>
          <div class="tscc-info-val">Lagos, Nigeria</div>
        </div>
        <div class="tscc-info-row">
          <div class="tscc-info-label">Format</div>
          <div class="tscc-info-val">In-person & Virtual</div>
        </div>
        <div class="tscc-info-row">
          <div class="tscc-info-label">Audience</div>
          <div class="tscc-info-val">School Counsellors, Educators, Administrators, NGOs</div>
        </div>
        <div class="tscc-info-row">
          <div class="tscc-info-label">CPD</div>
          <div class="tscc-info-val">Certified Hours Awarded</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ── WHY TSCC ── -->
<section class="tscc-why">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow" style="color:var(--orange)">Why Attend</div>
      <h2 class="stitle">What Makes TSCC Special</h2>
      <p class="slead">TSCC is more than a conference — it is a growing movement to elevate school counselling as a national priority in Nigeria.</p>
    </div>
    <div class="feat-grid reveal-stagger">
      <div class="feat-card">
        <div class="feat-icon">🎤</div>
        <h4>Expert Keynotes</h4>
        <p>World-class speakers from mental health, education, and policy — delivering cutting-edge insights you can apply immediately.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon">🛠️</div>
        <h4>Skills Workshops</h4>
        <p>Practical, hands-on sessions that build your counselling toolkit with evidence-based techniques and culturally-relevant approaches.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon">🤝</div>
        <h4>Networking & Community</h4>
        <p>Connect with hundreds of counsellors, educators, and advocates — building the professional relationships that sustain your practice.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon">📜</div>
        <h4>CPD Certification</h4>
        <p>Earn certified professional development hours recognised by national counselling bodies — advancing your career credentials.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon">🏛️</div>
        <h4>Policy & Advocacy</h4>
        <p>Engage with policy makers and sector leaders to drive systemic change — turning conference energy into national reform.</p>
      </div>
      <div class="feat-card">
        <div class="feat-icon">🎪</div>
        <h4>Resource Exhibition</h4>
        <p>Discover the latest tools, technologies, and resources for school counselling — all curated for the Nigerian education context.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── SPONSORSHIP TIERS ── -->
<section class="sponsor-sec">
  <div class="wrap">
    <div class="reveal" style="text-align:center">
      <div class="eyebrow" style="justify-content:center;color:var(--orange)">Partner With Us</div>
      <h2 class="stitle" style="text-align:center">Sponsorship Packages</h2>
      <p class="slead" style="margin:0 auto;text-align:center">Position your brand at Nigeria's most impactful school counselling event.</p>
    </div>
    <div class="tier-grid reveal-stagger">
      <div class="tier-card tc-bronze">
        <div class="tier-badge tb-bronze">Bronze</div>
        <h3>Community Partner</h3>
        <p class="tier-price">Supporting sponsorship package</p>
        <ul class="tier-list">
          <li>Logo on event materials</li>
          <li>2 delegate passes</li>
          <li>Social media mention</li>
          <li>Exhibition table space</li>
        </ul>
        <a href="{{ route('contact') }}" class="tier-cta-btn">Enquire Now</a>
      </div>
      <div class="tier-card tc-silver">
        <div class="tier-badge tb-silver">Silver</div>
        <h3>Impact Partner</h3>
        <p class="tier-price">Prominent sponsorship package</p>
        <ul class="tier-list">
          <li>All Bronze benefits</li>
          <li>5 delegate passes</li>
          <li>Speaking slot (15 mins)</li>
          <li>Conference bag insert</li>
          <li>Website feature</li>
        </ul>
        <a href="{{ route('contact') }}" class="tier-cta-btn">Enquire Now</a>
      </div>
      <div class="tier-card tc-gold">
        <div class="tier-badge tb-gold">⭐ Gold</div>
        <h3>Title Sponsor</h3>
        <p class="tier-price">Premium flagship sponsorship</p>
        <ul class="tier-list">
          <li>All Silver benefits</li>
          <li>10 delegate passes</li>
          <li>Keynote session naming rights</li>
          <li>Opening ceremony mention</li>
          <li>Priority exhibition placement</li>
          <li>Full-page programme feature</li>
        </ul>
        <a href="{{ route('contact') }}" class="tier-cta-btn">Become Title Sponsor</a>
      </div>
    </div>
  </div>
</section>

<!-- ── PAST EDITIONS ── -->
<section class="editions-sec">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow" style="color:rgba(255,255,255,.35)">Our Journey</div>
      <h2 class="stitle wh">Past TSCC Editions</h2>
    </div>
    <div class="editions-list reveal-stagger">
      <div class="edition-row">
        <div class="edition-year">2024</div>
        <div class="edition-body"><span class="edition-title">TSCC VI — Resilience & Recovery in Schools</span><span class="edition-tag">Lagos · 400+ Delegates</span></div>
      </div>
      <div class="edition-row">
        <div class="edition-year">2023</div>
        <div class="edition-body"><span class="edition-title">TSCC V — The Future of School Counselling</span><span class="edition-tag">Lagos · 350+ Delegates</span></div>
      </div>
      <div class="edition-row">
        <div class="edition-year">2022</div>
        <div class="edition-body"><span class="edition-title">TSCC IV — Post-Pandemic Wellbeing</span><span class="edition-tag">Hybrid · 500+ Delegates</span></div>
      </div>
      <div class="edition-row">
        <div class="edition-year">2021</div>
        <div class="edition-body"><span class="edition-title">TSCC III — Mental Health in a Digital Age</span><span class="edition-tag">Virtual · 600+ Delegates</span></div>
      </div>
      <div class="edition-row">
        <div class="edition-year">2020</div>
        <div class="edition-body"><span class="edition-title">TSCC II — Building Psychologically Safe Schools</span><span class="edition-tag">Lagos · 250+ Delegates</span></div>
      </div>
      <div class="edition-row">
        <div class="edition-year">2019</div>
        <div class="edition-body"><span class="edition-title">TSCC I — Counselling at the Heart of Education</span><span class="edition-tag">Lagos · 180 Delegates</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ── REGISTER CTA ── -->
<section class="tscc-cta">
  <div class="reveal" style="position:relative;z-index:1">
    <h2 style="font-family:var(--font-h);color:#fff;font-size:clamp(2rem,4vw,3rem);font-weight:900;letter-spacing:-1px;margin-bottom:1rem">Be Part of TSCC 2025</h2>
    <p style="color:rgba(255,255,255,.7);font-size:1rem;font-weight:300;max-width:440px;margin:0 auto 2.5rem;line-height:1.85">Join hundreds of school counsellors, educators, and mental health advocates shaping the future of wellbeing in Nigerian schools.</p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
      <a href="{{ route('contact') }}" class="btn-wh">Register Interest</a>
      <a href="{{ route('contact') }}" style="display:inline-block;padding:13px 30px;border:1.5px solid rgba(255,255,255,.5);color:#fff;font-size:14px;font-weight:500;border-radius:8px;transition:all .25s">Sponsor TSCC</a>
    </div>
  </div>
</section>

@endsection
