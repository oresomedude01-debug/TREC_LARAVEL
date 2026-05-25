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
