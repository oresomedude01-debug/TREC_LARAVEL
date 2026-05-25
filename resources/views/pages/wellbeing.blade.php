@extends('layouts.app')
@section('title', 'School Wellbeing')
@section('meta_desc', 'TREC\'s comprehensive School Wellbeing Package — holistic support for students, staff, and school leadership to create thriving educational environments.')

@section('styles')
<style>
/* ── HERO ── */
.wb-hero{
  background:var(--cream);padding:7rem 2rem 6rem;
  position:relative;overflow:hidden;
}
.wb-hero-bar{position:absolute;bottom:0;left:0;right:0;height:5px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))}
.wb-hero-blob{
  position:absolute;right:-150px;top:-100px;
  width:700px;height:700px;border-radius:50%;
  background:radial-gradient(circle at 40% 40%,rgba(107,143,26,.1),rgba(229,105,24,.06) 50%,transparent 80%);
  pointer-events:none;
}
.wb-hero-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1.1fr 1fr;gap:5rem;align-items:center;position:relative;z-index:2}
.wb-hero h1{font-family:var(--font-h);font-size:clamp(2.8rem,5vw,4.2rem);font-weight:900;color:var(--black);line-height:1.0;letter-spacing:-2px;margin-bottom:1.25rem}
.wb-hero h1 span{color:var(--green)}
.wb-hero p{font-size:1.05rem;font-weight:300;color:var(--charcoal);max-width:500px;line-height:1.9;margin-bottom:2rem}

/* Audience tags */
.audience-wrap{display:flex;flex-direction:column;gap:.5rem}
.audience-label{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--charcoal);opacity:.5;margin-bottom:.25rem}
.audience-tags{display:flex;flex-wrap:wrap;gap:.5rem}
.a-tag{
  font-size:12px;font-weight:600;padding:6px 14px;border-radius:100px;
  background:#fff;border:1px solid var(--mid);color:var(--charcoal);
  transition:all .2s;
}
.a-tag:hover{background:var(--green);border-color:var(--green);color:#fff}

/* Right panel */
.wb-panel{
  background:var(--black);border-radius:16px;padding:2.5rem;
  position:relative;overflow:hidden;
}
.wb-panel::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--green),var(--orange))}
.wb-panel h3{font-family:var(--font-h);font-size:1.1rem;font-weight:700;color:#fff;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid rgba(255,255,255,.08)}
.wb-panel-item{display:flex;align-items:flex-start;gap:.75rem;margin-bottom:1rem}
.wb-panel-item:last-child{margin-bottom:0}
.wp-check{
  width:22px;height:22px;border-radius:50%;background:rgba(107,143,26,.2);
  display:flex;align-items:center;justify-content:center;
  font-size:.7rem;color:var(--green);flex-shrink:0;margin-top:1px;font-weight:700;
}
.wb-panel-item p{font-size:.88rem;font-weight:300;color:rgba(255,255,255,.6);line-height:1.5}

/* ── PACKAGE STEPS ── */
.package-sec{background:var(--white);padding:5.5rem 2rem}
.steps-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem}
.step-card{
  border-radius:14px;padding:2rem;
  position:relative;overflow:hidden;
  border:1px solid var(--mid);
  transition:transform .3s var(--ease),box-shadow .3s,border-color .3s;
}
.step-card:hover{transform:translateY(-6px);box-shadow:0 20px 50px rgba(0,0,0,.08)}
.step-card:nth-child(1):hover{border-color:rgba(216,45,55,.3)}
.step-card:nth-child(2):hover{border-color:rgba(229,105,24,.3)}
.step-card:nth-child(3):hover{border-color:rgba(107,143,26,.3)}
.step-card:nth-child(4):hover{border-color:rgba(216,45,55,.3)}
.step-card:nth-child(5):hover{border-color:rgba(229,105,24,.3)}
.step-card:nth-child(6):hover{border-color:rgba(107,143,26,.3)}
.step-num-wrap{display:flex;align-items:center;gap:.75rem;margin-bottom:1.25rem}
.step-num{
  width:40px;height:40px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-h);font-size:1rem;font-weight:900;color:#fff;
  flex-shrink:0;
}
.sn1{background:var(--red)}
.sn2{background:var(--orange)}
.sn3{background:var(--green)}
.sn4{background:var(--red)}
.sn5{background:var(--orange)}
.sn6{background:var(--green)}
.step-connector{flex:1;height:1px;background:var(--mid)}
.step-card h4{font-family:var(--font-h);font-size:1.1rem;font-weight:700;color:var(--black);margin-bottom:.6rem}
.step-card p{font-size:.87rem;font-weight:300;color:var(--charcoal);line-height:1.8}

