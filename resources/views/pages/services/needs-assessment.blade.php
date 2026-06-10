@extends('layouts.app')
@section('title', 'Needs Assessment - TREC Nigeria')
@section('meta_desc', 'TREC conducts comprehensive psychosocial, wellbeing, and behavioural needs assessments for schools — gathering and interpreting data to support evidence-based decision-making and targeted interventions.')
@section('og_title', 'Needs Assessment — TREC Nigeria')
@section('og_desc', 'Understand what your students, teachers, and community actually need. TREC provides rigorous, evidence-based wellbeing assessments tailored to your school.')
@section('breadcrumb_title', 'Needs Assessment')

@section('styles')
<style>
:root{--svc-accent:#E56918;--svc-accent-light:rgba(229,105,24,.12)}
.sd-hero{background:var(--black);padding:8rem 2rem 5rem;position:relative;overflow:hidden}
.sd-hero-bg{position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at -10% 50%,rgba(229,105,24,.16),transparent 60%),radial-gradient(ellipse 40% 60% at 110% 20%,rgba(229,105,24,.08),transparent 55%)}
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
.sd-benefit:hover{border-color:var(--svc-accent);box-shadow:0 4px 20px rgba(229,105,24,.1)}
.sd-benefit-icon{width:36px;height:36px;border-radius:8px;background:var(--svc-accent-light);display:flex;align-items:center;justify-content:center;flex-shrink:0}
.sd-benefit-icon svg{width:18px;height:18px;stroke:var(--svc-accent)}
.sd-benefit-text h4{font-size:.95rem;font-weight:700;color:var(--black);margin-bottom:.2rem}
.sd-benefit-text p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}
.sd-process-grid{display:flex;flex-direction:column;gap:0}
.sd-proc-item{display:grid;grid-template-columns:80px 1fr;gap:2rem;padding:2.5rem 0;border-bottom:1px solid rgba(255,255,255,.07);align-items:start}
.sd-proc-item:last-child{border-bottom:none}
.sd-proc-num{width:64px;height:64px;border-radius:16px;background:var(--svc-accent-light);border:1px solid rgba(229,105,24,.25);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:1.4rem;font-weight:400;color:var(--svc-accent);flex-shrink:0}
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
.sd-cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 100%,rgba(229,105,24,.18),transparent 65%)}
.sd-cta-inner{position:relative;z-index:1;max-width:640px;margin:0 auto}
.sd-cta h2{font-family:var(--font-display);font-size:clamp(2rem,4vw,3rem);color:#fff;font-weight:400;letter-spacing:-.5px;margin-bottom:1rem}
.sd-cta p{color:rgba(255,255,255,.5);font-size:1rem;font-weight:300;line-height:1.9;margin-bottom:2.5rem}
.sd-cta-actions{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.sd-related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sd-related-card{border:1px solid var(--mid);border-radius:16px;padding:1.75rem;text-decoration:none;background:#fff;transition:transform .25s,box-shadow .25s,border-color .25s;display:block}
.sd-related-card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.08);border-color:rgba(229,105,24,.3)}
.sd-related-tag{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--svc-accent);margin-bottom:.75rem}
.sd-related-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.sd-related-card p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}
.sd-related-arrow{display:inline-flex;align-items:center;gap:6px;margin-top:1rem;font-size:12px;font-weight:700;color:var(--svc-accent);text-transform:uppercase;letter-spacing:.5px}
/* Assessment types grid */
.assessment-types{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;margin-top:2.5rem}
.at-card{background:rgba(229,105,24,.06);border:1px solid rgba(229,105,24,.18);border-radius:14px;padding:1.75rem}
.at-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.65rem;display:flex;align-items:center;gap:.6rem}
.at-card h4 span{display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--svc-accent)}
.at-card p{font-size:.87rem;font-weight:300;color:var(--charcoal);line-height:1.8}
@media(max-width:1024px){.sd-hero-grid{grid-template-columns:1fr;gap:3rem}.sd-hero-img{max-width:560px}.sd-deliverables-grid{grid-template-columns:1fr 1fr}.sd-related-grid{grid-template-columns:1fr 1fr}}
@media(max-width:768px){.sd-stats-inner{grid-template-columns:1fr 1fr;gap:1.5rem}.sd-overview-grid{grid-template-columns:1fr;gap:2.5rem}.sd-proc-item{grid-template-columns:60px 1fr;gap:1.25rem}.sd-deliverables-grid{grid-template-columns:1fr}.sd-audience-grid{grid-template-columns:1fr 1fr}.sd-related-grid{grid-template-columns:1fr}.assessment-types{grid-template-columns:1fr}}
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
        <div class="sd-category reveal"><span class="sd-category-dot"></span>Strategic Research</div>
        <h1 class="reveal" style="transition-delay:.1s">Needs<br>Assessment</h1>
        <p class="sd-hero-lead reveal" style="transition-delay:.2s">
          Before any intervention, you need to understand the real landscape. TREC conducts rigorous, multi-stakeholder wellbeing assessments that reveal the psychosocial and behavioural needs of your entire school community — and translate data into strategic action.
        </p>
        <div class="sd-hero-actions reveal" style="transition-delay:.3s">
          <a href="{{ route('contact') }}" class="btn-red" style="padding:15px 36px">Request an Assessment</a>
          <a href="#overview" class="btn-ghost" style="padding:15px 36px">Learn More</a>
        </div>
      </div>
      <div class="sd-hero-img reveal-right">
        <img src="{{ asset('images/services/needs-assessment.png') }}" alt="Needs Assessment" loading="lazy">
        <div class="sd-hero-img-badge">
          <span class="sd-hero-img-badge-dot"></span>
          Evidence-Based Approach
        </div>
      </div>
    </div>
  </div>
