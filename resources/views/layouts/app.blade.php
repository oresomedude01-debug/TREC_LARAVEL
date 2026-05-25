<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title') – TREC</title>
<meta name="description" content="@yield('meta_desc', 'The Ripple Effect Consult — Professional counselling, training & consultation creating lasting change across individuals, schools, and organisations.')">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,wght@0,400;0,600;0,700;0,900;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<style>
/* ── RESET & ROOT ── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --red:#D82D37;--orange:#E56918;--green:#6B8F1A;
  --black:#0D0D0D;--charcoal:#414042;--white:#FFFFFF;
  --cream:#FAF9F6;--light:#F2F1EE;--mid:#E8E7E3;
  --font-h:'Fraunces',Georgia,serif;
  --font-b:'Plus Jakarta Sans',system-ui,sans-serif;
  --ease:cubic-bezier(.4,0,.2,1);
  --ease-spring:cubic-bezier(.34,1.56,.64,1);
  --nav-h:70px;
  --shadow-sm:0 2px 12px rgba(0,0,0,.06);
  --shadow-md:0 8px 32px rgba(0,0,0,.10);
}
html{scroll-behavior:smooth}
body{font-family:var(--font-b);background:var(--white);color:var(--charcoal);overflow-x:hidden;line-height:1.6;opacity:0;transition:opacity .45s var(--ease)}
body.loaded{opacity:1}
a{text-decoration:none;color:inherit}
button{font-family:var(--font-b);cursor:pointer;border:none;background:none}
img{max-width:100%;display:block}

/* ── SCROLL PROGRESS BAR ── */
#scroll-progress{
  position:fixed;top:0;left:0;right:0;height:3px;z-index:9999;
  background:linear-gradient(90deg,var(--red),var(--orange),var(--green));
  transform-origin:left;transform:scaleX(0);
  transition:transform .05s linear;
}

/* ── NAV ── */
nav{
  position:fixed;top:0;left:0;right:0;z-index:1000;
  height:var(--nav-h);
  background:rgba(250,249,246,0);
  backdrop-filter:blur(0px);
  border-bottom:1px solid transparent;
  transition:background .35s var(--ease),backdrop-filter .35s var(--ease),border-color .35s var(--ease),box-shadow .35s var(--ease);
}
nav.scrolled{
  background:rgba(250,249,246,.97);
  backdrop-filter:blur(20px);
  border-bottom:1px solid var(--mid);
  box-shadow:0 2px 20px rgba(0,0,0,.07);
}
.nav-wrap{max-width:1280px;margin:0 auto;padding:0 2rem;height:100%;display:flex;align-items:center;justify-content:space-between;gap:1.5rem}

/* Logo */
.logo-area{display:flex;align-items:center;gap:10px;cursor:pointer;transition:opacity .2s}
.logo-area:hover{opacity:.85}
.logo-img{height:42px;width:auto;flex-shrink:0;object-fit:contain}
.logo-wordmark{line-height:1}
.logo-wordmark strong{display:block;font-family:var(--font-h);font-size:18px;font-weight:900;color:var(--black);letter-spacing:-.5px}
.logo-wordmark span{font-size:9px;font-weight:400;color:var(--charcoal);letter-spacing:2.5px;text-transform:uppercase;opacity:.65}

/* Desktop links */
.nav-links{display:flex;align-items:center;gap:2px}
.nav-links a{
  font-size:13px;font-weight:500;color:var(--charcoal);
  padding:8px 13px;border-radius:8px;
  transition:all .2s var(--ease);white-space:nowrap;position:relative;
}
.nav-links a::after{
  content:'';position:absolute;bottom:4px;left:13px;right:13px;
  height:2px;background:var(--red);border-radius:2px;
  transform:scaleX(0);transition:transform .25s var(--ease);
}
.nav-links a:hover{background:var(--light);color:var(--black)}
.nav-links a.act{color:var(--red)}
.nav-links a.act::after{transform:scaleX(1)}