/* ── WHO IT'S FOR ── */
.who-sec{background:var(--cream);padding:5.5rem 2rem}
.who-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1.5rem;margin-top:3rem}
.who-card{
  background:#fff;border-radius:12px;padding:2rem;text-align:center;
  border-top:3px solid transparent;
  transition:transform .3s var(--ease),box-shadow .3s;
}
.who-card:hover{transform:translateY(-5px);box-shadow:0 16px 40px rgba(0,0,0,.07)}
.wc-1{border-top-color:var(--red)}
.wc-2{border-top-color:var(--orange)}
.wc-3{border-top-color:var(--green)}
.wc-4{border-top-color:var(--charcoal)}
.who-icon{font-size:2.2rem;margin-bottom:1rem}
.who-card h4{font-family:var(--font-h);font-size:1rem;font-weight:700;color:var(--black);margin-bottom:.5rem}
.who-card p{font-size:.85rem;font-weight:300;color:var(--charcoal);line-height:1.7}

/* ── CTA PROPOSAL ── */
.wb-cta{
  background:var(--black);padding:5.5rem 2rem;
  position:relative;overflow:hidden;
}
.wb-cta::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse 60% 80% at 50% 100%,rgba(107,143,26,.15),transparent 65%);
}

@media(max-width:960px){
  .wb-hero-inner{grid-template-columns:1fr}
  .wb-panel{display:none}
  .steps-grid{grid-template-columns:1fr 1fr}
  .who-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:600px){
  .steps-grid{grid-template-columns:1fr}
  .who-grid{grid-template-columns:1fr 1fr}
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
<div class="wb-hero">
  <div class="wb-hero-blob"></div>
  <div class="wb-hero-bar"></div>
  <div class="wb-hero-inner">
    <div>
      <div class="eyebrow reveal">School Wellbeing Package</div>
      <h1 class="reveal" style="transition-delay:.1s">Healthy Schools.<br><span>Thriving</span><br>Communities.</h1>
      <p class="reveal" style="transition-delay:.2s">A comprehensive, structured package designed for forward-thinking schools committed to making student and staff mental health a genuine institutional priority — not an afterthought.</p>
      <div class="audience-wrap reveal" style="transition-delay:.25s">
        <div class="audience-label">Designed for</div>
        <div class="audience-tags">
          <span class="a-tag">Primary Schools</span>
          <span class="a-tag">Secondary Schools</span>
          <span class="a-tag">Universities</span>
          <span class="a-tag">International Schools</span>
          <span class="a-tag">NGOs in Education</span>
        </div>
      </div>
      <div style="margin-top:2rem" class="reveal" style="transition-delay:.3s">
        <a href="{{ route('contact') }}" class="btn-red">Request a School Proposal</a>
      </div>
    </div>
    <div class="wb-panel reveal-right" style="transition-delay:.2s">
      <h3>✅ What's Included</h3>
      <div class="wb-panel-item"><div class="wp-check">✓</div><p>Full wellbeing audit and needs assessment of your school's current climate</p></div>
      <div class="wb-panel-item"><div class="wp-check">✓</div><p>Customised wellbeing policy co-developed with school leadership</p></div>
      <div class="wb-panel-item"><div class="wp-check">✓</div><p>Ongoing student counselling sessions with qualified counsellors</p></div>
      <div class="wb-panel-item"><div class="wp-check">✓</div><p>Teacher and support staff training programme</p></div>
      <div class="wb-panel-item"><div class="wp-check">✓</div><p>Parent engagement sessions and communication strategy</p></div>
      <div class="wb-panel-item"><div class="wp-check">✓</div><p>Quarterly reviews, impact reports, and programme adjustment</p></div>
    </div>
  </div>
</div>

<!-- ── PACKAGE STEPS ── -->
<section class="package-sec">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">The Six Components</div>
      <h2 class="stitle">The Complete Package</h2>
      <p class="slead">End-to-end support — from assessment and policy through implementation to ongoing review and reporting.</p>
    </div>
    <div class="steps-grid reveal-stagger">
      <div class="step-card">
        <div class="step-num-wrap"><div class="step-num sn1">01</div><div class="step-connector"></div></div>
        <h4>Wellbeing Audit & Needs Assessment</h4>
        <p>We begin with a comprehensive assessment of your school's current mental health landscape — surveying students, staff, and leadership to identify needs, gaps, and strengths.</p>
      </div>
      <div class="step-card">
        <div class="step-num-wrap"><div class="step-num sn2">02</div><div class="step-connector"></div></div>
        <h4>Customised Wellbeing Policy</h4>
        <p>Drawing on audit findings, we co-create a bespoke wellbeing policy with your leadership team — grounded in best practice and tailored to your school's unique culture and context.</p>
      </div>
      <div class="step-card">
        <div class="step-num-wrap"><div class="step-num sn3">03</div><div class="step-connector"></div></div>
        <h4>Student Counselling Sessions</h4>
        <p>Qualified counsellors provide regular individual and group sessions for students — creating a consistent, trusted support system within your school community.</p>
      </div>
      <div class="step-card">
        <div class="step-num-wrap"><div class="step-num sn4">04</div><div class="step-connector"></div></div>
        <h4>Teacher & Staff Training</h4>
        <p>Equip your entire staff with mental health literacy, safe conversation skills, and early intervention strategies — transforming every adult in your school into a wellbeing ally.</p>
      </div>
      <div class="step-card">
        <div class="step-num-wrap"><div class="step-num sn5">05</div><div class="step-connector"></div></div>
        <h4>Parent Engagement Programme</h4>
        <p>Workshops and communication strategies that bring parents into the wellbeing conversation — strengthening the home-school partnership that is essential for lasting student wellbeing.</p>
      </div>
      <div class="step-card">
        <div class="step-num-wrap"><div class="step-num sn6">06</div><div class="step-connector"></div></div>
        <h4>Quarterly Reviews & Reporting</h4>
        <p>Regular check-ins and detailed impact reports help you track progress, demonstrate value to stakeholders, and continuously improve your school's wellbeing programme over time.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── WHO IT'S FOR ── -->
<section class="who-sec">
  <div class="wrap">
    <div class="reveal" style="text-align:center">
      <div class="eyebrow" style="justify-content:center">Who Benefits</div>
      <h2 class="stitle" style="text-align:center">Built for Every Member of Your School</h2>
      <p class="slead" style="margin:0 auto;text-align:center">Wellbeing is everyone's business — our package creates impact at every level of your institution.</p>
    </div>
    <div class="who-grid reveal-stagger">
      <div class="who-card wc-1">
        <div class="who-icon">🎓</div>
        <h4>Students</h4>
        <p>Regular counselling access, emotional literacy, and a safe space to navigate academic and personal challenges.</p>
      </div>
      <div class="who-card wc-2">
        <div class="who-icon">👩‍🏫</div>
        <h4>Teachers</h4>
        <p>Mental health training, burnout prevention, and tools to support students experiencing emotional difficulties.</p>
      </div>
      <div class="who-card wc-3">
        <div class="who-icon">🏫</div>
        <h4>Leadership</h4>
        <p>Policy frameworks, strategic guidance, and evidence to demonstrate your school's commitment to wellbeing.</p>
      </div>
      <div class="who-card wc-4">
        <div class="who-icon">👨‍👩‍👧</div>
        <h4>Parents</h4>
        <p>Workshops, resources, and communication strategies that bring families into the wellbeing partnership.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── CTA ── -->
<section class="wb-cta">
  <div class="wrap" style="position:relative;z-index:1">
    <div style="max-width:700px" class="reveal">
      <div class="eyebrow" style="color:rgba(255,255,255,.3)">Get Started</div>
      <h2 style="font-family:var(--font-h);font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#fff;letter-spacing:-1px;margin-bottom:1rem;line-height:1.1">
        Is Your School Ready to Prioritise Wellbeing?
      </h2>
      <p style="color:rgba(255,255,255,.5);font-size:1rem;font-weight:300;max-width:520px;line-height:1.85;margin-bottom:2.5rem">
        Let's talk about what a tailored School Wellbeing Package could look like for your institution. Request a free discovery call and receive a bespoke proposal within 5 working days.
      </p>
      <div style="display:flex;gap:1rem;flex-wrap:wrap">
        <a href="{{ route('contact') }}" class="btn-red" style="padding:15px 36px">Request a Free Proposal</a>
        <a href="{{ route('services') }}" class="btn-ghost" style="border-color:rgba(255,255,255,.2);color:#fff;padding:15px 36px">View All Services</a>
      </div>
    </div>
  </div>
</section>

@endsection
