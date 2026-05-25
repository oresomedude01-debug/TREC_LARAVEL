@extends('layouts.app')

@section('title', 'Contact')
@section('meta_desc', 'Get in touch with The Ripple Effect Consult — book a counselling session, request a proposal, or enquire about TSCC sponsorship.')

@section('styles')
<style>
/* ── HERO ── */
.con-hero{
  background:var(--cream);padding:7rem 2rem 5.5rem;
  position:relative;overflow:hidden;
}
.con-hero::before{
  content:'';position:absolute;top:-200px;right:-200px;
  width:600px;height:600px;border-radius:50%;
  background:radial-gradient(rgba(216,45,55,.07),transparent 65%);
}
.con-hero::after{
  content:'';position:absolute;bottom:0;left:0;right:0;height:3px;
  background:linear-gradient(90deg,var(--red),var(--orange),var(--green));
}
.con-hero h1{
  font-family:var(--font-h);font-size:clamp(2.8rem,5vw,4.2rem);
  font-weight:900;color:var(--black);line-height:1.0;letter-spacing:-2px;margin-bottom:1rem;
}
.con-hero p{font-size:1.05rem;font-weight:300;max-width:520px;line-height:1.9;color:var(--charcoal)}

/* ── BODY ── */
.con-body{
  max-width:1200px;margin:0 auto;padding:5rem 2rem;
  display:grid;grid-template-columns:1fr 1.7fr;gap:5rem;
  align-items:start;
}

/* ── INFO CARDS ── */
.info-section h3{
  font-family:var(--font-h);font-size:1.2rem;font-weight:700;
  color:var(--black);margin-bottom:1.75rem;
}
.ci-item{
  display:flex;gap:1rem;margin-bottom:1.5rem;
  align-items:flex-start;
}
.ci-icon{
  width:48px;height:48px;border-radius:12px;
  display:flex;align-items:center;justify-content:center;
  font-size:1.1rem;flex-shrink:0;
}
.ci-r{background:rgba(216,45,55,.1)}
.ci-o{background:rgba(229,105,24,.1)}
.ci-g{background:rgba(107,143,26,.1)}
.ci-b{background:rgba(65,64,66,.08)}
.ci-text strong{
  display:block;font-size:11px;font-weight:700;
  letter-spacing:1.5px;text-transform:uppercase;
  color:var(--charcoal);margin-bottom:4px;opacity:.6;
}
.ci-text p,.ci-text a{font-size:13.5px;font-weight:400;color:var(--charcoal);line-height:1.65}
.ci-text a{display:block;transition:color .2s}
.ci-text a:hover{color:var(--red)}

