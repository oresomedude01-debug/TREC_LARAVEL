@extends('layouts.app')
@section('title', 'Counselling Curriculum Development - TREC Nigeria')
@section('meta_desc', 'TREC designs age-appropriate counselling curricula that develop emotional intelligence, self-awareness, communication skills, and values in students through structured learning experiences.')
@section('og_title', 'Counselling Curriculum Development — TREC Nigeria')
@section('og_desc', 'Embed wellbeing into everyday school life. TREC creates bespoke counselling curricula that build resilient, emotionally intelligent students.')
@section('breadcrumb_title', 'Curriculum Development')

@section('styles')
<style>
:root{ --svc-accent:#6b8f1a; --svc-accent-light:rgba(107,143,26,.12); }
/* Reuse shared styles from dept-setup page */
.sd-hero{background:var(--black);padding:8rem 2rem 5rem;position:relative;overflow:hidden}
.sd-hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at -10% 50%,rgba(107,143,26,.16),transparent 60%),radial-gradient(ellipse 40% 60% at 110% 20%,rgba(107,143,26,.08),transparent 55%)}
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
.sd-benefit:hover{border-color:var(--svc-accent);box-shadow:0 4px 20px rgba(107,143,26,.1)}
.sd-benefit-icon{width:36px;height:36px;border-radius:8px;background:var(--svc-accent-light);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sd-benefit-icon svg{width:18px;height:18px;stroke:var(--svc-accent)}
.sd-benefit-text h4{font-size:.95rem;font-weight:700;color:var(--black);margin-bottom:.2rem}
.sd-benefit-text p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}
.sd-process-grid{display:flex;flex-direction:column;gap:0}
.sd-proc-item{display:grid;grid-template-columns:80px 1fr;gap:2rem;padding:2.5rem 0;border-bottom:1px solid rgba(255,255,255,.07);align-items:start}
.sd-proc-item:last-child{border-bottom:none}
.sd-proc-num{width:64px;height:64px;border-radius:16px;background:var(--svc-accent-light);border:1px solid rgba(107,143,26,.25);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.4rem;font-weight:400;color:var(--svc-accent);flex-shrink:0}
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
.sd-cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 100%,rgba(107,143,26,.18),transparent 65%)}
.sd-cta-inner{position:relative;z-index:1;max-width:640px;margin:0 auto}
.sd-cta h2{font-family:var(--font-display);font-size:clamp(2rem,4vw,3rem);color:#fff;font-weight:400;letter-spacing:-.5px;margin-bottom:1rem}
.sd-cta p{color:rgba(255,255,255,.5);font-size:1rem;font-weight:300;line-height:1.9;margin-bottom:2.5rem}
.sd-cta-actions{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.sd-related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sd-related-card{border:1px solid var(--mid);border-radius:16px;padding:1.75rem;text-decoration:none;background:#fff;transition:transform .25s,box-shadow .25s,border-color .25s;display:block}
.sd-related-card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.08);border-color:rgba(107,143,26,.3)}
.sd-related-tag{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--svc-accent);margin-bottom:.75rem}
.sd-related-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.sd-related-card p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}
.sd-related-arrow{display:inline-flex;align-items:center;gap:6px;margin-top:1rem;font-size:12px;font-weight:700;color:var(--svc-accent);text-transform:uppercase;letter-spacing:.5px}
/* Curriculum visual strip */
.curriculum-levels{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-top:3rem}
.cl-card{background:#fff;border:1px solid var(--mid);border-radius:14px;padding:1.5rem;text-align:center;transition:transform .2s,box-shadow .2s}
.cl-card:hover{transform:translateY(-4px);box-shadow:0 8px 30px rgba(0,0,0,.07)}
.cl-badge{display:inline-block;padding:4px 14px;border-radius:100px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;margin-bottom:1rem}
.cl-green{background:rgba(107,143,26,.1);color:#6b8f1a}
.cl-card h4{font-family:var(--font-h);font-size:.95rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.cl-card p{font-size:.82rem;color:var(--charcoal);line-height:1.7}
@media(max-width:1024px){.sd-hero-grid{grid-template-columns:1fr;gap:3rem}.sd-hero-img{max-width:560px}.sd-deliverables-grid{grid-template-columns:1fr 1fr}.sd-related-grid{grid-template-columns:1fr 1fr}.curriculum-levels{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.sd-stats-inner{grid-template-columns:1fr 1fr;gap:1.5rem}.sd-overview-grid{grid-template-columns:1fr;gap:2.5rem}.sd-proc-item{grid-template-columns:60px 1fr;gap:1.25rem}.sd-deliverables-grid{grid-template-columns:1fr}.sd-audience-grid{grid-template-columns:1fr 1fr}.sd-related-grid{grid-template-columns:1fr}}
@media(max-width:480px){.sd-stats-inner{grid-template-columns:1fr 1fr}.sd-audience-grid{grid-template-columns:1fr}.sd-hero-actions{flex-direction:column;align-items:flex-start}.curriculum-levels{grid-template-columns:1fr}}
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
        <div class="sd-category reveal"><span class="sd-category-dot"></span>Education &amp; Learning</div>
        <h1 class="reveal" style="transition-delay:.1s">Counselling<br>Curriculum<br>Development</h1>
        <p class="sd-hero-lead reveal" style="transition-delay:.2s">
          TREC designs age-appropriate, structured wellbeing curricula that embed emotional intelligence, self-awareness, and responsible behaviour into the fabric of everyday school life — turning counselling into a learning journey, not just a service.
        </p>
        <div class="sd-hero-actions reveal" style="transition-delay:.3s">
          <a href="{{ route('contact') }}" class="btn-red" style="padding:15px 36px">Request a Curriculum</a>
          <a href="#overview" class="btn-ghost" style="padding:15px 36px">Learn More</a>
        </div>
      </div>
      <div class="sd-hero-img reveal-right">
        <img src="{{ asset('images/services/curriculum.png') }}" alt="Counselling Curriculum Development" loading="lazy">
        <div class="sd-hero-img-badge">
          <span class="sd-hero-img-badge-dot"></span>
          Bespoke &amp; Age-Appropriate
        </div>
      </div>
    </div>
  </div>
</div>

<div class="sd-stats">
  <div class="sd-stats-inner">
    <div class="sd-stat reveal"><span class="sd-stat-num">4</span><span class="sd-stat-label">Age Bands Covered</span></div>
    <div class="sd-stat reveal" style="transition-delay:.1s"><span class="sd-stat-num">12+</span><span class="sd-stat-label">Core Wellbeing Themes</span></div>
    <div class="sd-stat reveal" style="transition-delay:.2s"><span class="sd-stat-num">100%</span><span class="sd-stat-label">Tailored to Your School</span></div>
    <div class="sd-stat reveal" style="transition-delay:.3s"><span class="sd-stat-num">Term</span><span class="sd-stat-label">Ready Lesson Plans</span></div>
  </div>
</div>

<section class="sd-section sd-section--white" id="overview">
  <div class="sd-section-inner">
    <div class="sd-overview-grid">
      <div>
        <div class="eyebrow reveal">What It Is</div>
        <h2 class="stitle reveal" style="transition-delay:.1s">Wellbeing Learning Built Into School Life</h2>
        <p class="sd-overview-lead reveal" style="transition-delay:.2s">
          A counselling curriculum is the <strong>systematic delivery of social-emotional learning</strong> through structured sessions — going beyond reactive counselling to proactively build every student's mental health literacy, emotional vocabulary, and life skills.
        </p>
        <p class="sd-overview-lead reveal" style="transition-delay:.25s">
          TREC designs <strong>bespoke counselling curricula</strong> that are sequenced across year groups, aligned with developmental stages, and delivered through engaging, interactive lesson formats that students actually enjoy.
        </p>
      </div>
      <div>
        <div class="eyebrow reveal">Key Benefits</div>
        <div class="sd-benefit-list">
          <div class="sd-benefit reveal" style="transition-delay:.1s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Proactive, Not Just Reactive</h4>
              <p>Builds student resilience and mental health literacy before problems arise — reducing the counsellor's caseload over time.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.15s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Structured &amp; Sequential</h4>
              <p>Lessons build on each other year by year, creating cumulative growth in emotional intelligence and social skills.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.2s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Engages the Whole Community</h4>
              <p>Curriculum is designed for delivery by trained counsellors, with complementary resources for parents and form teachers.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.25s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Measurable Outcomes</h4>
              <p>Built-in reflection tools and termly assessments allow schools to track student growth and evidence the curriculum's impact.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- AGE BANDS -->
    <div style="margin-top:4rem">
      <div class="eyebrow reveal" style="justify-content:center">Age-Differentiated Design</div>
      <h3 class="reveal" style="font-family:var(--font-h);font-size:1.4rem;font-weight:700;color:var(--black);text-align:center;margin-bottom:.5rem;transition-delay:.1s">Curricula Across All School Levels</h3>
      <div class="curriculum-levels">
        <div class="cl-card reveal">
          <div class="cl-badge cl-green">Early Years</div>
          <h4>Reception – Year 2</h4>
          <p>Emotional naming, friendship, kindness, and simple self-regulation through play and storytelling.</p>
        </div>
        <div class="cl-card reveal" style="transition-delay:.1s">
          <div class="cl-badge cl-green">Lower Primary</div>
          <h4>Years 3 – 5</h4>
          <p>Self-awareness, empathy, managing feelings, peer relationships, and healthy communication.</p>
        </div>
        <div class="cl-card reveal" style="transition-delay:.2s">
          <div class="cl-badge cl-green">Upper Primary</div>
          <h4>Years 6 – 8</h4>
          <p>Identity, peer pressure, values clarification, resilience-building, and responsible decision-making.</p>
        </div>
        <div class="cl-card reveal" style="transition-delay:.3s">
          <div class="cl-badge cl-green">Secondary</div>
          <h4>Years 9 – 12</h4>
          <p>Mental health literacy, career planning, relationships, stress management, and life after school.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--dark">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3.5rem">
      <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.4)">How We Do It</div>
      <h2 class="stitle reveal" style="color:#fff;text-align:center;transition-delay:.1s">Our Development Process</h2>
    </div>
    <div class="sd-process-grid">
      <div class="sd-proc-item reveal">
        <div class="sd-proc-num">01</div>
        <div class="sd-proc-body">
          <h3>School Context Review</h3>
          <p>We review your school's ethos, existing PSHE or pastoral programmes, student demographics, and specific wellbeing concerns to ensure the curriculum is culturally relevant and contextually grounded.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.1s">
        <div class="sd-proc-num">02</div>
        <div class="sd-proc-body">
          <h3>Curriculum Framework Design</h3>
          <p>We map out a sequenced curriculum framework — defining the themes, learning objectives, and outcomes for each year group — then share it with your leadership team for review and alignment.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.2s">
        <div class="sd-proc-num">03</div>
        <div class="sd-proc-body">
          <h3>Lesson Plan Development</h3>
          <p>We develop detailed, session-by-session lesson plans complete with activities, discussion guides, reflection prompts, and take-home resources — ready for your counsellor to deliver from day one.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.3s">
        <div class="sd-proc-num">04</div>
        <div class="sd-proc-body">
          <h3>Counsellor Training</h3>
          <p>We train your counsellor(s) on how to facilitate the sessions effectively, handle sensitive disclosures, differentiate for diverse learners, and use the reflection tools to track student progress.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.4s">
        <div class="sd-proc-num">05</div>
        <div class="sd-proc-body">
          <h3>Pilot, Feedback &amp; Refinement</h3>
          <p>We support the initial delivery, gather student and staff feedback, and refine the curriculum based on real-world classroom experience before full-scale rollout.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--cream">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center">What You Get</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">What's Included</h2>
    </div>
    <div class="sd-deliverables-grid">
      <div class="sd-deliverable reveal">
        <div class="sd-deliverable-num">01</div>
        <h4>Full Curriculum Framework</h4>
        <p>A complete, year-by-year curriculum map showing themes, learning goals, and session outcomes for each term.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.1s">
        <div class="sd-deliverable-num">02</div>
        <h4>Session-by-Session Lesson Plans</h4>
        <p>Detailed lesson plans with activities, materials lists, timing guides, and facilitation notes — ready to use.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.2s">
        <div class="sd-deliverable-num">03</div>
        <h4>Student Workbooks / Journals</h4>
        <p>Accompanying student journals or reflection booklets that reinforce learning and build self-awareness over time.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.3s">
        <div class="sd-deliverable-num">04</div>
        <h4>Assessment &amp; Tracking Tools</h4>
        <p>Pre- and post-session reflection tools and a simple tracking system to monitor student progress termly.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.4s">
        <div class="sd-deliverable-num">05</div>
        <h4>Parent Communication Guides</h4>
        <p>Termly parent letters explaining what students are learning and how families can reinforce it at home.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.5s">
        <div class="sd-deliverable-num">06</div>
        <h4>Counsellor Training &amp; Support</h4>
        <p>Full onboarding and facilitation training so your counsellor can deliver the curriculum with confidence and skill.</p>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--dark">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.4)">Ideal For</div>
      <h2 class="stitle reveal" style="color:#fff;text-align:center;transition-delay:.1s">Who This Is For</h2>
    </div>
    <div class="sd-audience-grid">
      <div class="sd-audience-card reveal">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg></div>
        <h4>Schools With a Counsellor</h4>
        <p>Schools that have a counsellor but want to give them a structured, professional framework for proactive delivery.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.1s">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div>
        <h4>Schools Seeking Differentiation</h4>
        <p>Schools that want to offer a clearly articulated, evidence-based wellbeing programme as part of their brand promise.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.2s">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg></div>
        <h4>New &amp; Growing Schools</h4>
        <p>Schools that are building their pastoral care framework and want counselling to be a key academic differentiator from year one.</p>
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
          <h4>How is a counselling curriculum different from PSHE or life skills lessons?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">While PSHE and life skills are related, a counselling curriculum goes deeper — focusing specifically on the psychosocial and emotional dimensions of student wellbeing, delivered by a trained counsellor using therapeutic facilitation techniques. It's more personalised, reflective, and clinically informed.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.1s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>Can the curriculum be adapted if we already have some wellbeing content?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Yes. We always review existing content and integrate it where it's strong, replacing or supplementing areas that need strengthening. We never start from scratch unnecessarily — we build on what's already working.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.2s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>Does the curriculum work across Nigerian and international school contexts?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Absolutely. TREC has experience developing curricula for both local and international school curricula (British, American, Nigerian). Every curriculum is contextualised for the specific cultural and institutional environment of your school.</div>
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
        <p>Build the structural foundation that makes curriculum delivery possible and sustainable.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.training') }}" class="sd-related-card reveal" style="transition-delay:.1s">
        <div class="sd-related-tag">Development</div>
        <h4>Training &amp; Capacity Building</h4>
        <p>Ensure your counsellor and staff can deliver the curriculum with skill and confidence.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.needs-assessment') }}" class="sd-related-card reveal" style="transition-delay:.2s">
        <div class="sd-related-tag">Strategic</div>
        <h4>Needs Assessment</h4>
        <p>Understand what your students actually need before designing any curriculum or intervention.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
    </div>
  </div>
</section>

<section class="sd-cta">
  <div class="sd-cta-inner">
    <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.35)">Get Started</div>
    <h2 class="reveal" style="transition-delay:.1s">Ready to Design Your<br>Wellbeing Curriculum?</h2>
    <p class="reveal" style="transition-delay:.2s">Let's start with a conversation about your school's needs and vision for student wellbeing.</p>
    <div class="sd-cta-actions reveal" style="transition-delay:.3s">
      <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Start the Conversation</a>
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
