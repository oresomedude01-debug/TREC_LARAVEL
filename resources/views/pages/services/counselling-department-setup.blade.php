@extends('layouts.app')
@section('title', 'Counselling Department Setup - TREC Nigeria')
@section('meta_desc', 'TREC helps schools establish a fully functional counselling department — structures, documentation, referral pathways, assessment processes and reporting systems for effective student support.')
@section('og_title', 'Counselling Department Setup — TREC Nigeria')
@section('og_desc', 'Build a professional, structured counselling department from the ground up. TREC provides the frameworks, documentation, and systems schools need.')
@section('breadcrumb_title', 'Counselling Department Setup')

@section('styles')
<style>
/* ── SHARED SERVICE PAGE STYLES ── */
:root{
  --svc-accent: #D82D37;
  --svc-accent-light: rgba(216,45,55,.12);
}
.sd-hero{
  background:var(--black);padding:8rem 2rem 5rem;
  position:relative;overflow:hidden;
}
.sd-hero-bg{
  position:absolute;inset:0;
  background:
    radial-gradient(ellipse 60% 80% at -10% 50%,rgba(216,45,55,.16),transparent 60%),
    radial-gradient(ellipse 40% 60% at 110% 20%,rgba(216,45,55,.08),transparent 55%);
}
.sd-hero-bar{position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))}
.sd-hero-inner{max-width:1200px;margin:0 auto;position:relative;z-index:2;}
.sd-back{
  display:inline-flex;align-items:center;gap:8px;
  font-size:12px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
  color:rgba(255,255,255,.4);text-decoration:none;margin-bottom:2.5rem;
  transition:color .2s;
}
.sd-back:hover{color:rgba(255,255,255,.75)}
.sd-back svg{width:16px;height:16px}
.sd-hero-grid{display:grid;grid-template-columns:1fr 480px;gap:5rem;align-items:center}
.sd-category{
  display:inline-flex;align-items:center;gap:8px;
  font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;
  color:var(--svc-accent);margin-bottom:1.25rem;
}
.sd-category-dot{width:6px;height:6px;border-radius:50%;background:var(--svc-accent)}
.sd-hero h1{
  font-family:var(--font-display);font-size:clamp(2.6rem,4.5vw,3.8rem);
  font-weight:400;color:#fff;line-height:1.05;letter-spacing:-1.5px;
  margin-bottom:1.5rem;
}
.sd-hero-lead{
  font-size:1.05rem;font-weight:300;color:rgba(255,255,255,.55);
  max-width:540px;line-height:1.95;margin-bottom:2.5rem;
}
.sd-hero-actions{display:flex;gap:1rem;flex-wrap:wrap;align-items:center}
.sd-hero-img{
  border-radius:20px;overflow:hidden;
  box-shadow:0 30px 80px rgba(0,0,0,.5);
  border:1px solid rgba(255,255,255,.07);
  position:relative;
}
.sd-hero-img img{width:100%;height:360px;object-fit:cover;display:block}
.sd-hero-img-badge{
  position:absolute;bottom:20px;left:20px;
  background:rgba(0,0,0,.75);backdrop-filter:blur(12px);
  border:1px solid rgba(255,255,255,.12);border-radius:10px;
  padding:.65rem 1rem;
  font-size:12px;font-weight:600;color:#fff;
  display:flex;align-items:center;gap:.5rem;
}
.sd-hero-img-badge-dot{width:6px;height:6px;border-radius:50%;background:var(--svc-accent)}

/* ── STATS BAR ── */
.sd-stats{
  background:rgba(255,255,255,.03);
  border-top:1px solid rgba(255,255,255,.06);
  border-bottom:1px solid rgba(255,255,255,.06);
  padding:2rem;
}
.sd-stats-inner{
  max-width:1200px;margin:0 auto;
  display:grid;grid-template-columns:repeat(4,1fr);
  gap:2rem;
}
.sd-stat{text-align:center}
.sd-stat-num{
  font-family:var(--font-display);font-size:2.2rem;font-weight:400;
  color:#fff;letter-spacing:-1px;display:block;margin-bottom:.3rem;
}
.sd-stat-label{font-size:12px;font-weight:500;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:1px}

