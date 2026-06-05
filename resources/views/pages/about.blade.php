@extends('layouts.app')
@section('title', 'About')
@section('meta_desc', 'Learn about The Ripple Effect Consult — our story, mission, vision, values and the passionate team behind TREC.')

@section('styles')
<style>
/* ── ABOUT HERO ── */
.ab-hero{
  position:relative;background:var(--black);
  padding:7rem 2rem 6rem;overflow:hidden;
}
.ab-hero-rings{
  position:absolute;right:-200px;top:50%;transform:translateY(-50%);
  pointer-events:none;
}
.ab-ring{
  position:absolute;border-radius:50%;border:1px solid rgba(255,255,255,.05);
  transform:translate(-50%,-50%);
}
.ab-ring:nth-child(1){width:200px;height:200px}
.ab-ring:nth-child(2){width:380px;height:380px}
.ab-ring:nth-child(3){width:580px;height:580px;border-color:rgba(216,45,55,.08)}
.ab-ring:nth-child(4){width:780px;height:780px}
.ab-gradient-bar{position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))}
.ab-hero-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1.2fr 1fr;gap:5rem;align-items:center;position:relative;z-index:2}
.ab-hero-label{
  display:inline-flex;align-items:center;gap:8px;margin-bottom:1.5rem;
  font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;
  color:var(--orange);
}
.ab-hero-label::before{content:'';width:20px;height:2px;background:var(--orange)}
.ab-hero h1{
  font-family:var(--font-h);font-size:clamp(2.8rem,5vw,4.5rem);
  font-weight:900;color:#fff;line-height:1.0;letter-spacing:-2px;
  margin-bottom:1.5rem;
}
.ab-hero p{font-size:1.05rem;font-weight:300;color:rgba(255,255,255,.58);line-height:1.9;max-width:480px}

/* Pull quote card */
.ab-quote-card{
  background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);
  border-radius:16px;padding:2.5rem;position:relative;overflow:hidden;
}
.ab-quote-card::before{
  content:'';position:absolute;top:0;left:0;right:0;height:3px;
  background:linear-gradient(90deg,var(--orange),var(--red));
}
.ab-quote-big{
  font-family:var(--font-h);font-size:4rem;color:rgba(255,255,255,.1);
  line-height:.7;margin-bottom:1rem;
}
.ab-quote-card blockquote{
  font-family:var(--font-h);font-size:1.4rem;font-weight:600;
  color:#fff;line-height:1.5;font-style:italic;margin-bottom:1.5rem;
}
.ab-quote-card cite{font-size:12px;font-style:normal;color:rgba(255,255,255,.4);letter-spacing:1px;text-transform:uppercase}

/* ── STORY ── */
.story-sec{padding:6rem 2rem;background:var(--white)}
.story-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr 1.1fr;gap:6rem;align-items:start}
.story-body p{font-size:1rem;font-weight:300;line-height:1.95;color:var(--charcoal);margin-bottom:1.5rem}
.story-body p:first-of-type::first-letter{
  font-family:var(--font-h);font-size:3.5rem;font-weight:900;
  color:var(--red);float:left;line-height:.85;margin:0 .1em .1em 0;
}

/* Visual accent */
.story-visual{display:flex;flex-direction:column;gap:1rem}
.sv-block{
  border-radius:12px;padding:2rem;
  display:flex;align-items:flex-start;gap:1rem;
}
.sv-block.sv-r{background:rgba(216,45,55,.06);border:1px solid rgba(216,45,55,.12)}
.sv-block.sv-o{background:rgba(229,105,24,.06);border:1px solid rgba(229,105,24,.12)}
.sv-block.sv-g{background:rgba(107,143,26,.06);border:1px solid rgba(107,143,26,.12)}
.sv-icon{font-size:1.5rem;flex-shrink:0;margin-top:2px}
.sv-block h4{font-family:var(--font-h);font-size:1rem;font-weight:700;margin-bottom:.4rem;color:var(--black)}
.sv-block p{font-size:.88rem;font-weight:300;color:var(--charcoal);line-height:1.75}

