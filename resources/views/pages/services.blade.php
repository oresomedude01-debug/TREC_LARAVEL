@extends('layouts.app')
@section('title', 'Services - TREC Mental Health Counselling, Training & Consultation')
@section('meta_desc', 'TREC Services: Professional mental health counselling, psychological consultation, training programs, stress management, anxiety support, and wellness coaching for individuals, schools, and organisations.')
@section('meta_keywords', 'counselling services, mental health counselling, psychological consultation, stress management training, anxiety support, workplace wellness, school counselling, professional consultation, mental health support, counseling therapy')
@section('og_title', 'TREC Services - Mental Health Counselling & Professional Consultation')
@section('og_desc', 'Explore TREC comprehensive services: mental health counselling, psychological consultation, training programs, and wellness initiatives designed for individuals, schools, and organisations.')
@section('breadcrumb_title', 'Services')

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
.svc-hero h1{font-family:var(--font-display);font-size:clamp(2.8rem,5vw,4.2rem);font-weight:400;color:#fff;line-height:1.0;letter-spacing:-2px;margin-bottom:1.25rem}
.svc-hero p{font-size:1.05rem;font-weight:300;color:rgba(255,255,255,.55);max-width:500px;line-height:1.9}

/* Floating badge list */
.svc-badge-list{display:flex;flex-direction:column;gap:.75rem}
.svc-badge{
  display:flex;align-items:center;gap:.75rem;
  background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);
  border-radius:10px;padding:.75rem 1rem;
  font-size:13px;font-weight:500;color:rgba(255,255,255,.7);
  transition:all .3s cubic-bezier(0.16, 1, 0.3, 1);
  text-decoration:none;
}
.svc-badge:hover{background:rgba(255,255,255,.09);border-color:rgba(255,255,255,.15);color:#fff;transform:translateX(5px)}
.svc-badge-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0}
.bd-r{background:var(--red)}
.bd-o{background:var(--orange)}
.bd-g{background:var(--green)}
.bd-w{background:rgba(255,255,255,.4)}

