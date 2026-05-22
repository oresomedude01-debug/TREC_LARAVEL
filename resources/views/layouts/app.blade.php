<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title') – TREC</title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@400;600;700;900&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --red:#D82D37;--orange:#E56918;--green:#779B1C;
  --black:#0D0D0D;--charcoal:#414042;--white:#FFFFFF;
  --cream:#FAF9F6;--light:#F2F1EE;--mid:#E8E7E3;
  --font-h:'Fraunces',Georgia,serif;
  --font-b:'Plus Jakarta Sans',system-ui,sans-serif;
  --ease:cubic-bezier(.4,0,.2,1);
}
html{scroll-behavior:smooth}
body{font-family:var(--font-b);background:var(--white);color:var(--charcoal);overflow-x:hidden;line-height:1.6}
a{text-decoration:none;color:inherit}
button{font-family:var(--font-b);cursor:pointer;border:none;background:none}

/* ── LOGO IMAGE ── */
.logo-img{display:inline-block;height:44px;width:auto;flex-shrink:0;object-fit:contain}

/* ── NAV ── */
nav{position:fixed;top:0;left:0;right:0;z-index:999;background:rgba(255,255,255,0.97);backdrop-filter:blur(16px);border-bottom:1px solid var(--mid)}
.nav-wrap{max-width:1240px;margin:0 auto;padding:0 2rem;height:68px;display:flex;align-items:center;justify-content:space-between;gap:2rem}
.logo-area{display:flex;align-items:center;gap:10px;cursor:pointer}
.logo-wordmark{line-height:1}
.logo-wordmark strong{display:block;font-family:var(--font-h);font-size:18px;font-weight:900;color:var(--black);letter-spacing:-0.5px}
.logo-wordmark span{font-size:9.5px;font-weight:400;color:var(--charcoal);letter-spacing:2.5px;text-transform:uppercase;opacity:.7}
.nav-links{display:flex;align-items:center;gap:4px}
.nav-links a{font-size:13px;font-weight:500;color:var(--charcoal);padding:7px 13px;border-radius:6px;transition:all .2s var(--ease);white-space:nowrap}
.nav-links a:hover{background:var(--light);color:var(--black)}
.nav-links a.act{color:var(--red)}
.nav-btn{background:var(--red);color:#fff;padding:10px 22px;font-size:13px;font-weight:600;border-radius:0;letter-spacing:.3px;transition:background .2s;cursor:pointer}
.nav-btn:hover{background:#b8242e}

/* ── GLOBAL SECTIONS ── */
.sec{padding:5.5rem 2rem}
.wrap{max-width:1200px;margin:0 auto}
.eyebrow{font-size:11px;font-weight:600;letter-spacing:3px;text-transform:uppercase;color:var(--red);margin-bottom:.85rem;display:flex;align-items:center;gap:8px}
.eyebrow::before{content:'';width:24px;height:2px;background:var(--red)}
h2.stitle{font-family:var(--font-h);font-size:clamp(2rem,3.5vw,2.75rem);font-weight:900;color:var(--black);line-height:1.1;margin-bottom:1.25rem}
h2.stitle.wh{color:#fff}
.slead{font-size:1rem;font-weight:300;color:var(--charcoal);max-width:520px;line-height:1.85}
.slead.wh{color:rgba(255,255,255,.65)}

/* ── BUTTONS ── */
.btn-red{background:var(--red);color:#fff;padding:13px 30px;font-size:14px;font-weight:600;letter-spacing:.3px;transition:all .2s;display:inline-block;cursor:pointer;border:none}
.btn-red:hover{background:#b8242e;transform:translateY(-2px)}
.btn-ghost{background:transparent;color:var(--black);padding:13px 30px;font-size:14px;font-weight:500;border:1.5px solid var(--black);display:inline-block;transition:all .2s;cursor:pointer}
.btn-ghost:hover{background:var(--black);color:#fff}
.btn-wh{background:#fff;color:var(--red);padding:13px 30px;font-size:14px;font-weight:700;display:inline-block;transition:all .2s;cursor:pointer;border:none}
.btn-wh:hover{background:var(--cream)}

/* ── FOOTER ── */
footer{background:var(--black);padding:4.5rem 2rem 2rem}
.ft-inner{max-width:1200px;margin:0 auto}
.ft-grid{display:grid;grid-template-columns:2.2fr 1fr 1fr 1fr;gap:3rem;margin-bottom:3.5rem}
.ft-brand p{font-size:13px;color:rgba(255,255,255,.4);font-weight:300;line-height:1.85;margin-top:1.25rem;max-width:260px}
.ft-col h4{font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:rgba(255,255,255,.35);margin-bottom:1.25rem}
.ft-col a{display:block;font-size:13px;color:rgba(255,255,255,.5);cursor:pointer;margin-bottom:9px;font-weight:300;transition:color .2s}
.ft-col a:hover{color:#fff}
.ft-bottom{border-top:1px solid rgba(255,255,255,.07);padding-top:1.5rem;display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap}
.ft-bottom p{font-size:12px;color:rgba(255,255,255,.25);font-weight:300}
.ft-tagline{background:var(--red);color:#fff;padding:.35rem 1rem;font-size:12px;font-weight:600;letter-spacing:.5px;margin-left:auto}

/* ── RESPONSIVE ── */
@media(max-width:900px){
  .nav-links{display:none}
  .ft-grid{grid-template-columns:1fr 1fr}
}
</style>
@yield('styles')
</head>
<body>

<!-- NAV -->
<nav>
<div class="nav-wrap">
  <a href="{{ route('home') }}" class="logo-area" style="cursor:pointer">
    <img src="{{ asset('logo.png') }}" alt="TREC Logo" class="logo-img">
    <div class="logo-wordmark">
      <strong>TREC</strong>
      <span>The Ripple Effect Consult</span>
    </div>
  </a>
  <div class="nav-links">
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('about') }}">About</a>
    <a href="{{ route('services') }}">Services</a>
    <a href="{{ route('wellbeing') }}">Wellbeing</a>
    <a href="{{ route('tscc') }}">TSCC</a>
    <a href="{{ route('gallery') }}">Gallery</a>
    <a href="{{ route('blog') }}">Blog</a>
  </div>
  <a href="{{ route('contact') }}" class="nav-btn">Book a Session</a>
</div>
</nav>

<!-- CONTENT -->
<main style="padding-top: 68px;">
  @if(session('success'))
    <div style="background:#779B1C;color:#fff;padding:1rem 2rem;text-align:center">
      {{ session('success') }}
    </div>
  @endif
  @yield('content')
</main>

<!-- FOOTER -->
<footer>
  <div class="ft-inner">
    <div class="ft-grid">
      <div class="ft-brand">
        <div style="display:flex;align-items:center;gap:10px">
          <img src="{{ asset('logo.png') }}" alt="TREC Logo" class="logo-img">
          <div class="logo-wordmark"><strong style="color:#fff">TREC</strong><span>The Ripple Effect Consult</span></div>
        </div>
        <p>Professional counselling, training & consultation creating lasting ripples across individuals, schools, and organisations.</p>
      </div>
      <div class="ft-col">
        <h4>Services</h4>
        <a href="{{ route('services') }}">Individual Counselling</a>
        <a href="{{ route('services') }}">Group Counselling</a>
        <a href="{{ route('services') }}">Corporate Training</a>
        <a href="{{ route('wellbeing') }}">School Wellbeing</a>
        <a href="{{ route('services') }}">Parenting Workshops</a>
      </div>
      <div class="ft-col">
        <h4>Company</h4>
        <a href="{{ route('about') }}">About TREC</a>
        <a href="{{ route('tscc') }}">TSCC Conference</a>
        <a href="{{ route('tscc') }}">Sponsorship</a>
        <a href="{{ route('gallery') }}">Gallery</a>
        <a href="{{ route('blog') }}">Blog & Resources</a>
      </div>
      <div class="ft-col">
        <h4>Connect</h4>
        <a href="https://www.linkedin.com/company/trec-ripple-effect-consult" target="_blank">LinkedIn</a>
        <a href="https://www.instagram.com/rippleeffectconsult" target="_blank">Instagram</a>
        <a href="https://www.facebook.com/rippleeffectconsult" target="_blank">Facebook</a>
        <a href="https://twitter.com/ripple_effect_c" target="_blank">Twitter / X</a>
      </div>
      <div class="ft-col">
        <h4>Contact</h4>
        <a href="tel:+2349056057502">+234 905 605 7502</a>
        <a href="tel:+2348080639507">+234 808 063 9507</a>
        <a href="mailto:rippleeffectconsult@gmail.com">rippleeffectconsult@gmail.com</a>
        <a href="#">11 Raji Crescent, New London Estate, Baruwa, Ipaja</a>
      </div>
    </div>
    <div class="ft-bottom">
      <p>© 2025 The Ripple Effect Consult. All rights reserved.</p>
      <div class="ft-tagline">People. Purpose. Impact.</div>
    </div>
  </div>
</footer>

@yield('scripts')
</body>
</html>