</div>

<div class="sd-stats">
  <div class="sd-stats-inner">
    <div class="sd-stat reveal"><span class="sd-stat-num">4</span><span class="sd-stat-label">Stakeholder Groups</span></div>
    <div class="sd-stat reveal" style="transition-delay:.1s"><span class="sd-stat-num">Mixed</span><span class="sd-stat-label">Quantitative &amp; Qualitative</span></div>
    <div class="sd-stat reveal" style="transition-delay:.2s"><span class="sd-stat-num">Full</span><span class="sd-stat-label">Written Report Provided</span></div>
    <div class="sd-stat reveal" style="transition-delay:.3s"><span class="sd-stat-num">Action</span><span class="sd-stat-label">Ready Recommendations</span></div>
  </div>
</div>

<section class="sd-section sd-section--white" id="overview">
  <div class="sd-section-inner">
    <div class="sd-overview-grid">
      <div>
        <div class="eyebrow reveal">What It Is</div>
        <h2 class="stitle reveal" style="transition-delay:.1s">Know What's Really Needed Before You Act</h2>
        <p class="sd-overview-lead reveal" style="transition-delay:.2s">
          Most schools implement wellbeing programmes based on assumptions. TREC's needs assessment <strong>replaces guesswork with evidence</strong> — providing a clear, data-informed picture of the psychosocial realities in your school community.
        </p>
        <p class="sd-overview-lead reveal" style="transition-delay:.25s">
          We gather information from students, teachers, parents, and school management through <strong>surveys, focus groups, and one-to-one interviews</strong>, then synthesise and interpret the findings into a strategic report with clear, prioritised recommendations.
        </p>

        <div class="assessment-types">
          <div class="at-card reveal" style="transition-delay:.1s">
            <h4><span></span>Student Wellbeing Assessment</h4>
            <p>Explores emotional health, sense of belonging, stress levels, bullying experiences, and student support needs.</p>
          </div>
          <div class="at-card reveal" style="transition-delay:.15s">
            <h4><span></span>Staff Psychosocial Assessment</h4>
            <p>Identifies teacher stress, burnout risk, mental health literacy gaps, and capacity to support students.</p>
          </div>
          <div class="at-card reveal" style="transition-delay:.2s">
            <h4><span></span>Parent Engagement Assessment</h4>
            <p>Gauges parental awareness, attitudes to mental health, and their confidence in the school's wellbeing provision.</p>
          </div>
          <div class="at-card reveal" style="transition-delay:.25s">
            <h4><span></span>Institutional Systems Review</h4>
            <p>Evaluates the school's existing policies, referral systems, and structures for supporting student mental health.</p>
          </div>
        </div>
      </div>
      <div>
        <div class="eyebrow reveal">Key Benefits</div>
        <div class="sd-benefit-list">
          <div class="sd-benefit reveal" style="transition-delay:.1s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Evidence-Based Clarity</h4>
              <p>Replace assumptions with real data — know exactly what your community needs before spending resources.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.15s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Strategic Prioritisation</h4>
              <p>Clear recommendations ranked by urgency help you invest your time and budget where it matters most.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.2s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Multi-Stakeholder Voice</h4>
              <p>Students, staff, parents, and leaders are all heard — creating a richer, more accurate picture of school life.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.25s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Baseline for Measuring Impact</h4>
              <p>The assessment creates a baseline that allows you to measure the impact of any subsequent interventions over time.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--dark">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3.5rem">
      <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.4)">How We Do It</div>
      <h2 class="stitle reveal" style="color:#fff;text-align:center;transition-delay:.1s">The Assessment Process</h2>
    </div>
    <div class="sd-process-grid">
      <div class="sd-proc-item reveal">
        <div class="sd-proc-num">01</div>
        <div class="sd-proc-body">
          <h3>Scoping &amp; Planning</h3>
          <p>We begin by clarifying your objectives, agreeing on scope, selecting the appropriate data collection methods, and designing the assessment instruments — all aligned to your specific context.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.1s">
        <div class="sd-proc-num">02</div>
        <div class="sd-proc-body">
          <h3>Data Collection</h3>
          <p>We deploy validated surveys, facilitate structured focus groups, and conduct key stakeholder interviews — across student, teacher, parent, and management groups — ethically and confidentially.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.2s">
        <div class="sd-proc-num">03</div>
        <div class="sd-proc-body">
          <h3>Analysis &amp; Interpretation</h3>
          <p>We apply both quantitative and qualitative analytical frameworks to the data, identifying patterns, themes, and priority areas — and contextualising findings within your school's unique environment.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.3s">
        <div class="sd-proc-num">04</div>
        <div class="sd-proc-body">
          <h3>Report Writing</h3>
          <p>We produce a comprehensive, professionally written needs assessment report with an executive summary, detailed findings, and clear, prioritised recommendations for action.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.4s">
        <div class="sd-proc-num">05</div>
        <div class="sd-proc-body">
          <h3>Presentation &amp; Planning Session</h3>
          <p>We present the findings to your leadership team in a facilitated debrief session, supporting you to translate insights into an actionable implementation plan with clear next steps.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="sd-section sd-section--cream">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center">What You Get</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">Deliverables</h2>
    </div>
    <div class="sd-deliverables-grid">
      <div class="sd-deliverable reveal">
        <div class="sd-deliverable-num">01</div>
        <h4>Comprehensive Needs Assessment Report</h4>
        <p>A full written report with findings, themes, and insights from all stakeholder groups — your definitive reference document.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.1s">
        <div class="sd-deliverable-num">02</div>
        <h4>Executive Summary</h4>
        <p>A concise 2–3 page summary of the most critical findings for sharing with governors, leadership, or funders.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.2s">
        <div class="sd-deliverable-num">03</div>
        <h4>Prioritised Recommendations</h4>
        <p>Ranked, actionable recommendations — short, medium, and long-term — mapped to your specific wellbeing goals.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.3s">
        <div class="sd-deliverable-num">04</div>
        <h4>Data Visualisation Pack</h4>
        <p>Charts, graphs, and visual summaries of key data points — easy to share at staff meetings, parent sessions, or board level.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.4s">
        <div class="sd-deliverable-num">05</div>
        <h4>Stakeholder Presentation</h4>
        <p>A facilitated debrief with your leadership team to walk through findings, answer questions, and plan next steps together.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.5s">
        <div class="sd-deliverable-num">06</div>
        <h4>Baseline Wellbeing Index</h4>
        <p>A snapshot wellbeing index score for your school community, providing a measurable baseline for tracking improvement over time.</p>
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
        <h4>Schools Starting from Scratch</h4>
        <p>Schools that want to build a wellbeing strategy grounded in real evidence rather than assumptions or peer pressure.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.1s">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div>
        <h4>Schools Reviewing Their Approach</h4>
        <p>Schools that have had wellbeing programmes but aren't sure they're addressing the right issues or reaching the right people.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.2s">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
        <h4>Schools Preparing for Expansion</h4>
        <p>Schools opening new campuses or programmes who want to understand new community needs before designing support systems.</p>
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
          <h4>How long does a needs assessment take to complete?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">A full multi-stakeholder assessment typically takes 3–6 weeks from scoping to report delivery, depending on school size. A targeted single-group assessment (e.g., students only) can be completed in 2–3 weeks. We agree the timeline upfront based on your needs and scheduling constraints.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.1s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>How is confidentiality maintained during data collection?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">All data is collected anonymously or with explicit consent, depending on the method. We follow professional ethical guidelines and our data handling is compliant with relevant privacy standards. No individual is identifiable in the final report without their explicit consent.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.2s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>Can TREC also implement the recommendations after the report?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Yes — and this is where we add the most value. Many schools commission a needs assessment and then engage TREC to implement the recommendations through our other services: department setup, curriculum development, training, or the wellbeing package. We can help you map a full programme based on the findings.</div>
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
        <p>Act on your assessment findings by building a properly structured counselling department.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.curriculum') }}" class="sd-related-card reveal" style="transition-delay:.1s">
        <div class="sd-related-tag">Education</div>
        <h4>Curriculum Development</h4>
        <p>Design a wellbeing curriculum that directly addresses the needs identified in your assessment.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.wellbeing') }}" class="sd-related-card reveal" style="transition-delay:.2s">
        <div class="sd-related-tag">Comprehensive</div>
        <h4>Wellbeing Package</h4>
        <p>A full-year integrated wellbeing programme — the natural next step after a thorough needs assessment.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
    </div>
  </div>
</section>

<section class="sd-cta">
  <div class="sd-cta-inner">
    <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.35)">Get Started</div>
    <h2 class="reveal" style="transition-delay:.1s">Ready to Understand<br>What Your School Needs?</h2>
    <p class="reveal" style="transition-delay:.2s">Let's have a conversation about your context and design an assessment that gives you the answers you need.</p>
    <div class="sd-cta-actions reveal" style="transition-delay:.3s">
      <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Request an Assessment</a>
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