/* CTA button */
.nav-btn{
  background:var(--red);color:#fff;
  padding:10px 22px;font-size:13px;font-weight:600;
  border-radius:8px;letter-spacing:.3px;
  transition:all .25s var(--ease);flex-shrink:0;
  box-shadow:0 4px 14px rgba(216,45,55,.25);
}
.nav-btn:hover{background:#b8242e;transform:translateY(-2px);box-shadow:0 8px 24px rgba(216,45,55,.35)}

/* Mobile hamburger */
.hamburger{display:none;flex-direction:column;justify-content:center;align-items:center;width:44px;height:44px;gap:5px;cursor:pointer;flex-shrink:0;border-radius:8px;transition:background .2s}
.hamburger:hover{background:var(--light)}
.hamburger span{display:block;width:22px;height:2px;background:var(--black);border-radius:2px;transition:all .35s var(--ease);transform-origin:center}
.hamburger.open span:nth-child(1){transform:translateY(7px) rotate(45deg)}
.hamburger.open span:nth-child(2){opacity:0;transform:scaleX(0)}
.hamburger.open span:nth-child(3){transform:translateY(-7px) rotate(-45deg)}

/* Mobile menu overlay */
.mob-menu{
  position:fixed;inset:0;z-index:999;
  background:rgba(250,249,246,.97);backdrop-filter:blur(20px);
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0;
  opacity:0;pointer-events:none;transition:opacity .35s var(--ease);
  padding-top:var(--nav-h);
}
.mob-menu.open{opacity:1;pointer-events:all}
.mob-menu a{
  font-family:var(--font-h);font-size:2.2rem;font-weight:700;
  color:var(--black);padding:.6rem 2rem;letter-spacing:-.5px;
  transition:color .2s;text-align:center;
  transform:translateY(20px);opacity:0;
  transition:color .2s,transform .4s var(--ease),opacity .4s var(--ease);
}
.mob-menu.open a{transform:translateY(0);opacity:1}
.mob-menu.open a:nth-child(1){transition-delay:.05s}
.mob-menu.open a:nth-child(2){transition-delay:.10s}
.mob-menu.open a:nth-child(3){transition-delay:.15s}
.mob-menu.open a:nth-child(4){transition-delay:.20s}
.mob-menu.open a:nth-child(5){transition-delay:.25s}
.mob-menu.open a:nth-child(6){transition-delay:.30s}
.mob-menu.open a:nth-child(7){transition-delay:.35s}
.mob-menu a:hover{color:var(--red)}
.mob-cta{margin-top:2rem;background:var(--red);color:#fff;padding:14px 40px;font-size:15px;font-weight:600;font-family:var(--font-b) !important;border-radius:8px;transform:translateY(20px);opacity:0;transition-delay:.4s !important}
.mob-menu.open .mob-cta{transform:translateY(0);opacity:1}

/* ── GLOBAL SECTIONS ── */
.sec{padding:5.5rem 2rem}
.wrap{max-width:1200px;margin:0 auto}
.eyebrow{
  font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;
  color:var(--red);margin-bottom:.9rem;
  display:flex;align-items:center;gap:10px;
}
.eyebrow::before{content:'';width:20px;height:2px;background:currentColor;flex-shrink:0}
h2.stitle{font-family:var(--font-h);font-size:clamp(2rem,3.5vw,2.75rem);font-weight:900;color:var(--black);line-height:1.1;margin-bottom:1.25rem}
h2.stitle.wh{color:#fff}
.slead{font-size:1rem;font-weight:300;color:var(--charcoal);max-width:520px;line-height:1.85}
.slead.wh{color:rgba(255,255,255,.65)}

/* ── BUTTONS ── */
.btn-red{
  background:var(--red);color:#fff;
  padding:13px 30px;font-size:14px;font-weight:600;letter-spacing:.3px;
  transition:all .25s var(--ease);display:inline-block;cursor:pointer;border:none;
  border-radius:8px;box-shadow:0 4px 14px rgba(216,45,55,.22);
}
.btn-red:hover{background:#b8242e;transform:translateY(-2px);box-shadow:0 8px 24px rgba(216,45,55,.35)}
.btn-ghost{
  background:transparent;color:var(--black);
  padding:13px 30px;font-size:14px;font-weight:500;
  border:1.5px solid rgba(13,13,13,.25);display:inline-block;
  transition:all .25s var(--ease);cursor:pointer;border-radius:8px;
}
.btn-ghost:hover{background:var(--black);color:#fff;border-color:var(--black)}
.btn-wh{
  background:#fff;color:var(--red);
  padding:13px 30px;font-size:14px;font-weight:700;
  display:inline-block;transition:all .25s var(--ease);
  cursor:pointer;border:none;border-radius:8px;
}
.btn-wh:hover{background:var(--cream);transform:translateY(-2px)}
.btn-orange{
  background:var(--orange);color:#fff;
  padding:13px 30px;font-size:14px;font-weight:600;letter-spacing:.3px;
  transition:all .25s var(--ease);display:inline-block;cursor:pointer;border:none;
  border-radius:8px;box-shadow:0 4px 14px rgba(229,105,24,.22);
}
.btn-orange:hover{background:#c95c15;transform:translateY(-2px)}

/* ── SCROLL REVEAL ── */
.reveal{opacity:0;transform:translateY(32px);transition:opacity .65s var(--ease),transform .65s var(--ease)}
.reveal.visible{opacity:1;transform:translateY(0)}
.reveal-left{opacity:0;transform:translateX(-32px);transition:opacity .65s var(--ease),transform .65s var(--ease)}
.reveal-left.visible{opacity:1;transform:translateX(0)}
.reveal-right{opacity:0;transform:translateX(32px);transition:opacity .65s var(--ease),transform .65s var(--ease)}
.reveal-right.visible{opacity:1;transform:translateX(0)}
.reveal-scale{opacity:0;transform:scale(.94);transition:opacity .65s var(--ease),transform .65s var(--ease)}
.reveal-scale.visible{opacity:1;transform:scale(1)}
/* Stagger children */
.reveal-stagger>*{opacity:0;transform:translateY(24px);transition:opacity .55s var(--ease),transform .55s var(--ease)}
.reveal-stagger.visible>*:nth-child(1){opacity:1;transform:translateY(0);transition-delay:.05s}
.reveal-stagger.visible>*:nth-child(2){opacity:1;transform:translateY(0);transition-delay:.15s}
.reveal-stagger.visible>*:nth-child(3){opacity:1;transform:translateY(0);transition-delay:.25s}
.reveal-stagger.visible>*:nth-child(4){opacity:1;transform:translateY(0);transition-delay:.35s}
.reveal-stagger.visible>*:nth-child(5){opacity:1;transform:translateY(0);transition-delay:.45s}
.reveal-stagger.visible>*:nth-child(6){opacity:1;transform:translateY(0);transition-delay:.55s}
.reveal-stagger.visible>*:nth-child(7){opacity:1;transform:translateY(0);transition-delay:.65s}
.reveal-stagger.visible>*:nth-child(n+8){opacity:1;transform:translateY(0);transition-delay:.70s}

/* ── FOOTER ── */
footer{background:var(--black);padding:5rem 2rem 0}
.ft-inner{max-width:1200px;margin:0 auto}
.ft-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:3.5rem;padding-bottom:3.5rem;border-bottom:1px solid rgba(255,255,255,.07)}
.ft-brand p{font-size:13px;color:rgba(255,255,255,.4);font-weight:300;line-height:1.9;margin-top:1.25rem;max-width:270px}
.ft-socials{display:flex;gap:.75rem;margin-top:1.5rem}
.ft-social-link{
  width:36px;height:36px;border-radius:8px;border:1px solid rgba(255,255,255,.12);
  display:flex;align-items:center;justify-content:center;
  transition:all .2s;color:rgba(255,255,255,.45);
}
.ft-social-link:hover{background:var(--red);border-color:var(--red);color:#fff}
.ft-social-link svg{width:15px;height:15px;fill:currentColor}
.ft-col h4{font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:1.25rem}
.ft-col a{display:block;font-size:13px;color:rgba(255,255,255,.45);cursor:pointer;margin-bottom:9px;font-weight:300;transition:color .2s}
.ft-col a:hover{color:#fff}
.ft-bottom{display:flex;justify-content:space-between;align-items:center;gap:1rem;flex-wrap:wrap;padding:1.5rem 0 2rem}
.ft-bottom p{font-size:12px;color:rgba(255,255,255,.22);font-weight:300}
.ft-tagline{
  font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;
  background:linear-gradient(90deg,var(--red),var(--orange));
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}

/* ── SUCCESS TOAST ── */
.toast{
  position:fixed;bottom:2rem;right:2rem;z-index:9998;
  background:var(--green);color:#fff;padding:1rem 1.5rem;
  border-radius:10px;font-size:14px;font-weight:500;
  box-shadow:0 8px 32px rgba(0,0,0,.18);
  transform:translateY(20px);opacity:0;
  animation:toastIn .4s var(--ease-spring) forwards, toastOut .4s var(--ease) 4s forwards;
}
@keyframes toastIn{to{transform:translateY(0);opacity:1}}
@keyframes toastOut{to{transform:translateY(20px);opacity:0}}

/* ── RESPONSIVE ── */
@media(max-width:960px){
  .nav-links,.nav-btn{display:none}
  .hamburger{display:flex}
  .ft-grid{grid-template-columns:1fr 1fr}
}
@media(max-width:600px){
  .ft-grid{grid-template-columns:1fr}
  .sec{padding:4rem 1.25rem}
}

/* ── LUCIDE ICON SYSTEM ── */
/* After lucide.createIcons() runs, <i data-lucide> becomes <svg class="lucide lucide-*"> */
.lucide{stroke:currentColor;fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:1.75;display:block;flex-shrink:0}
/* Context-based sizing */
.svc-icon .lucide{width:26px;height:26px}
.val-icon .lucide{width:15px;height:15px;stroke-width:2.25}
.ci-icon .lucide{width:22px;height:22px;stroke-width:1.75}
.feat-icon .lucide{width:30px;height:30px;stroke-width:1.5}
.who-icon .lucide{width:36px;height:36px;stroke-width:1.5}
.wp-check .lucide{width:18px;height:18px;stroke-width:2.25}
.sv-icon .lucide{width:24px;height:24px}
.blog-featured-tag .lucide{width:13px;height:13px;stroke-width:2.5;vertical-align:middle}
.con-social .lucide{width:15px;height:15px;stroke-width:2}
.ft-social-link .lucide{width:15px;height:15px;stroke-width:2}
/* 3-D tilt on icon boxes (service cards, about blocks) */
.svc-icon{transition:transform .45s var(--ease-spring),box-shadow .35s}
.svc-card:hover .svc-icon{
  transform:perspective(180px) rotateX(-9deg) rotateY(12deg) scale(1.12);
  box-shadow:5px 8px 22px rgba(0,0,0,.14);
}
.sv-block:hover .sv-icon .lucide{animation:iconBounce .55s var(--ease-spring)}
/* Float */
@keyframes iconFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-7px)}}
.icon-float{animation:iconFloat 3.2s ease-in-out infinite}
/* Glow pulse */
@keyframes iconGlow{0%,100%{filter:drop-shadow(0 0 3px currentColor)}50%{filter:drop-shadow(0 0 12px currentColor)}}
.icon-glow{animation:iconGlow 2.8s ease-in-out infinite}
/* Bounce micro-animation */
@keyframes iconBounce{0%,100%{transform:scale(1) rotate(0deg)}40%{transform:scale(1.3) rotate(10deg)}70%{transform:scale(.9) rotate(-5deg)}}
/* Dash-flow for SVG connection lines */
@keyframes dashFlow{from{stroke-dashoffset:20}to{stroke-dashoffset:0}}
</style>
@yield('styles')
</head>
<body>

<!-- SCROLL PROGRESS -->
<div id="scroll-progress"></div>

<!-- MOBILE MENU OVERLAY -->
<div class="mob-menu" id="mobMenu">
  <a href="{{ route('home') }}">Home</a>
  <a href="{{ route('about') }}">About</a>
  <a href="{{ route('services') }}">Services</a>
  <a href="{{ route('wellbeing') }}">Wellbeing</a>
  <a href="{{ route('tscc') }}">TSCC</a>
  <a href="{{ route('gallery') }}">Gallery</a>
  <a href="{{ route('blog') }}">Blog</a>
  <a href="{{ route('contact') }}" class="mob-cta">Book a Session</a>
</div>

<!-- NAV -->
<nav id="mainNav">
  <div class="nav-wrap">
    <a href="{{ route('home') }}" class="logo-area">
      <img src="{{ asset('logo.png') }}" alt="TREC Logo" class="logo-img">
      <div class="logo-wordmark">
        <strong>TREC</strong>
        <span>The Ripple Effect Consult</span>
      </div>
    </a>
    <div class="nav-links">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'act' : '' }}">Home</a>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'act' : '' }}">About</a>
      <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'act' : '' }}">Services</a>
      <a href="{{ route('wellbeing') }}" class="{{ request()->routeIs('wellbeing') ? 'act' : '' }}">Wellbeing</a>
      <a href="{{ route('tscc') }}" class="{{ request()->routeIs('tscc') ? 'act' : '' }}">TSCC</a>
      <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'act' : '' }}">Gallery</a>
      <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'act' : '' }}">Blog</a>
    </div>
    <a href="{{ route('contact') }}" class="nav-btn">Book a Session</a>
    <button class="hamburger" id="hamburger" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>