/* ── SECTIONS ── */
.sd-section{padding:5.5rem 2rem}
.sd-section-inner{max-width:1200px;margin:0 auto}
.sd-section--cream{background:var(--cream)}
.sd-section--white{background:#fff}
.sd-section--dark{background:var(--black)}
.sd-section--mid{background:var(--light)}

.sd-overview-grid{display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:start}
.sd-overview-lead{
  font-size:1.1rem;font-weight:300;line-height:2;
  color:var(--charcoal);margin-bottom:1.75rem;
}
.sd-overview-lead strong{color:var(--black);font-weight:700}
.sd-benefit-list{display:flex;flex-direction:column;gap:.85rem;margin-top:2rem}
.sd-benefit{
  display:flex;align-items:flex-start;gap:1rem;
  padding:1rem 1.25rem;
  background:#fff;border:1px solid var(--mid);border-radius:12px;
  transition:border-color .2s,box-shadow .2s;
}
.sd-benefit:hover{border-color:var(--svc-accent);box-shadow:0 4px 20px rgba(216,45,55,.08)}
.sd-benefit-icon{
  width:36px;height:36px;border-radius:8px;
  background:var(--svc-accent-light);display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}
.sd-benefit-icon svg{width:18px;height:18px;stroke:var(--svc-accent)}
.sd-benefit-text h4{font-size:.95rem;font-weight:700;color:var(--black);margin-bottom:.2rem}
.sd-benefit-text p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}

/* ── PROCESS ── */
.sd-process-grid{display:flex;flex-direction:column;gap:0}
.sd-proc-item{
  display:grid;grid-template-columns:80px 1fr;gap:2rem;
  padding:2.5rem 0;border-bottom:1px solid rgba(255,255,255,.07);
  align-items:start;
}
.sd-proc-item:last-child{border-bottom:none}
.sd-proc-num{
  width:64px;height:64px;border-radius:16px;
  background:var(--svc-accent-light);border:1px solid rgba(216,45,55,.25);
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-display);font-size:1.4rem;font-weight:400;
  color:var(--svc-accent);flex-shrink:0;
}
.sd-proc-body h3{
  font-family:var(--font-h);font-size:1.15rem;font-weight:700;
  color:#fff;margin-bottom:.65rem;
}
.sd-proc-body p{font-size:.92rem;font-weight:300;color:rgba(255,255,255,.55);line-height:1.9}

/* ── DELIVERABLES ── */
.sd-deliverables-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sd-deliverable{
  background:#fff;border:1px solid var(--mid);border-radius:16px;
  padding:2rem 1.75rem;transition:transform .25s,box-shadow .25s;
}
.sd-deliverable:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.08)}
.sd-deliverable-num{
  font-family:var(--font-display);font-size:2.5rem;font-weight:400;
  color:var(--light);line-height:1;margin-bottom:1rem;
}
.sd-deliverable h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.65rem}
.sd-deliverable p{font-size:.87rem;font-weight:300;color:var(--charcoal);line-height:1.8}

/* ── WHO IT'S FOR ── */
.sd-audience-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sd-audience-card{
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);
  border-radius:16px;padding:2rem 1.75rem;
  transition:background .2s,border-color .2s;
}
.sd-audience-card:hover{background:rgba(255,255,255,.08);border-color:rgba(255,255,255,.15)}
.sd-audience-icon{
  width:48px;height:48px;border-radius:12px;
  background:var(--svc-accent-light);
  display:flex;align-items:center;justify-content:center;
  margin-bottom:1.25rem;
}
.sd-audience-icon svg{width:22px;height:22px;stroke:var(--svc-accent)}
.sd-audience-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:#fff;margin-bottom:.5rem}
.sd-audience-card p{font-size:.87rem;font-weight:300;color:rgba(255,255,255,.5);line-height:1.75}

