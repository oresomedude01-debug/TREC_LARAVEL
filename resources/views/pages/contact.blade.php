@extends('layouts.app')

@section('title', 'Contact - TREC')

@section('styles')
<style>
.con-hero{background:var(--cream);padding:6rem 2rem 5rem;position:relative;overflow:hidden}
.con-hero::before{content:'';position:absolute;top:-200px;right:-200px;width:500px;height:500px;border-radius:50%;background:radial-gradient(rgba(215,45,55,.08),transparent 70%)}
.con-hero h1{font-family:var(--font-h);font-size:clamp(2.5rem,5vw,3.8rem);font-weight:900;color:var(--black);line-height:1.05;margin-bottom:1rem}
.con-hero p{font-size:1.05rem;font-weight:300;max-width:520px;line-height:1.85;color:var(--charcoal)}
.con-body{max-width:1200px;margin:0 auto;padding:5rem 2rem;display:grid;grid-template-columns:1fr 1.6fr;gap:5rem}
.ci-item{display:flex;gap:1rem;margin-bottom:2rem}
.ci-icon{width:46px;height:46px;background:var(--cream);display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0;border-left:3px solid var(--red)}
.ci-text strong{display:block;font-size:12px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--black);margin-bottom:3px}
.ci-text p{font-size:13px;font-weight:300;color:var(--charcoal);line-height:1.65}
.form-sec label{display:block;font-size:11px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:var(--charcoal);margin-bottom:7px}
.form-sec input,.form-sec select,.form-sec textarea{width:100%;padding:12px 16px;border:1.5px solid var(--mid);background:var(--white);font-family:var(--font-b);font-size:14px;color:var(--black);outline:none;transition:border-color .2s;border-radius:0;margin-bottom:1.25rem}
.form-sec input:focus,.form-sec select:focus,.form-sec textarea:focus{border-color:var(--red)}
.form-sec textarea{height:130px;resize:vertical}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}
@media(max-width:900px){.con-body{grid-template-columns:1fr}.form-row{grid-template-columns:1fr}}
</style>
@endsection

@section('content')

<!-- HERO -->
<div class="con-hero">
  <div class="wrap">
    <div class="eyebrow">Get In Touch</div>
    <h1>Let's Start a<br>Conversation.</h1>
    <p>Whether you're an individual, a school, an NGO, or a corporation — we'd love to hear from you and explore how TREC can help.</p>
  </div>
</div>

<!-- FORM -->
<div class="con-body">
  <div>
    <h3 style="font-family:var(--font-h);font-size:1.35rem;font-weight:700;color:var(--black);margin-bottom:2rem">How to Reach Us</h3>
    <div class="ci-item"><div class="ci-icon">📍</div><div class="ci-text"><strong>Location</strong><p>11 Raji Crescent, New London Estate, Baruwa, Ipaja, Lagos</p></div></div>
    <div class="ci-item"><div class="ci-icon">📧</div><div class="ci-text"><strong>Email</strong><p><a href="mailto:rippleeffectconsult@gmail.com" style="color:var(--red);text-decoration:underline">rippleeffectconsult@gmail.com</a></p></div></div>
    <div class="ci-item"><div class="ci-icon">📞</div><div class="ci-text"><strong>Phone</strong><p><a href="tel:+2349056057502" style="color:var(--red);text-decoration:underline">+234 905 605 7502</a><br><a href="tel:+2348080639507" style="color:var(--red);text-decoration:underline">+234 808 063 9507</a></p></div></div>
    <div class="ci-item"><div class="ci-icon">🕐</div><div class="ci-text"><strong>Office Hours</strong><p>Mon – Fri, 9am – 5pm WAT</p></div></div>
  </div>
  
  <form method="POST" action="{{ route('contact.store') }}" class="form-sec">
    @csrf
    <div class="eyebrow" style="margin-bottom:1.5rem">Send a Message</div>
    
    @if ($errors->any())
      <div style="background:#D82D37;color:#fff;padding:1rem;margin-bottom:1rem;border-radius:4px">
        <ul style="margin:0;padding-left:1.5rem">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    
    <div class="form-row">
      <div>
        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" placeholder="Your first name" required value="{{ old('first_name') }}">
      </div>
      <div>
        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" placeholder="Your last name" required value="{{ old('last_name') }}">
      </div>
    </div>
    
    <label for="email">Email Address</label>
    <input type="email" id="email" name="email" placeholder="your@email.com" required value="{{ old('email') }}">
    
    <label for="organisation">Organisation (Optional)</label>
    <input type="text" id="organisation" name="organisation" placeholder="School, NGO, company name..." value="{{ old('organisation') }}">
    
    <label for="service_interest">Service of Interest</label>
    <select name="service_interest" id="service_interest" required>
      <option value="">Select a service...</option>
      <option value="Individual Counselling" {{ old('service_interest') == 'Individual Counselling' ? 'selected' : '' }}>Individual Counselling</option>
      <option value="Group Counselling" {{ old('service_interest') == 'Group Counselling' ? 'selected' : '' }}>Group Counselling</option>
      <option value="Corporate Training" {{ old('service_interest') == 'Corporate Training' ? 'selected' : '' }}>Corporate Training</option>
      <option value="School Wellbeing Package" {{ old('service_interest') == 'School Wellbeing Package' ? 'selected' : '' }}>School Wellbeing Package</option>
      <option value="Parenting Workshops" {{ old('service_interest') == 'Parenting Workshops' ? 'selected' : '' }}>Parenting Workshops</option>
      <option value="Consultation & Advisory" {{ old('service_interest') == 'Consultation & Advisory' ? 'selected' : '' }}>Consultation & Advisory</option>
      <option value="TSCC Sponsorship" {{ old('service_interest') == 'TSCC Sponsorship' ? 'selected' : '' }}>TSCC Sponsorship</option>
      <option value="TSCC Registration" {{ old('service_interest') == 'TSCC Registration' ? 'selected' : '' }}>TSCC Registration</option>
      <option value="General Enquiry" {{ old('service_interest') == 'General Enquiry' ? 'selected' : '' }}>General Enquiry</option>
    </select>
    
    <label for="message">Your Message</label>
    <textarea name="message" id="message" placeholder="Tell us a little about what you're looking for and how we can help..." required>{{ old('message') }}</textarea>
    
    <button type="submit" class="btn-red" style="width:100%;padding:15px;font-size:15px">Send Message</button>
  </form>
</div>

@endsection