<!-- CONTENT -->
<main style="padding-top: var(--nav-h);">
  @if(session('success'))
    <div class="toast">✓ {{ session('success') }}</div>
  @endif
  @yield('content')
</main>

<!-- FOOTER -->
<footer>
  <div class="ft-inner">
    <div class="ft-grid reveal-stagger">
      <div class="ft-brand">
        <div style="display:flex;align-items:center;gap:10px">
          <img src="{{ asset('logo.png') }}" alt="TREC Logo" class="logo-img">
          <div class="logo-wordmark"><strong style="color:#fff">TREC</strong><span>The Ripple Effect Consult</span></div>
        </div>
        <p>Professional counselling, training & consultation creating lasting ripples across individuals, schools, and organisations.</p>
        <div class="ft-socials">
          <a href="https://www.linkedin.com/company/trec-ripple-effect-consult" target="_blank" class="ft-social-link" aria-label="LinkedIn">
            <svg viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
          </a>
          <a href="https://www.instagram.com/rippleeffectconsult" target="_blank" class="ft-social-link" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
          <a href="https://www.facebook.com/rippleeffectconsult" target="_blank" class="ft-social-link" aria-label="Facebook">
            <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://twitter.com/ripple_effect_c" target="_blank" class="ft-social-link" aria-label="Twitter/X">
            <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.735-8.835L1.254 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>
          </a>
        </div>
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
        <h4>Contact</h4>
        <a href="tel:+2349056057502">+234 905 605 7502</a>
        <a href="tel:+2348080639507">+234 808 063 9507</a>
        <a href="mailto:rippleeffectconsult@gmail.com">rippleeffectconsult@gmail.com</a>
        <a href="#">11 Raji Crescent, Baruwa, Ipaja</a>
      </div>
    </div>
    <div class="ft-bottom">
      <p>© 2025 The Ripple Effect Consult. All rights reserved.</p>
      <div class="ft-tagline">People. Purpose. Impact.</div>
    </div>
  </div>