/* ── FAQ ── */
.sd-faq-list{display:flex;flex-direction:column;gap:1rem;max-width:820px;margin:0 auto}
.sd-faq-item{
  border:1px solid var(--mid);border-radius:14px;overflow:hidden;
  background:#fff;
}
.sd-faq-q{
  width:100%;display:flex;align-items:center;justify-content:space-between;
  gap:1rem;padding:1.4rem 1.75rem;cursor:pointer;
  background:none;border:none;text-align:left;
}
.sd-faq-q h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black)}
.sd-faq-icon{
  width:28px;height:28px;border-radius:50%;background:var(--light);
  display:flex;align-items:center;justify-content:center;flex-shrink:0;
  transition:background .2s,transform .3s;
}
.sd-faq-item.open .sd-faq-icon{background:var(--svc-accent);transform:rotate(45deg)}
.sd-faq-icon svg{width:14px;height:14px;stroke:var(--charcoal)}
.sd-faq-item.open .sd-faq-icon svg{stroke:#fff}
.sd-faq-a{
  max-height:0;overflow:hidden;
  padding:0 1.75rem;
  transition:max-height .4s ease,padding .4s ease;
  font-size:.92rem;font-weight:300;color:var(--charcoal);line-height:1.9;
}
.sd-faq-item.open .sd-faq-a{max-height:400px;padding:.25rem 1.75rem 1.5rem}

/* ── CTA ── */
.sd-cta{background:var(--black);padding:6rem 2rem;text-align:center;position:relative;overflow:hidden}
.sd-cta::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 50% 100%,rgba(216,45,55,.18),transparent 65%)}
.sd-cta-inner{position:relative;z-index:1;max-width:640px;margin:0 auto}
.sd-cta h2{font-family:var(--font-display);font-size:clamp(2rem,4vw,3rem);color:#fff;font-weight:400;letter-spacing:-.5px;margin-bottom:1rem}
.sd-cta p{color:rgba(255,255,255,.5);font-size:1rem;font-weight:300;line-height:1.9;margin-bottom:2.5rem}
.sd-cta-actions{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}

/* ── RELATED ── */
.sd-related-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem}
.sd-related-card{
  border:1px solid var(--mid);border-radius:16px;padding:1.75rem;
  text-decoration:none;background:#fff;
  transition:transform .25s,box-shadow .25s,border-color .25s;display:block;
}
.sd-related-card:hover{transform:translateY(-4px);box-shadow:0 12px 40px rgba(0,0,0,.08);border-color:rgba(216,45,55,.3)}
.sd-related-tag{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--svc-accent);margin-bottom:.75rem}
.sd-related-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.sd-related-card p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}
.sd-related-arrow{display:inline-flex;align-items:center;gap:6px;margin-top:1rem;font-size:12px;font-weight:700;color:var(--svc-accent);text-transform:uppercase;letter-spacing:.5px}

