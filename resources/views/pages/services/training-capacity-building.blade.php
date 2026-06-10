@extends('layouts.app')
@section('title', 'Training & Capacity Building - TREC Nigeria')
@section('meta_desc', 'TREC equips teachers, school leaders, counsellors, and parents with the knowledge and practical skills to identify, support, and respond to emotional, behavioural, and psychosocial needs.')
@section('og_title', 'Training & Capacity Building — TREC Nigeria')
@section('og_desc', 'Transform your entire school community into confident mental health allies. TREC delivers expert training for teachers, leaders, counsellors, and parents.')
@section('breadcrumb_title', 'Training & Capacity Building')

@section('styles')
<style>
:root{--svc-accent:#6b8f1a;--svc-accent-light:rgba(107,143,26,.12)}
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
/* Training tracks */
.training-tracks{display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;margin-top:2.5rem}
.tt-card{background:rgba(107,143,26,.06);border:1px solid rgba(107,143,26,.18);border-radius:14px;padding:1.75rem}
.tt-badge{display:inline-block;padding:4px 14px;border-radius:100px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;background:rgba(107,143,26,.1);color:#6b8f1a;margin-bottom:1rem}
.tt-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.tt-card p{font-size:.87rem;font-weight:300;color:var(--charcoal);line-height:1.8}
@media(max-width:1024px){.sd-hero-grid{grid-template-columns:1fr;gap:3rem}.sd-hero-img{max-width:560px}.sd-deliverables-grid{grid-template-columns:1fr 1fr}.sd-related-grid{grid-template-columns:1fr 1fr}.training-tracks{grid-template-columns:1fr}}
@media(max-width:768px){.sd-stats-inner{grid-template-columns:1fr 1fr;gap:1.5rem}.sd-overview-grid{grid-template-columns:1fr;gap:2.5rem}.sd-proc-item{grid-template-columns:60px 1fr;gap:1.25rem}.sd-deliverables-grid{grid-template-columns:1fr}.sd-audience-grid{grid-template-columns:1fr 1fr}.sd-related-grid{grid-template-columns:1fr}}
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
        <div class="sd-category reveal"><span class="sd-category-dot"></span>Professional Development</div>
        <h1 class="reveal" style="transition-delay:.1s">Training &amp;<br>Capacity<br>Building</h1>
        <p class="sd-hero-lead reveal" style="transition-delay:.2s">
          When everyone in a school community has the knowledge and skills to recognise and respond to mental health needs, outcomes improve dramatically. TREC delivers practical, expert-facilitated training for teachers, leaders, counsellors, parents, and students.
        </p>
        <div class="sd-hero-actions reveal" style="transition-delay:.3s">
          <a href="{{ route('contact') }}" class="btn-red" style="padding:15px 36px">Schedule Training</a>
          <a href="#overview" class="btn-ghost" style="padding:15px 36px">Learn More</a>
        </div>
      </div>
      <div class="sd-hero-img reveal-right">
        <img src="{{ asset('images/services/training.png') }}" alt="Training and Capacity Building" loading="lazy">
        <div class="sd-hero-img-badge">
          <span class="sd-hero-img-badge-dot"></span>
          Expert-Led Workshops
        </div>
      </div>
    </div>
  </div>
</div>

<div class="sd-stats">
  <div class="sd-stats-inner">
    <div class="sd-stat reveal"><span class="sd-stat-num">5</span><span class="sd-stat-label">Target Audiences</span></div>
    <div class="sd-stat reveal" style="transition-delay:.1s"><span class="sd-stat-num">10+</span><span class="sd-stat-label">Training Modules</span></div>
    <div class="sd-stat reveal" style="transition-delay:.2s"><span class="sd-stat-num">100%</span><span class="sd-stat-label">Practical &amp; Contextualised</span></div>
    <div class="sd-stat reveal" style="transition-delay:.3s"><span class="sd-stat-num">CPD</span><span class="sd-stat-label">Certified Programmes</span></div>
  </div>
</div>

<section class="sd-section sd-section--white" id="overview">
  <div class="sd-section-inner">
    <div class="sd-overview-grid">
      <div>
        <div class="eyebrow reveal">What It Is</div>
        <h2 class="stitle reveal" style="transition-delay:.1s">Building a Whole-School Mental Health Workforce</h2>
        <p class="sd-overview-lead reveal" style="transition-delay:.2s">
          A well-trained school community doesn't just refer students to the counsellor — it <strong>actively supports wellbeing at every level</strong>. TREC's training programmes build the mental health literacy, early identification skills, and evidence-based response capacity of every stakeholder group.
        </p>
        <p class="sd-overview-lead reveal" style="transition-delay:.25s">
          Our training is <strong>interactive, evidence-based, and practically focused</strong> — combining theory with real-world scenarios, case studies, and role-play to build confidence alongside competence.
        </p>

        <div class="training-tracks">
          <div class="tt-card reveal" style="transition-delay:.1s">
            <div class="tt-badge">Teachers &amp; Staff</div>
            <h4>Mental Health in the Classroom</h4>
            <p>Recognising distress, trauma-informed responses, and when and how to refer students for professional support.</p>
          </div>
          <div class="tt-card reveal" style="transition-delay:.15s">
            <div class="tt-badge">School Leaders</div>
            <h4>Leading Wellbeing Strategically</h4>
            <p>Embedding wellbeing into school culture, governance, policy, and whole-school strategy from the top.</p>
          </div>
          <div class="tt-card reveal" style="transition-delay:.2s">
            <div class="tt-badge">Counsellors</div>
            <h4>Advanced Counselling Skills</h4>
            <p>Deepening clinical skills in assessment, therapeutic modalities, ethics, documentation, and supervision.</p>
          </div>
          <div class="tt-card reveal" style="transition-delay:.25s">
            <div class="tt-badge">Parents</div>
            <h4>Parenting for Wellbeing</h4>
            <p>How to talk about mental health at home, spot early warning signs, and support a child's emotional development.</p>
          </div>
        </div>
      </div>
      <div>
        <div class="eyebrow reveal">Key Benefits</div>
        <div class="sd-benefit-list">
          <div class="sd-benefit reveal" style="transition-delay:.1s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Whole-School Uplift</h4>
              <p>Every staff member becomes a first line of support — dramatically expanding the school's wellbeing reach.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.15s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Practical, Not Just Theoretical</h4>
              <p>Every session is grounded in real scenarios your staff will encounter — building skills they can use from day one.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.2s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Earlier Identification</h4>
              <p>Trained staff spot mental health struggles earlier — reducing escalation and enabling faster, more effective support.</p>
            </div>
          </div>
          <div class="sd-benefit reveal" style="transition-delay:.25s">
            <div class="sd-benefit-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div>
            <div class="sd-benefit-text">
              <h4>Builds Institutional Confidence</h4>
              <p>A trained school community is more confident in handling mental health disclosures, crises, and ongoing support needs.</p>
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
      <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.4)">How We Work</div>
      <h2 class="stitle reveal" style="color:#fff;text-align:center;transition-delay:.1s">Our Training Process</h2>
    </div>
    <div class="sd-process-grid">
      <div class="sd-proc-item reveal">
        <div class="sd-proc-num">01</div>
        <div class="sd-proc-body">
          <h3>Training Needs Analysis</h3>
          <p>We begin by understanding who needs training, what gaps exist, what outcomes your school wants, and any specific challenges or contexts that should shape the programme design.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.1s">
        <div class="sd-proc-num">02</div>
        <div class="sd-proc-body">
          <h3>Programme Design &amp; Customisation</h3>
          <p>We design a bespoke training programme — selecting the right modules, format (workshop, webinar, coaching), duration, and sequencing — and share the plan for leadership approval before delivery begins.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.2s">
        <div class="sd-proc-num">03</div>
        <div class="sd-proc-body">
          <h3>Training Delivery</h3>
          <p>Our expert facilitators deliver engaging, interactive sessions using a mix of presentations, video, group activities, case studies, reflective exercises, and practical skills practice in a psychologically safe environment.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.3s">
        <div class="sd-proc-num">04</div>
        <div class="sd-proc-body">
          <h3>Resource Handover</h3>
          <p>Participants receive a full resource pack — including session notes, reference guides, practical tools, and recommended further reading — to reinforce their learning after the training.</p>
        </div>
      </div>
      <div class="sd-proc-item reveal" style="transition-delay:.4s">
        <div class="sd-proc-num">05</div>
        <div class="sd-proc-body">
          <h3>Follow-Up &amp; Impact Evaluation</h3>
          <p>We conduct a post-training evaluation survey and, where agreed, follow-up observation or coaching to ensure skills are being applied and outcomes are being achieved in practice.</p>
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
        <h4>Bespoke Training Programme</h4>
        <p>A fully customised training plan mapped to your school's specific needs, audience, and wellbeing goals.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.1s">
        <div class="sd-deliverable-num">02</div>
        <h4>Expert Facilitators</h4>
        <p>Sessions delivered by TREC's qualified mental health professionals with extensive school-based training experience.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.2s">
        <div class="sd-deliverable-num">03</div>
        <h4>Participant Resource Packs</h4>
        <p>Comprehensive handouts, reference guides, and practical toolkits for every participant to take away and use.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.3s">
        <div class="sd-deliverable-num">04</div>
        <h4>Pre &amp; Post Assessment</h4>
        <p>Knowledge and confidence assessments before and after training to measure growth and evidence impact.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.4s">
        <div class="sd-deliverable-num">05</div>
        <h4>Training Completion Certificates</h4>
        <p>CPD-recognised certificates of participation for all attendees — valuable for professional development records.</p>
      </div>
      <div class="sd-deliverable reveal" style="transition-delay:.5s">
        <div class="sd-deliverable-num">06</div>
        <h4>Impact Evaluation Report</h4>
        <p>A written summary of training outcomes, participant feedback, and recommended next steps for ongoing development.</p>
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
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
        <h4>Teachers &amp; Support Staff</h4>
        <p>Build every staff member's confidence in recognising, responding to, and referring students with mental health concerns.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.1s">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg></div>
        <h4>School Leadership Teams</h4>
        <p>Equip principals, vice-principals, and governors to lead, advocate for, and resource whole-school wellbeing.</p>
      </div>
      <div class="sd-audience-card reveal" style="transition-delay:.2s">
        <div class="sd-audience-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0113 0"/></svg></div>
        <h4>Parents &amp; Caregivers</h4>
        <p>Help parents understand mental health, spot early warning signs, and create supportive home environments.</p>
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
          <h4>Can training be delivered in-person and virtually?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Yes. All our training programmes can be delivered in-person at your school, virtually via Zoom or Teams, or in a blended format — whichever works best for your team. We adapt our facilitation methods accordingly to ensure full engagement in both formats.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.1s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>How long does a typical training programme last?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">It depends on scope. A single-topic staff workshop might be a half-day. A comprehensive capacity building programme for multiple stakeholder groups over a term could involve several sessions across weeks. We design the duration and schedule around your school calendar and participant availability.</div>
      </div>
      <div class="sd-faq-item reveal" style="transition-delay:.2s">
        <button class="sd-faq-q" onclick="toggleFaq(this)">
          <h4>Is the training tailored to our school context or generic?</h4>
          <div class="sd-faq-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></div>
        </button>
        <div class="sd-faq-a">Always tailored. We use real scenarios and examples relevant to your school type, age range, and community. Generic training rarely sticks — so we invest time upfront in understanding your context so every session feels directly relevant to your participants' daily reality.</div>
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
        <p>Build the structural foundation so your newly trained counsellor has systems to work within.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('services.wellbeing') }}" class="sd-related-card reveal" style="transition-delay:.1s">
        <div class="sd-related-tag">Comprehensive</div>
        <h4>Wellbeing Package</h4>
        <p>Training embedded within a full-year integrated wellbeing programme for sustained impact.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
      <a href="{{ route('tscc') }}" class="sd-related-card reveal" style="transition-delay:.2s">
        <div class="sd-related-tag">Events</div>
        <h4>TSCC &amp; Events</h4>
        <p>Attend TREC's flagship education events for CPD, networking, and sector-level leadership development.</p>
        <span class="sd-related-arrow">Learn More →</span>
      </a>
    </div>
  </div>
</section>

<section class="sd-cta">
  <div class="sd-cta-inner">
    <div class="eyebrow reveal" style="justify-content:center;color:rgba(255,255,255,.35)">Get Started</div>
    <h2 class="reveal" style="transition-delay:.1s">Ready to Build Your<br>School's Capacity?</h2>
    <p class="reveal" style="transition-delay:.2s">Let's design a training programme that gives your team the knowledge and confidence to champion mental health in your school.</p>
    <div class="sd-cta-actions reveal" style="transition-delay:.3s">
      <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Schedule Training</a>
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