</footer>

@yield('scripts')

<script>
// ── Body load fade-in + Lucide icons
document.addEventListener('DOMContentLoaded', () => {
  requestAnimationFrame(() => document.body.classList.add('loaded'));
  if (typeof lucide !== 'undefined') lucide.createIcons();
});

// ── Scroll progress bar
const progressBar = document.getElementById('scroll-progress');
window.addEventListener('scroll', () => {
  const scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
  const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  const progress = scrollTop / scrollHeight;
  progressBar.style.transform = `scaleX(${progress})`;

  // Smart nav
  const nav = document.getElementById('mainNav');
  if (scrollTop > 40) nav.classList.add('scrolled');
  else nav.classList.remove('scrolled');
}, { passive: true });

// Initial nav state
const nav = document.getElementById('mainNav');
if ((document.documentElement.scrollTop || document.body.scrollTop) > 40) nav.classList.add('scrolled');

// ── Hamburger menu
const hamburger = document.getElementById('hamburger');
const mobMenu = document.getElementById('mobMenu');
let menuOpen = false;

hamburger.addEventListener('click', () => {
  menuOpen = !menuOpen;
  hamburger.classList.toggle('open', menuOpen);
  mobMenu.classList.toggle('open', menuOpen);
  document.body.style.overflow = menuOpen ? 'hidden' : '';
});

mobMenu.querySelectorAll('a').forEach(a => {
  a.addEventListener('click', () => {
    menuOpen = false;
    hamburger.classList.remove('open');
    mobMenu.classList.remove('open');
    document.body.style.overflow = '';
  });
});

// ── Scroll reveal (IntersectionObserver)
const revealEls = document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.reveal-scale,.reveal-stagger');
const revealObs = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      revealObs.unobserve(entry.target);
    }
  });
}, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
revealEls.forEach(el => revealObs.observe(el));

// ── Animated number counters
function animateCounter(el) {
  const target = parseInt(el.dataset.count);
  const suffix = el.dataset.suffix || '';
  const duration = 1800;
  const start = performance.now();
  const update = (now) => {
    const elapsed = now - start;
    const progress = Math.min(elapsed / duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3);
    el.textContent = Math.round(eased * target) + suffix;
    if (progress < 1) requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
}
const counterObs = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting && !entry.target.dataset.counted) {
      entry.target.dataset.counted = '1';
      animateCounter(entry.target);
      counterObs.unobserve(entry.target);
    }
  });
}, { threshold: 0.5 });
document.querySelectorAll('[data-count]').forEach(el => counterObs.observe(el));
</script>
</body>
</html>