@media(max-width:1024px){
  .sd-hero-grid{grid-template-columns:1fr;gap:3rem}
  .sd-hero-img{max-width:560px}
  .sd-deliverables-grid{grid-template-columns:1fr 1fr}
  .sd-related-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:768px){
  .sd-stats-inner{grid-template-columns:1fr 1fr;gap:1.5rem}
  .sd-overview-grid{grid-template-columns:1fr;gap:2.5rem}
  .sd-proc-item{grid-template-columns:60px 1fr;gap:1.25rem}
  .sd-deliverables-grid{grid-template-columns:1fr}
  .sd-audience-grid{grid-template-columns:1fr 1fr}
  .sd-related-grid{grid-template-columns:1fr}
}
@media(max-width:480px){
  .sd-stats-inner{grid-template-columns:1fr 1fr}
  .sd-audience-grid{grid-template-columns:1fr}
  .sd-hero-actions{flex-direction:column;align-items:flex-start}
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
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
        <div class="sd-category reveal">
          <span class="sd-category-dot"></span>
          Schools &amp; Institutions
        </div>
        <h1 class="reveal" style="transition-delay:.1s">Counselling<br>Department<br>Set Up</h1>
        <p class="sd-hero-lead reveal" style="transition-delay:.2s">
          TREC helps schools build a fully functional, professionally structured counselling department — from scratch or restructuring an existing one — with the systems, processes, and documentation needed for lasting impact.
        </p>
        <div class="sd-hero-actions reveal" style="transition-delay:.3s">
          <a href="{{ route('contact') }}" class="btn-red" style="padding:15px 36px">Book a Free Consultation</a>
          <a href="#overview" class="btn-ghost" style="padding:15px 36px">Learn More</a>
        </div>
      </div>
      <div class="sd-hero-img reveal-right">
        <img src="{{ asset('images/services/dept-setup.png') }}" alt="Counselling Department Setup" loading="lazy">
        <div class="sd-hero-img-badge">
          <span class="sd-hero-img-badge-dot"></span>
          Service for Schools
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ── STATS BAR ── -->
<div class="sd-stats" style="background:rgba(0,0,0,.85)">
  <div class="sd-stats-inner">
    <div class="sd-stat reveal">
      <span class="sd-stat-num">5+</span>
      <span class="sd-stat-label">Core Systems Established</span>
    </div>
    <div class="sd-stat reveal" style="transition-delay:.1s">
      <span class="sd-stat-num">100%</span>
      <span class="sd-stat-label">Customised to Your School</span>
    </div>
    <div class="sd-stat reveal" style="transition-delay:.2s">
      <span class="sd-stat-num">360°</span>
      <span class="sd-stat-label">Student Support Coverage</span>
    </div>
    <div class="sd-stat reveal" style="transition-delay:.3s">
      <span class="sd-stat-num">Expert</span>
      <span class="sd-stat-label">TREC-Led Implementation</span>
    </div>
  </div>
</div>

<!-- ── OVERVIEW ── -->
<section class="sd-section sd-section--white" id="overview">
  <div class="sd-section-inner">
    <div class="sd-overview-grid">
      <div>
        <div class="eyebrow reveal">What It Is</div>
        <h2 class="stitle reveal" style="transition-delay:.1s">Building the Foundation for Student Wellbeing</h2>
        <p class="sd-overview-lead reveal" style="transition-delay:.2s">
          Many schools recognise the need for counselling but lack the <strong>structures, systems, and documentation</strong> to make it work professionally. Without these, counselling remains reactive, underfunded, and under-valued.
        </p>
        <p class="sd-overview-lead reveal" style="transition-delay:.25s">
          TREC's Counselling Department Setup service provides schools with a <strong>complete operational framework</strong> — from department structure and job roles to referral pathways, case management systems, and compliance documentation — transforming counselling from an afterthought into a strategic pillar of school life.
        </p>
      </div>
      <div>
        <div class="eyebrow reveal">Key Benefits</div>
        <div class="sd-benefit-list">
          <div class="sd-benefit reveal" style="transition-delay:.1s">
            <div class="sd-benefit-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
            </div>
            <div class="sd-benefit-text">
              <h4>Professional Credibility</h4>
              <p>A properly structured department signals commitment to student welfare — building trust with parents, staff, and regulators.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.15s">
            <div class="sd-benefit-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
            </div>
            <div class="sd-benefit-text">
              <h4>Faster, Better Responses</h4>
              <p>Clear referral pathways and protocols mean students get help quickly, reducing crises and improving outcomes.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.2s">
            <div class="sd-benefit-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div class="sd-benefit-text">
              <h4>Documentation &amp; Compliance</h4>
              <p>Proper record-keeping and reporting systems protect both students and the institution, meeting professional standards.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.25s">
            <div class="sd-benefit-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            </div>
            <div class="sd-benefit-text">
              <h4>Whole-School Impact</h4>
              <p>When counselling is properly structured, the entire school community — students, staff, and parents — benefits.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── PROCESS ── -->
<section class="sd-section sd-section--dark">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3.5rem">
      <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.4)">How We Do It</div>
      <h2 class="stitle reveal" style="color:#fff;text-align:center;transition-delay:.1s">Our Setup Process</h2>
      <p class="slead reveal" style="text-align:center;margin:0 auto;transition-delay:.2s;color:rgba(255,255,255,.45)">A structured, collaborative process that respects your school's culture and builds lasting capacity.</p>
    </div>
    <div class="sd-process-grid">
      <div class="sd-proc-item reveal">
        <div class="sd-proc-num">01</div>
        <div class="sd-proc-body">
          <h3>Discovery &amp; Audit</h3>
          <p>We begin with an in-depth consultation to understand your school's current situation — existing structures, staff capacity, student demographics, and the specific challenges you face. We conduct a full audit of what's working and what's missing.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.1s">
        <div class="sd-proc-num">02</div>
        <div class="sd-proc-body">
          <h3>Department Design</h3>
          <p>Based on your context, we co-create the counselling department structure — defining roles, responsibilities, reporting lines, and how the department integrates with the wider school management team.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.2s">
        <div class="sd-proc-num">03</div>
        <div class="sd-proc-body">
          <h3>Systems &amp; Documentation</h3>
          <p>We develop all the operational documents your department needs: referral forms, intake assessment tools, case notes templates, confidentiality agreements, safeguarding protocols, and termly reporting frameworks.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.3s">
        <div class="sd-proc-num">04</div>
        <div class="sd-proc-body">
          <h3>Staff Orientation &amp; Training</h3>
          <p>We onboard your counsellor(s) and relevant staff to the new systems, ensuring everyone understands their role in supporting the department. We provide hands-on training on using the documentation and following protocols.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.4s">
        <div class="sd-proc-num">05</div>
        <div class="sd-proc-body">
          <h3>Launch &amp; Review</h3>
          <p>We support the formal launch of the department, monitor early implementation, gather feedback, and make refinements — ensuring everything runs smoothly from day one and is sustainable long-term.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── DELIVERABLES ── -->