/* Social row */
.con-socials{display:flex;gap:.6rem;margin-top:2rem;padding-top:2rem;border-top:1px solid var(--mid)}
.con-social{
  width:40px;height:40px;border-radius:10px;border:1.5px solid var(--mid);
  display:flex;align-items:center;justify-content:center;
  font-size:.85rem;color:var(--charcoal);
  transition:all .2s;
}
.con-social:hover{background:var(--red);border-color:var(--red);color:#fff}
.con-social svg{width:16px;height:16px;fill:currentColor}

/* ── FORM ── */
.form-sec{
  background:var(--white);border-radius:16px;
  padding:2.5rem;box-shadow:0 8px 48px rgba(0,0,0,.06);
  border:1px solid var(--mid);
}
.form-sec .eyebrow{margin-bottom:1.5rem}

/* Floating label inputs */
.fl-group{position:relative;margin-bottom:1.5rem}
.fl-group label{
  position:absolute;top:14px;left:16px;
  font-size:13px;font-weight:500;color:rgba(65,64,66,.5);
  transition:all .2s var(--ease);pointer-events:none;
  background:var(--white);padding:0 4px;line-height:1;
}
.fl-group input:focus ~ label,
.fl-group input:not(:placeholder-shown) ~ label,
.fl-group select:focus ~ label,
.fl-group textarea:focus ~ label,
.fl-group textarea:not(:placeholder-shown) ~ label{
  top:-7px;left:12px;font-size:10px;font-weight:700;
  letter-spacing:1px;text-transform:uppercase;color:var(--red);
}
.fl-group input,
.fl-group select,
.fl-group textarea{
  width:100%;padding:14px 16px;
  border:1.5px solid var(--mid);border-radius:10px;
  background:var(--white);font-family:var(--font-b);
  font-size:14px;color:var(--black);outline:none;
  transition:border-color .2s,box-shadow .2s;appearance:none;
}
.fl-group input:focus,
.fl-group select:focus,
.fl-group textarea:focus{
  border-color:var(--red);
  box-shadow:0 0 0 3px rgba(216,45,55,.08);
}
.fl-group textarea{min-height:130px;resize:vertical}
.fl-group select{cursor:pointer;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23414042' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 14px center;padding-right:42px}

.form-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem}

/* Submit btn */
.form-submit{
  width:100%;padding:15px;font-size:15px;font-weight:600;letter-spacing:.3px;
  background:var(--red);color:#fff;border:none;border-radius:10px;cursor:pointer;
  transition:all .25s var(--ease);
  display:flex;align-items:center;justify-content:center;gap:.75rem;
  box-shadow:0 4px 14px rgba(216,45,55,.25);
}
.form-submit:hover{background:#b8242e;transform:translateY(-2px);box-shadow:0 8px 24px rgba(216,45,55,.35)}
.form-submit.loading{opacity:.7;pointer-events:none}
.form-submit .submit-arrow{transition:transform .25s}
.form-submit:hover .submit-arrow{transform:translateX(4px)}

/* Error alerts */
.form-errors{
  background:rgba(216,45,55,.08);border:1px solid rgba(216,45,55,.2);
  border-radius:10px;padding:1rem 1.25rem;margin-bottom:1.5rem;
  color:var(--red);font-size:13px;
}
.form-errors ul{margin:0;padding-left:1.25rem}
.form-errors li{margin-bottom:.25rem}

/* ── MAP SECTION ── */
.map-sec{background:var(--light);padding:4rem 2rem}
.map-inner{max-width:1200px;margin:0 auto}
.map-placeholder{
  height:280px;border-radius:14px;
  background:linear-gradient(135deg,var(--mid),var(--light));
  display:flex;align-items:center;justify-content:center;
  flex-direction:column;gap:1rem;
  border:1px solid var(--mid);margin-top:1.5rem;
}
.map-placeholder span{font-size:2.5rem}
.map-placeholder p{font-size:.9rem;font-weight:300;color:var(--charcoal)}

@media(max-width:960px){
  .con-body{grid-template-columns:1fr}
  .form-row{grid-template-columns:1fr}
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
<div class="con-hero">
  <div class="wrap" style="position:relative;z-index:2">
    <div class="eyebrow reveal">Get In Touch</div>
    <h1 class="reveal" style="transition-delay:.1s">Let's Start a<br>Conversation.</h1>
    <p class="reveal" style="transition-delay:.2s">Whether you're an individual, a school, an NGO, or a corporation — we'd love to hear from you and explore how TREC can help create your ripple.</p>
  </div>
</div>

<!-- ── BODY ── -->
<div class="con-body">

  <!-- INFO COLUMN -->
  <div class="info-section reveal-left">
    <h3>How to Reach Us</h3>

    <div class="ci-item">
      <div class="ci-icon ci-r">📍</div>
      <div class="ci-text">
        <strong>Location</strong>
        <p>11 Raji Crescent, New London Estate<br>Baruwa, Ipaja, Lagos, Nigeria</p>
      </div>
    </div>

    <div class="ci-item">
      <div class="ci-icon ci-o">📧</div>
      <div class="ci-text">
        <strong>Email</strong>
        <a href="mailto:rippleeffectconsult@gmail.com">rippleeffectconsult@gmail.com</a>
      </div>
    </div>

    <div class="ci-item">
      <div class="ci-icon ci-g">📞</div>
      <div class="ci-text">
        <strong>Phone</strong>
        <a href="tel:+2349056057502">+234 905 605 7502</a>
        <a href="tel:+2348080639507">+234 808 063 9507</a>
      </div>
    </div>

    <div class="ci-item">
      <div class="ci-icon ci-b">🕐</div>
      <div class="ci-text">
        <strong>Office Hours</strong>
        <p>Monday – Friday<br>9:00 am – 5:00 pm WAT</p>
      </div>
    </div>

    <div class="con-socials">
      <a href="https://www.linkedin.com/company/trec-ripple-effect-consult" target="_blank" class="con-social" aria-label="LinkedIn">
        <svg viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
      </a>
      <a href="https://www.instagram.com/rippleeffectconsult" target="_blank" class="con-social" aria-label="Instagram">
        <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
      </a>
      <a href="https://www.facebook.com/rippleeffectconsult" target="_blank" class="con-social" aria-label="Facebook">
        <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
      </a>
      <a href="https://twitter.com/ripple_effect_c" target="_blank" class="con-social" aria-label="Twitter/X">
        <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.735-8.835L1.254 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>
      </a>
    </div>
  </div>

  <!-- FORM COLUMN -->
  <div class="form-sec reveal-right">
    <div class="eyebrow">Send a Message</div>

    @if ($errors->any())
      <div class="form-errors">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}" id="contactForm">
      @csrf

      <div class="form-row">
        <div class="fl-group">
          <input type="text" id="first_name" name="first_name" placeholder=" " required value="{{ old('first_name') }}">
          <label for="first_name">First Name</label>
        </div>
        <div class="fl-group">
          <input type="text" id="last_name" name="last_name" placeholder=" " required value="{{ old('last_name') }}">
          <label for="last_name">Last Name</label>
        </div>
      </div>

      <div class="fl-group">
        <input type="email" id="email" name="email" placeholder=" " required value="{{ old('email') }}">
        <label for="email">Email Address</label>
      </div>

      <div class="fl-group">
        <input type="text" id="organisation" name="organisation" placeholder=" " value="{{ old('organisation') }}">
        <label for="organisation">Organisation (Optional)</label>
      </div>

      <div class="fl-group">
        <select name="service_interest" id="service_interest" required>
          <option value="" disabled {{ old('service_interest') ? '' : 'selected' }}>Select a service...</option>
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
        <label for="service_interest">Service of Interest</label>
      </div>

      <div class="fl-group">
        <textarea name="message" id="message" placeholder=" " required>{{ old('message') }}</textarea>
        <label for="message">Your Message</label>
      </div>

      <button type="submit" class="form-submit" id="submitBtn">
        <span class="submit-text">Send Message</span>
        <span class="submit-arrow">→</span>
      </button>
    </form>
  </div>
</div>

<!-- ── MAP PLACEHOLDER ── -->
<div class="map-sec">
  <div class="map-inner">
    <div class="eyebrow reveal">Find Us</div>
    <div class="map-placeholder reveal">
      <span>📍</span>
      <p>11 Raji Crescent, New London Estate, Baruwa, Ipaja, Lagos</p>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
// ── Floating label: ensure select shows label if pre-filled
document.querySelectorAll('.fl-group select').forEach(sel => {
  const label = sel.nextElementSibling;
  function updateLabel() {
    if (sel.value && sel.value !== '') {
      label.style.top = '-7px';
      label.style.left = '12px';
      label.style.fontSize = '10px';
      label.style.fontWeight = '700';
      label.style.letterSpacing = '1px';
      label.style.textTransform = 'uppercase';
      label.style.color = 'var(--red)';
    } else {
      label.style = '';
    }
  }
  sel.addEventListener('change', updateLabel);
  updateLabel();
});

// ── Submit button loading state
document.getElementById('contactForm').addEventListener('submit', function() {
  const btn = document.getElementById('submitBtn');
  btn.classList.add('loading');
  btn.querySelector('.submit-text').textContent = 'Sending...';
});
</script>
@endsection