/* ── VALUES ── */
.values-sec{background:var(--cream);padding:5.5rem 2rem}
.mvv-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem}
.mvv-card{
  border-radius:16px;padding:2.5rem;position:relative;overflow:hidden;
  transition:transform .3s var(--ease),box-shadow .3s;
}
.mvv-card:hover{transform:translateY(-6px);box-shadow:0 20px 50px rgba(0,0,0,.1)}
.mvv-card.mvc-r{background:#fff;border-top:4px solid var(--red)}
.mvv-card.mvc-o{background:#fff;border-top:4px solid var(--orange)}
.mvv-card.mvc-g{background:#fff;border-top:4px solid var(--green)}
.mvv-label{
  font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;
  margin-bottom:1rem;
}
.mvv-label.lr{color:var(--red)}
.mvv-label.lo{color:var(--orange)}
.mvv-label.lg{color:var(--green)}
.mvv-card h3{font-family:var(--font-h);font-size:1.5rem;font-weight:900;color:var(--black);margin-bottom:.75rem}
.mvv-card p{font-size:.9rem;font-weight:300;line-height:1.85;color:var(--charcoal)}

/* ── CORE VALUES PILLARS ── */
.pillars-sec{padding:5.5rem 2rem;background:var(--white)}
.pillars-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1px;background:var(--mid);margin-top:3rem;border-radius:12px;overflow:hidden}
.pillar{background:var(--white);padding:2rem 1.5rem;transition:background .3s}
.pillar:hover{background:var(--cream)}
.pillar-num{font-family:var(--font-h);font-size:2rem;font-weight:900;margin-bottom:.5rem}
.pn-r{color:var(--red)}
.pn-o{color:var(--orange)}
.pn-g{color:var(--green)}
.pn-b{color:var(--charcoal)}
.pillar h4{font-family:var(--font-h);font-size:1.1rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.pillar p{font-size:.85rem;font-weight:300;line-height:1.8;color:var(--charcoal)}

/* ── TEAM CTA ── */
.team-cta{
  background:var(--black);padding:5rem 2rem;text-align:center;
  position:relative;overflow:hidden;
}
.team-cta::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse 60% 80% at 50% 100%,rgba(229,105,24,.15),transparent 70%);
}

@media(max-width:960px){
  .ab-hero-inner{grid-template-columns:1fr}
  .ab-quote-card{display:none}
  .story-inner{grid-template-columns:1fr}
  .mvv-grid{grid-template-columns:1fr}
  .pillars-grid{grid-template-columns:1fr 1fr}
  .founder-card {
    grid-template-columns: 1fr;
    gap: 3rem;
    padding: 2.5rem;
  }
  .founder-image-area {
    margin-bottom: 1rem;
  }
}

/* ── FOUNDER SECTION ── */
.founder-sec {
  background: var(--cream);
  padding: 6rem 2rem;
  overflow: hidden;
}
.founder-card {
  display: grid;
  grid-template-columns: 1fr 1.3fr;
  gap: 4.5rem;
  align-items: center;
  background: #fff;
  border-radius: 24px;
  padding: 3.5rem;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.02);
  position: relative;
}
.founder-image-area {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}
.founder-glow-sphere {
  position: absolute;
  width: 250px;
  height: 250px;
  background: radial-gradient(circle, rgba(229,105,24,0.18) 0%, transparent 70%);
  z-index: 1;
  pointer-events: none;
}
.founder-img-wrapper {
  position: relative;
  width: 100%;
  max-width: 300px;
  border-radius: 20px;
  padding: 8px;
  background: rgba(0, 0, 0, 0.02);
  border: 1px solid rgba(0, 0, 0, 0.05);
  z-index: 2;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
}
.founder-portrait-img {
  width: 100%;
  height: auto;
  border-radius: 14px;
  display: block;
  object-fit: cover;
  aspect-ratio: 4/5;
}
.founder-badge {
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  background: linear-gradient(135deg, var(--red), var(--orange));
  color: #fff;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 6px 16px;
  border-radius: 100px;
  box-shadow: 0 6px 20px rgba(216, 45, 55, 0.25);
  white-space: nowrap;
  font-family: var(--font-h);
}
.founder-content-area {
  display: flex;
  flex-direction: column;
}
.founder-eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--orange);
  margin-bottom: 0.75rem;
}
.founder-title {
  font-family: var(--font-h);
  font-size: 2.2rem;
  font-weight: 900;
  color: var(--black);
  line-height: 1.1;
  letter-spacing: -1px;
  margin-bottom: 0.5rem;
}
.founder-credentials {
  font-family: var(--font-b);
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 1.5px;
  color: var(--charcoal);
  opacity: 0.7;
  margin-bottom: 1.5rem;
  text-transform: uppercase;
}
.founder-bio {
  font-size: 0.95rem;
  font-weight: 300;
  line-height: 1.85;
  color: var(--charcoal);
  margin-bottom: 1rem;
}
.founder-bio:last-of-type {
  margin-bottom: 2rem;
}
.founder-footer {
  display: flex;
  align-items: center;
}
.founder-linkedin-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #0077b5;
  color: #fff;
  font-size: 13px;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 8px;
  text-decoration: none;
  transition: background 0.2s, transform 0.2s;
  box-shadow: 0 4px 15px rgba(0, 119, 181, 0.2);
}
.founder-linkedin-btn:hover {
  background: #006097;
  transform: translateY(-2px);
}
.linkedin-svg {
  width: 16px;
  height: 16px;
  fill: currentColor;
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
<div class="ab-hero">
  <div class="ab-gradient-bar"></div>
  <div class="ab-hero-rings">
    <div class="ab-ring"></div>
    <div class="ab-ring"></div>
    <div class="ab-ring"></div>
    <div class="ab-ring"></div>
  </div>
  <div class="ab-hero-inner">
    <div>
      <div class="ab-hero-label reveal">Our Story</div>
      <h1 class="reveal" style="transition-delay:.1s">We Exist to<br>Create Ripples.</h1>
      <p class="reveal" style="transition-delay:.2s">From a single conversation to community-wide transformation — TREC is on a mission to make mental health support accessible, impactful, and sustainable across Nigeria and beyond.</p>
    </div>
    <div class="ab-quote-card reveal-right" style="transition-delay:.25s">
      <div class="ab-quote-big">"</div>
      <blockquote>When one person heals, their transformation ripples outward into families, schools, and entire communities.</blockquote>
      <cite>— TREC's Founding Vision</cite>
    </div>
  </div>
</div>

<!-- ── STORY SECTION ── -->
<section class="story-sec">
  <div class="story-inner">
    <div class="story-body reveal-left">
      <div class="eyebrow" style="margin-bottom:1.5rem">Our Foundation</div>
      <p>The Ripple Effect Consult was born from a simple but powerful conviction: that mental health is not a privilege for the few, but a right for all. Founded in 2017 in Lagos, Nigeria, TREC began as a counselling practice committed to meeting people where they are — in schools, workplaces, homes, and communities.</p>
      <p>Over eight years, we have grown into a multidisciplinary team of counsellors, trainers, and consultants whose work spans individual therapy, organisational development, school wellbeing programmes, and Nigeria's foremost school counselling conference — the TSCC.</p>
      <p>We believe in the ripple: that one transformed person creates waves of change that reach far beyond themselves. This belief is the engine behind everything we do.</p>
    </div>
    <div class="story-visual reveal-right">
      <div class="sv-block sv-r">
        <div class="sv-icon">🎯</div>
        <div>
          <h4>Rooted in Evidence</h4>
          <p>All our programmes draw on established therapeutic frameworks — CBT, person-centred therapy, positive psychology — adapted for the Nigerian context.</p>
        </div>
      </div>
      <div class="sv-block sv-o">
        <div class="sv-icon">🌍</div>
        <div>
          <h4>Culturally Grounded</h4>
          <p>We understand the cultural nuances of mental health in Nigeria, crafting solutions that resonate with the communities we serve.</p>
        </div>
      </div>
      <div class="sv-block sv-g">
        <div class="sv-icon">⚡</div>
        <div>
          <h4>Impact-Driven</h4>
          <p>Every engagement is designed not just for the individual, but for the systems around them — creating lasting, measurable change.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── MISSION / VISION / APPROACH ── -->
<section class="values-sec">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">Our Direction</div>
      <h2 class="stitle">Mission, Vision & Approach</h2>
      <p class="slead">TREC is built on a foundation of integrity, compassion, excellence, and meaningful impact.</p>
    </div>
    <div class="mvv-grid reveal-stagger">
      <div class="mvv-card mvc-r">
        <div class="mvv-label lr">Mission</div>
        <h3>Bridge the Gap</h3>
        <p>To bridge the gap between mental health awareness and meaningful action. When one person heals, thrives, or grows — their transformation ripples outward into families, schools, and entire communities.</p>
      </div>
      <div class="mvv-card mvc-o">
        <div class="mvv-label lo">Vision</div>
        <h3>Society-Wide Access</h3>
        <p>A society where every school, organisation, and family has access to quality counselling, wellbeing support, and the knowledge needed to nurture emotional health from the ground up.</p>
      </div>
      <div class="mvv-card mvc-g">
        <div class="mvv-label lg">Approach</div>
        <h3>Whole-Person Care</h3>
        <p>We treat the whole person — not just symptoms. Our holistic approach integrates evidence-based therapy, community engagement, and systemic advocacy for deep, lasting transformation.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── CORE VALUES ── -->
<section class="pillars-sec">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">What We Stand For</div>
      <h2 class="stitle">Our Core Values</h2>
    </div>
    <div class="pillars-grid reveal-stagger">
      <div class="pillar">
        <div class="pillar-num pn-r">01</div>
        <h4>Integrity</h4>
        <p>Honesty and transparency in every relationship, every session, and every commitment we make.</p>
      </div>
      <div class="pillar">
        <div class="pillar-num pn-o">02</div>
        <h4>Compassion</h4>
        <p>Leading with empathy and genuine care for the wellbeing of every individual we encounter.</p>
      </div>
      <div class="pillar">
        <div class="pillar-num pn-g">03</div>
        <h4>Excellence</h4>
        <p>Maintaining the highest professional standards in our practice, our training, and our advocacy.</p>
      </div>
      <div class="pillar">
        <div class="pillar-num pn-b">04</div>
        <h4>Impact</h4>
        <p>Measuring our success not in sessions delivered, but in lives genuinely transformed.</p>
      </div>
    </div>
  </div>
</section>

<!-- ══ MEET THE FOUNDER ══ -->
<section class="founder-sec reveal">
  <div class="wrap">
    <div class="founder-card">
      <div class="founder-image-area">
        <div class="founder-glow-sphere"></div>
        <div class="founder-img-wrapper" style="background: transparent; border: none; box-shadow: none;">
          <svg viewBox="0 0 120 120" class="founder-portrait-img" style="width: 100%; height: auto; border-radius: 50%; display: block; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);">
            <defs>
              <linearGradient id="avatarGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#f88923" />
                <stop offset="100%" stop-color="#d82d37" />
              </linearGradient>
              <linearGradient id="hijabGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#1f2937" />
                <stop offset="100%" stop-color="#111827" />
              </linearGradient>
              <linearGradient id="skinGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#a16207" />
                <stop offset="100%" stop-color="#78350f" />
              </linearGradient>
            </defs>
            <circle cx="60" cy="60" r="56" fill="url(#avatarGrad)" />
            <path d="M60 22 C34 22 28 36 28 64 C28 85 40 102 60 102 C80 102 92 85 92 64 C92 36 86 22 60 22 Z" fill="url(#hijabGrad)" />
            <ellipse cx="60" cy="58" rx="22" ry="28" fill="url(#skinGrad)" />
            <path d="M60 22 C44 22 41 38 41 58 C41 78 50 86 60 86 C70 86 79 78 79 58 C79 38 76 22 60 22 Z" fill="none" stroke="url(#hijabGrad)" stroke-width="4" />
            <path d="M43 45 C50 35 70 35 77 45" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1.5" stroke-linecap="round" />
            <path d="M41 58 C50 65 70 65 79 58" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1.5" stroke-linecap="round" />
            <path d="M50 54 Q54 57 55 54" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
            <path d="M70 54 Q66 57 65 54" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
            <path d="M56 68 Q60 71 64 68" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" />
            <path d="M28 80 C28 80 20 95 20 110 C20 115 100 115 100 110 C100 95 92 80 92 80 C80 95 40 95 28 80 Z" fill="url(#hijabGrad)" />
          </svg>
          <div class="founder-badge">Founder & Lead Consultant</div>
        </div>
      </div>
      <div class="founder-content-area">
        <div class="founder-eyebrow">Leadership</div>
        <h2 class="founder-title">Meet Faatimah Samuel</h2>
        <div class="founder-credentials">MCASSON, FPMC</div>
        <p class="founder-bio">
          Faatimah Samuel is the Founder and Lead Consultant at The Ripple Effect Consult (TREC). As an experienced counsellor, educational consultant, and family wellbeing advocate, she has dedicated over a decade to helping individuals, schools, and organisations build emotional resilience and psychological safety.
        </p>
        <p class="founder-bio">
          Under her leadership, TREC has grown into a multidisciplinary consultancy producing Nigeria's foremost school counselling platform — the TSCC. She is committed to bridging the gap between mental health awareness and meaningful action, ensuring that every transformation ripples outward into the community.
        </p>
        <div class="founder-footer">
          <a href="https://www.linkedin.com/in/faatimah-samuel-mcasson-fpmc-619a79173" target="_blank" class="founder-linkedin-btn" aria-label="LinkedIn Profile">
            <svg viewBox="0 0 24 24" class="linkedin-svg"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            Connect on LinkedIn
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── IMPACT NUMBERS ── -->
<div style="background:var(--cream);padding:5rem 2rem">
  <div class="wrap">
    <div class="reveal" style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow" style="justify-content:center">The Numbers</div>
      <h2 class="stitle" style="text-align:center">A Decade of Ripples</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem" class="reveal-stagger">
      <div style="text-align:center;padding:2rem;background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05)">
        <div style="font-family:var(--font-h);font-size:2.8rem;font-weight:900;color:var(--red);line-height:1" data-count="500" data-suffix="+">500+</div>
        <div style="font-size:.85rem;color:var(--charcoal);margin-top:.5rem;font-weight:400">Individuals Counselled</div>
      </div>
      <div style="text-align:center;padding:2rem;background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05)">
        <div style="font-family:var(--font-h);font-size:2.8rem;font-weight:900;color:var(--orange);line-height:1" data-count="50" data-suffix="+">50+</div>
        <div style="font-size:.85rem;color:var(--charcoal);margin-top:.5rem;font-weight:400">Schools Supported</div>
      </div>
      <div style="text-align:center;padding:2rem;background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05)">
        <div style="font-family:var(--font-h);font-size:2.8rem;font-weight:900;color:var(--green);line-height:1" data-count="6" data-suffix="">6</div>
        <div style="font-size:.85rem;color:var(--charcoal);margin-top:.5rem;font-weight:400">TSCC Conferences</div>
      </div>
      <div style="text-align:center;padding:2rem;background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.05)">
        <div style="font-family:var(--font-h);font-size:2.8rem;font-weight:900;color:var(--charcoal);line-height:1" data-count="8" data-suffix=" Yrs">8 Yrs</div>
        <div style="font-size:.85rem;color:var(--charcoal);margin-top:.5rem;font-weight:400">Professional Practice</div>
      </div>
    </div>
  </div>
</div>

<!-- ── TEAM CTA ── -->
<div class="team-cta">
  <div class="reveal" style="position:relative;z-index:1">
    <div class="eyebrow" style="justify-content:center;color:rgba(255,255,255,.35);margin-bottom:1rem">The People</div>
    <h2 style="font-family:var(--font-h);font-size:clamp(2rem,4vw,2.8rem);font-weight:900;color:#fff;margin-bottom:1rem;letter-spacing:-1px">
      Behind Every Ripple,<br>There's a Person.
    </h2>
    <p style="color:rgba(255,255,255,.5);font-size:1rem;font-weight:300;max-width:440px;margin:0 auto 2rem;line-height:1.85">
      Our team of dedicated counsellors, trainers, and consultants are the heart of TREC. Each one brings passion, expertise, and lived experience to the work.
    </p>
    <a href="{{ route('contact') }}" class="btn-orange">Get in Touch with Our Team</a>
  </div>
</div>

@endsection