<section class="sd-section sd-section--cream">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center">What You Get</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">What's Included</h2>
      <p class="slead reveal" style="text-align:center;margin:0 auto;transition-delay:.2s">Every deliverable is tailored to your school context and handed over as a living document your team can use immediately.</p>
    </div>
    <div class="sd-deliverables-grid">
      <div class="sd-deliverable reveal">
        <div class="sd-deliverable-num">01</div>
        <h4>Department Structure Blueprint</h4>
        <p>A clear organisational chart with defined roles, responsibilities, and reporting lines for your counselling department.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.1s">
        <div class="sd-deliverable-num">02</div>
        <h4>Documentation System</h4>
        <p>Complete set of intake forms, case note templates, progress tracking sheets, and termly reporting formats.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.2s">
        <div class="sd-deliverable-num">03</div>
        <h4>Referral Pathway Protocol</h4>
        <p>Step-by-step referral guidelines for teachers, form tutors, and parents — so the right student gets the right help, fast.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.3s">
        <div class="sd-deliverable-num">04</div>
        <h4>Assessment Framework</h4>
        <p>Age-appropriate wellbeing and psychosocial screening tools for identifying students in need of counselling support.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.4s">
        <div class="sd-deliverable-num">05</div>
        <h4>Safeguarding &amp; Ethics Policy</h4>
        <p>A counselling-specific safeguarding and ethics policy aligned with best practice standards for school counselling.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.5s">
        <div class="sd-deliverable-num">06</div>
        <h4>Implementation Support</h4>
        <p>Hands-on guidance during the launch phase with follow-up reviews to embed the systems securely into school life.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── WHO IT'S FOR ── -->