/* ── SERVICES LIST ── */
.svc-list-sec{padding:6rem 2rem;background:var(--white)}
.svc-item{
  position:relative;
  display:grid;grid-template-columns:80px 1fr;
  gap:2.5rem;padding:3rem 1rem;
  border-bottom:1px solid var(--mid);
  align-items:start;
  transition:all .30s cubic-bezier(0.16, 1, 0.3, 1);
  border-radius:12px;
}
.svc-item:hover {
  background:rgba(216,45,55,.02);
  padding-left:2rem;
}
.svc-item:last-child{border-bottom:none}
.svc-item-num{
  font-family:var(--font-display);font-size:4rem;font-weight:400;
  color:var(--light);line-height:1;user-select:none;
  transition:color .3s;
}
.svc-item:hover .svc-item-num{color:var(--red);opacity:.7}
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
.svc-item-cta::after{
  content:'';
  position:absolute;
  inset:0;
  z-index:5;
  cursor:pointer;
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
  font-family:var(--font-display);font-size:1.3rem;font-weight:400;
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
      <a href="{{ route('services.dept-setup') }}" class="svc-badge"><span class="svc-badge-dot bd-r"></span>Counselling Department Setup</a>
      <a href="{{ route('services.curriculum') }}" class="svc-badge"><span class="svc-badge-dot bd-o"></span>Curriculum Development</a>
      <a href="{{ route('services.needs-assessment') }}" class="svc-badge"><span class="svc-badge-dot bd-g"></span>Needs Assessment</a>
      <a href="{{ route('services.training') }}" class="svc-badge"><span class="svc-badge-dot bd-w"></span>Training & Capacity Building</a>
      <a href="{{ route('services.wellbeing') }}" class="svc-badge"><span class="svc-badge-dot bd-r"></span>Wellbeing Package</a>
      <a href="{{ route('tscc') }}" class="svc-badge"><span class="svc-badge-dot bd-o"></span>TSCC & Strategic Events</a>
    </div>
  </div>
</div>

<!-- ── SERVICES LIST ── -->
<section class="svc-list-sec">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">Six Core Services</div>
      <h2 class="stitle">Everything We Do</h2>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">01</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Counselling Department Set Up</h3>
          <span class="svc-item-tag tag-r">Schools</span>
        </div>
        <p>TREC helps schools create or restructure a functional counselling department by establishing the necessary structures, documentation systems, referral pathways, assessment processes, reporting systems, and operational procedures needed for effective student support.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Department Structure</span>
          <span class="svc-bullet">Documentation Systems</span>
          <span class="svc-bullet">Referral Pathways</span>
          <span class="svc-bullet">Assessment Processes</span>
          <span class="svc-bullet">Reporting Systems</span>
        </div>
        <a href="{{ route('services.dept-setup') }}" class="svc-item-cta">Read More →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">02</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Counselling Curriculum Development</h3>
          <span class="svc-item-tag tag-o">Education</span>
        </div>
        <p>TREC designs age-appropriate counselling and wellbeing curricula that help students develop emotional intelligence, self-awareness, confidence, communication skills, values, peer relationship skills, and responsible behaviour through structured learning experiences.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Emotional Intelligence</span>
          <span class="svc-bullet">Self-Awareness Development</span>
          <span class="svc-bullet">Communication Skills</span>
          <span class="svc-bullet">Peer Relationships</span>
          <span class="svc-bullet">Values Education</span>
        </div>
        <a href="{{ route('services.curriculum') }}" class="svc-item-cta">Read More →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">03</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Needs Assessment</h3>
          <span class="svc-item-tag tag-g">Strategic</span>
        </div>
        <p>TREC conducts comprehensive assessments to understand the wellbeing, psychosocial, and behavioural needs of students, teachers, parents, and school management by gathering, analysing, and interpreting data to support evidence-based decision making.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Wellbeing Assessment</span>
          <span class="svc-bullet">Psychosocial Analysis</span>
          <span class="svc-bullet">Behavioural Evaluation</span>
          <span class="svc-bullet">Data Interpretation</span>
          <span class="svc-bullet">Evidence-Based Insights</span>
        </div>
        <a href="{{ route('services.needs-assessment') }}" class="svc-item-cta">Read More →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">04</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>Training and Capacity Building</h3>
          <span class="svc-item-tag tag-o">Development</span>
        </div>
        <p>TREC equips teachers, school leaders, counsellors, parents, and students with the knowledge, tools, and practical skills needed to identify, support, and respond effectively to emotional, behavioural, and psychosocial needs within the school community.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Teacher Training</span>
          <span class="svc-bullet">Leadership Development</span>
          <span class="svc-bullet">Parent Workshops</span>
          <span class="svc-bullet">Skill Building</span>
          <span class="svc-bullet">Practical Tools</span>
        </div>
        <a href="{{ route('services.training') }}" class="svc-item-cta">Read More →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">05</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>School Management Wellbeing Package</h3>
          <span class="svc-item-tag tag-r">Comprehensive</span>
        </div>
        <p>A structured wellbeing support package designed for schools seeking consistent, professional, and measurable psychosocial support across students, staff, parents, and management through integrated counselling, training, reporting, advisory, and crisis-response services.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">Integrated Counselling</span>
          <span class="svc-bullet">Professional Training</span>
          <span class="svc-bullet">Measurable Support</span>
          <span class="svc-bullet">Advisory Services</span>
          <span class="svc-bullet">Crisis Response</span>
        </div>
        <a href="{{ route('services.wellbeing') }}" class="svc-item-cta">Read More →</a>
      </div>
    </div>

    <div class="svc-item reveal">
      <div class="svc-item-num">06</div>
      <div class="svc-item-body">
        <div class="svc-item-head">
          <h3>TSCC and Strategic Education Events</h3>
          <span class="svc-item-tag tag-g">Events</span>
        </div>
        <p>TREC's strategic event platform, led by The School Counselling Conference (TSCC), brings together school leaders, counsellors, psychologists, teachers, parents, sponsors, policymakers, and education stakeholders to reposition counselling as a strategic driver of whole-school transformation.</p>
        <div class="svc-item-bullets">
          <span class="svc-bullet">School Counselling Conference</span>
          <span class="svc-bullet">Stakeholder Engagement</span>
          <span class="svc-bullet">Professional Development</span>
          <span class="svc-bullet">Sector Leadership</span>
          <span class="svc-bullet">Strategic Positioning</span>
        </div>
        <a href="{{ route('tscc') }}" class="svc-item-cta">Read More →</a>
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
    <h2 style="font-family:var(--font-display);color:#fff;font-size:clamp(2rem,4vw,3rem);font-weight:400;letter-spacing:-.5px;margin-bottom:1rem">Ready to Get Started?</h2>
    <p style="color:rgba(255,255,255,.55);font-size:1rem;font-weight:300;max-width:440px;margin:0 auto 2.5rem;line-height:1.85">One conversation can be the beginning of lasting change. Book a free consultation with our team today.</p>
    <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Book a Free Consultation</a>
  </div>
</section>

@endsection