<section class="sd-section sd-section--dark">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.4)">Ideal For</div>
      <h2 class="stitle reveal" style="color:#fff;text-align:center;transition-delay:.1s">Who This Service Is For</h2>
    </div>
    <div class="sd-audience-grid">
      <div class="sd-audience-card reveal">
        <div class="sd-audience-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <h4>Schools Without Counselling</h4>
        <p>Schools that have never had a formal counselling department and want to build one properly from the ground up.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.1s">
        <div class="sd-audience-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
        </div>
        <h4>Schools Seeking Restructuring</h4>
        <p>Schools that have a counsellor or informal setup but want to professionalise it with proper systems and documentation.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.2s">
        <div class="sd-audience-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        </div>
        <h4>Growing &amp; Elite Schools</h4>
        <p>Forward-thinking schools that want counselling to be a strategic differentiator and a signal of their commitment to excellence.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── FAQ ── -->
<section class="sd-section sd-section--white">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center">Common Questions</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">Frequently Asked Questions</h2>
    </div>
    <div class="sd-faq-list">
      <div class="sd-faq-item reveal">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>How long does the department setup process take?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Typically 4–8 weeks depending on school size and readiness. We begin with a discovery phase, move to design and documentation, and close with a supported launch. The timeline is always discussed and agreed with you upfront.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.1s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>Do we need to already have a counsellor before engaging TREC?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Not necessarily. We can work with you at any stage — whether you already have a counsellor who needs structure, you're recruiting one, or you're still deciding on staffing. We also provide guidance on what to look for when hiring a school counsellor.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.2s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>Can TREC work with our existing systems and school policies?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Absolutely. We always begin with an audit of what's already in place and build on it. We never impose a one-size-fits-all approach — every system and document we create is tailored to your school's context, ethos, and existing policies.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.3s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>What ongoing support is available after the setup is complete?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">We offer several ongoing support options — including our School Management Wellbeing Package, which provides continuous counselling, training, and advisory services throughout the school year. We can also agree ad-hoc review or consultancy sessions as needed.</div>
      </div>
    </div>
  </div>
</section>

<!-- ── RELATED SERVICES ── -->
<section class="sd-section sd-section--cream">
  <div class="sd-section-inner">
    <div style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow reveal" style="justify-content:center">Explore More</div>
      <h2 class="stitle reveal" style="text-align:center;transition-delay:.1s">Related Services</h2>
    </div>
    <div class="sd-related-grid">
      <a href="{{ route('services.curriculum') }}" class="sd-related-card reveal">
        <div class="sd-related-tag">Education</div>
        <h4>Curriculum Development</h4>
        <p>Age-appropriate wellbeing curricula that embed emotional intelligence into everyday school life.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.training') }}" class="sd-related-card reveal" style="transition-delay:.1s">
        <div class="sd-related-tag">Development</div>
        <h4>Training &amp; Capacity Building</h4>
        <p>Equip your teachers, leaders, and counsellors with the skills to support students effectively.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.wellbeing') }}" class="sd-related-card reveal" style="transition-delay:.2s">
        <div class="sd-related-tag">Comprehensive</div>
        <h4>Wellbeing Package</h4>
        <p>An all-in-one structured wellbeing programme covering counselling, training, reporting, and crisis support.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section class="sd-cta">
  <div class="sd-cta-inner">
    <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.35)">Get Started</div>
    <h2 class="reveal" style="transition-delay:.1s">Ready to Build Your<br>Counselling Department?</h2>
    <p class="reveal" style="transition-delay:.2s">Let's begin with a free, no-obligation consultation where we listen to your school's needs and show you what's possible.</p>
    <div class="sd-cta-actions reveal" style="transition-delay:.3s">
      <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Book Free Consultation</a>
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
  document.querySelectorAll('.sd-faq-item.open').forEach(el => el.classList.remove('open'));
  if(!wasOpen) item.classList.add('open');
}
</script>
@endsection
