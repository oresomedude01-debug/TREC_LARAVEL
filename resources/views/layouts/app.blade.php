<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>@yield('title') – TREC</title>
<meta name="description" content="@yield('meta_desc', 'The Ripple Effect Consult — Professional counselling, training & consultation creating lasting change across individuals, schools, and organisations.')">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<style>
/* ── RESET & ROOT ── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
:root{
  --red:#D82D37;--orange:#E56918;--green:#6B8F1A;
  --black:#0D0D0D;--charcoal:#414042;--white:#FFFFFF;
  --cream:#FAF9F6;--light:#F2F1EE;--mid:#E8E7E3;
  --font-display:'DM Serif Display',Georgia,serif;
  --font-h:'Lora',Georgia,serif;
  --font-b:'Plus Jakarta Sans',system-ui,sans-serif;
  --font-ui:'Space Grotesk',system-ui,sans-serif;
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
button{font-family:var(--font-ui);cursor:pointer;border:none;background:none}
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
.logo-wordmark strong{display:block;font-family:var(--font-display);font-size:18px;font-weight:400;color:var(--black);letter-spacing:-.5px}
.logo-wordmark span{font-size:9px;font-weight:500;color:var(--charcoal);letter-spacing:2.5px;text-transform:uppercase;opacity:.65;font-family:var(--font-ui)}

/* Desktop links */
.nav-links{display:flex;align-items:center;gap:2px}
.nav-links a{
  font-family:var(--font-ui);font-size:13px;font-weight:500;color:var(--charcoal);
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
  background:var(--red);color:#fff;font-family:var(--font-ui);
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
  font-family:var(--font-display);font-size:2.2rem;font-weight:400;
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
  font-family:var(--font-ui);font-size:11px;font-weight:700;letter-spacing:3px;text-transform:uppercase;
  color:var(--red);margin-bottom:.9rem;
  display:flex;align-items:center;gap:10px;
}
.eyebrow::before{content:'';width:20px;height:2px;background:currentColor;flex-shrink:0}
h2.stitle{font-family:var(--font-display);font-size:clamp(2rem,3.5vw,2.75rem);font-weight:400;color:var(--black);line-height:1.1;margin-bottom:1.25rem}
h2.stitle.wh{color:#fff}
.slead{font-size:1rem;font-weight:300;color:var(--charcoal);max-width:520px;line-height:1.85}
.slead.wh{color:rgba(255,255,255,.65)}

/* ── BUTTONS ── */
.btn-red{
  background:var(--red);color:#fff;font-family:var(--font-ui);
  padding:13px 30px;font-size:14px;font-weight:600;letter-spacing:.3px;
  transition:all .25s var(--ease);display:inline-block;cursor:pointer;border:none;
  border-radius:8px;box-shadow:0 4px 14px rgba(216,45,55,.22);
}
.btn-red:hover{background:#b8242e;transform:translateY(-2px);box-shadow:0 8px 24px rgba(216,45,55,.35)}
.btn-ghost{
  background:transparent;color:var(--black);font-family:var(--font-ui);
  padding:13px 30px;font-size:14px;font-weight:500;
  border:1.5px solid rgba(13,13,13,.25);display:inline-block;
  transition:all .25s var(--ease);cursor:pointer;border-radius:8px;
}
.btn-ghost:hover{background:var(--black);color:#fff;border-color:var(--black)}
.btn-wh{
  background:#fff;color:var(--red);font-family:var(--font-ui);
  padding:13px 30px;font-size:14px;font-weight:700;
  display:inline-block;transition:all .25s var(--ease);
  cursor:pointer;border:none;border-radius:8px;
}
.btn-wh:hover{background:var(--cream);transform:translateY(-2px)}
.btn-orange{
  background:var(--orange);color:#fff;font-family:var(--font-ui);
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
.ft-col h4{font-family:var(--font-ui);font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:rgba(255,255,255,.3);margin-bottom:1.25rem}
.ft-col a{font-family:var(--font-b);display:block;font-size:13px;color:rgba(255,255,255,.45);cursor:pointer;margin-bottom:9px;font-weight:300;transition:color .2s}
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

/* ── FLOATING CONTACT WIDGET (SPEED DIAL) ── */
.trec-contact-widget {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  z-index: 9999;
  font-family: var(--font-b);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
}
.trec-widget-trigger {
  width: 48px; /* Slightly smaller, more refined trigger button */
  height: 48px;
  border-radius: 50%;
  background: var(--green);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 15px rgba(107, 143, 26, 0.35), 0 0 0 1px rgba(107, 143, 26, 0.1);
  transition: transform 0.35s var(--ease-spring), background-color 0.3s, box-shadow 0.3s;
  cursor: pointer;
  position: relative;
  z-index: 10;
  border: none;
  outline: none;
}
.trec-widget-trigger:hover {
  transform: scale(1.08);
  background: #5b7a16;
  box-shadow: 0 6px 20px rgba(107, 143, 26, 0.45);
}
.trec-widget-trigger .lucide {
  width: 22px;
  height: 22px;
  transition: transform 0.4s var(--ease-spring);
}
.trec-widget-trigger.active .lucide-message-circle {
  transform: rotate(90deg) scale(0);
  display: none !important;
}
.trec-widget-trigger .lucide-x {
  display: none;
  transform: rotate(-90deg) scale(0);
}
.trec-widget-trigger.active .lucide-x {
  display: block;
  transform: rotate(0) scale(1);
}

/* Pulsing Badge */
.trec-widget-badge {
  position: absolute;
  top: -2px;
  right: -2px;
  width: 12px;
  height: 12px;
  background: var(--red);
  border-radius: 50%;
  border: 2px solid #fff;
  box-shadow: 0 0 0 0 rgba(216,45,55,0.7);
  animation: badgePulse 2s infinite;
  transition: opacity 0.3s ease;
}
@keyframes badgePulse {
  0% { box-shadow: 0 0 0 0 rgba(216,45,55,0.7); }
  70% { box-shadow: 0 0 0 5px rgba(216,45,55,0); }
  100% { box-shadow: 0 0 0 0 rgba(216,45,55,0); }
}

/* Speed Dial Container */
.trec-widget-options {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.75rem;
  pointer-events: none;
  opacity: 0;
  transform: translateY(15px) scale(0.9);
  transition: transform 0.35s var(--ease-spring), opacity 0.3s ease;
  z-index: 9;
}
.trec-widget-options.open {
  pointer-events: all;
  opacity: 1;
  transform: translateY(0) scale(1);
}

/* Circular Option Buttons */
.trec-widget-option-btn {
  width: 40px; /* Refined option button size */
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  transition: transform 0.25s var(--ease-spring), box-shadow 0.2s;
  position: relative;
  border: none;
  outline: none;
  color: #fff;
  background: var(--black);
}
.trec-widget-option-btn .lucide {
  width: 18px;
  height: 18px;
}
.trec-widget-option-btn:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 18px rgba(0,0,0,0.25);
}

/* Tooltips */
.trec-widget-option-btn::before {
  content: attr(data-tooltip);
  position: absolute;
  right: 50px;
  top: 50%;
  transform: translateY(-50%) translateX(10px);
  background: rgba(13, 13, 13, 0.9);
  backdrop-filter: blur(4px);
  -webkit-backdrop-filter: blur(4px);
  color: #fff;
  padding: 0.35rem 0.75rem;
  border-radius: 6px;
  font-size: 11px;
  font-weight: 600;
  white-space: nowrap;
  pointer-events: none;
  opacity: 0;
  transition: transform 0.2s var(--ease), opacity 0.2s;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.trec-widget-option-btn:hover::before {
  opacity: 1;
  transform: translateY(-50%) translateX(0);
}

/* Option Colors */
.opt-whatsapp { background: #25D366; }
.opt-phone { background: var(--green); }
.opt-booking { background: var(--red); }
.opt-tscc { background: var(--orange); }
.opt-chat { background: linear-gradient(135deg, #6366f1, #8b5cf6); }

@media(max-width: 450px) {
  .trec-contact-widget {
    bottom: 1.5rem;
    right: 1.5rem;
  }
}

/* ══════════════════════════════════════
   TREC CHATBOT PANEL
══════════════════════════════════════ */
.trec-chatbot-panel {
  position: fixed;
  bottom: 90px;
  right: 1.75rem;
  width: 360px;
  max-height: 540px;
  background: #fff;
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(0,0,0,0.15), 0 0 0 1px rgba(0,0,0,0.06);
  display: flex;
  flex-direction: column;
  overflow: hidden;
  z-index: 9998;
  opacity: 0;
  pointer-events: none;
  transform: translateY(20px) scale(0.96);
  transform-origin: bottom right;
  transition: opacity 0.35s var(--ease), transform 0.35s cubic-bezier(0.34,1.4,0.64,1);
}
.trec-chatbot-panel.open {
  opacity: 1;
  pointer-events: all;
  transform: translateY(0) scale(1);
}
.chatbot-header {
  background: linear-gradient(135deg, #1a1a2e, #16213e);
  padding: 1rem 1.25rem;
  display: flex;
  align-items: center;
  gap: 0.85rem;
  flex-shrink: 0;
}
.chatbot-avatar {
  width: 40px; height: 40px;
  border-radius: 12px;
  background: linear-gradient(135deg, var(--red), var(--orange));
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.chatbot-avatar .lucide { width: 20px; height: 20px; stroke-width: 2; color: #fff; }
.chatbot-header-info { flex: 1; }
.chatbot-name { font-family: var(--font-h); font-size: 1rem; font-weight: 700; color: #fff; line-height: 1.2; }
.chatbot-status {
  font-size: 11px; color: rgba(255,255,255,0.55);
  display: flex; align-items: center; gap: 0.35rem; margin-top: 2px;
}
.chatbot-status-dot {
  width: 7px; height: 7px; border-radius: 50%; background: #4ade80;
  animation: badgePulse 2s infinite; flex-shrink: 0;
}
.chatbot-close {
  background: rgba(255,255,255,0.1); border: none; border-radius: 8px;
  width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;
  cursor: pointer; color: rgba(255,255,255,0.7); transition: all 0.2s;
}
.chatbot-close:hover { background: rgba(255,255,255,0.2); color: #fff; }
.chatbot-close .lucide { width: 16px; height: 16px; stroke-width: 2; }
.chatbot-messages {
  flex: 1; overflow-y: auto; padding: 1.25rem;
  display: flex; flex-direction: column; gap: 0.85rem;
  background: #f8f8fb; scroll-behavior: smooth;
}
.chatbot-messages::-webkit-scrollbar { width: 4px; }
.chatbot-messages::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.12); border-radius: 4px; }
.chat-bubble {
  max-width: 85%; padding: 0.7rem 1rem; border-radius: 16px;
  font-size: 13px; line-height: 1.6;
  animation: bubbleIn 0.3s cubic-bezier(0.34,1.4,0.64,1) forwards;
}
@keyframes bubbleIn {
  from { opacity: 0; transform: scale(0.85) translateY(8px); }
  to   { opacity: 1; transform: scale(1) translateY(0); }
}
.chat-bubble.bot {
  background: #fff; color: var(--charcoal);
  border: 1px solid rgba(0,0,0,0.07); border-bottom-left-radius: 4px;
  align-self: flex-start; box-shadow: 0 2px 10px rgba(0,0,0,0.04);
}
.chat-bubble.user {
  background: linear-gradient(135deg, var(--red), #e85d66);
  color: #fff; border-bottom-right-radius: 4px; align-self: flex-end;
  box-shadow: 0 4px 14px rgba(216,45,55,0.25);
}
.chat-bubble a { color: inherit; text-decoration: underline; text-underline-offset: 3px; font-weight: 600; opacity: 0.9; }
.chat-typing {
  align-self: flex-start; background: #fff; border: 1px solid rgba(0,0,0,0.07);
  border-radius: 16px; border-bottom-left-radius: 4px;
  padding: 0.75rem 1rem; display: flex; gap: 5px; align-items: center;
  box-shadow: 0 2px 10px rgba(0,0,0,0.04);
}
.chat-typing span {
  width: 6px; height: 6px; border-radius: 50%; background: #c0c0c8;
  animation: typingDot 1.2s infinite;
}
.chat-typing span:nth-child(2) { animation-delay: 0.2s; }
.chat-typing span:nth-child(3) { animation-delay: 0.4s; }
@keyframes typingDot {
  0%, 60%, 100% { transform: translateY(0); opacity: 0.4; }
  30%            { transform: translateY(-5px); opacity: 1; }
}
.chat-quick-replies {
  display: flex; flex-wrap: wrap; gap: 0.4rem;
  margin-top: 0.25rem; align-self: flex-start; max-width: 100%;
}
.chat-qr-btn {
  font-size: 11.5px; font-weight: 600; padding: 5px 12px;
  border: 1.5px solid rgba(216,45,55,0.3); border-radius: 100px;
  color: var(--red); background: rgba(216,45,55,0.04);
  cursor: pointer; transition: all 0.2s; white-space: nowrap;
}
.chat-qr-btn:hover { background: var(--red); border-color: var(--red); color: #fff; }
.chatbot-input-bar {
  display: flex; align-items: center; gap: 0.5rem;
  padding: 0.9rem 1rem; background: #fff;
  border-top: 1px solid rgba(0,0,0,0.06); flex-shrink: 0;
}
.chatbot-input {
  flex: 1; border: 1.5px solid rgba(0,0,0,0.1); border-radius: 100px;
  padding: 9px 16px; font-family: var(--font-b); font-size: 13px;
  color: var(--black); outline: none; transition: border-color 0.2s; background: #f8f8fb;
}
.chatbot-input:focus { border-color: var(--red); background: #fff; }
.chatbot-input::placeholder { color: rgba(65,64,66,0.4); }
.chatbot-send-btn {
  width: 36px; height: 36px; border-radius: 50%; background: var(--red); border: none;
  display: flex; align-items: center; justify-content: center; cursor: pointer;
  transition: all 0.2s; flex-shrink: 0; box-shadow: 0 3px 10px rgba(216,45,55,0.3);
}
.chatbot-send-btn:hover { background: #b8242e; transform: scale(1.08); }
.chatbot-send-btn .lucide { width: 16px; height: 16px; stroke-width: 2; color: #fff; }
@media(max-width: 450px) {
  .trec-chatbot-panel { right: 1rem; left: 1rem; width: auto; bottom: 80px; }
}
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
          <a href="https://www.facebook.com/people/The-Ripple-Effect-Consult/100063916400380/" target="_blank" class="ft-social-link" aria-label="Facebook">
            <svg viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
          </a>
          <a href="https://www.instagram.com/tscc2026?igsh=cDU4bzV3NjF6cTB6&utm_source=qr" target="_blank" class="ft-social-link" aria-label="Instagram">
            <svg viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
          </a>
          <a href="https://x.com/Theschoolcon" target="_blank" class="ft-social-link" aria-label="Twitter/X">
            <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.742l7.735-8.835L1.254 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/></svg>
          </a>
          <a href="https://www.tiktok.com/@theschoolcounsellingcon0" target="_blank" class="ft-social-link" aria-label="TikTok">
            <svg viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.79a4.85 4.85 0 01-1.01-.1z"/></svg>
          </a>
        </div>
      </div>
      <div class="ft-col">
        <h4>Services</h4>
        <a href="{{ route('services') }}">Individual Counselling</a>
        <a href="{{ route('services') }}">Group Counselling</a>
        <a href="{{ route('services') }}">Corporate Training</a>
        <a href="{{ route('home') }}#wellbeing-package">School Wellbeing</a>
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

@php
  // Check if we are on a page where the widget should be hidden
  $isSuccess = session('success') || request()->is('success') || request()->is('checkout/success');
  $isCheckout = request()->is('checkout*') || request()->is('admin*');
@endphp

@if(!$isSuccess && !$isCheckout)
  <!-- Floating Contact Widget (Speed Dial Format) -->
  <div class="trec-contact-widget" id="trecContactWidget">
    <!-- Speed Dial Options -->
    <div class="trec-widget-options" id="trecWidgetOptions">
      <!-- TSCC Option -->
      <a href="{{ route('tscc') }}" class="trec-widget-option-btn opt-tscc" data-tooltip="TSCC Conference" aria-label="TSCC Conference">
        <i data-lucide="award"></i>
      </a>

      <!-- Booking Option -->
      <a href="{{ route('contact') }}" class="trec-widget-option-btn opt-booking" data-tooltip="Book a Session" aria-label="Book a Session">
        <i data-lucide="calendar"></i>
      </a>

      <!-- Call Option -->
      <a href="tel:+2349056057502" class="trec-widget-option-btn opt-phone" data-tooltip="Call Helpline" aria-label="Call Helpline">
        <i data-lucide="phone"></i>
      </a>

      <!-- WhatsApp Option -->
      <a href="https://wa.me/2349056057502" target="_blank" class="trec-widget-option-btn opt-whatsapp" data-tooltip="WhatsApp Support" aria-label="WhatsApp Support">
        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" style="display:block"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.458L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.965C16.588 2.012 14.12 1.01 11.5 1.012c-5.443 0-9.867 4.371-9.871 9.8-.001 1.73.457 3.42 1.32 4.925l-.995 3.635 3.738-.978zM17.15 14.28c-.282-.141-1.67-.82-1.929-.915-.258-.094-.446-.141-.634.141-.188.281-.727.915-.892 1.102-.164.187-.329.21-.61.07-1.15-.52-2.02-.916-2.812-1.602-.686-.595-1.174-1.348-1.309-1.583-.135-.234-.015-.361.103-.478.107-.105.234-.282.352-.422.118-.141.157-.234.235-.39.078-.156.039-.297-.02-.437-.058-.141-.446-1.101-.611-1.5-.16-.388-.322-.335-.446-.341-.115-.006-.247-.007-.38-.007-.132 0-.348.05-.53.25-.182.2-.696.697-.696 1.7s.73 1.96.83 2.1c.101.14 1.436 2.193 3.48 3.078.486.21.866.335 1.161.43.489.155.934.133 1.286.08.393-.06 1.207-.493 1.378-.967.172-.474.172-.88.121-.966-.051-.086-.188-.135-.47-.276z"/></svg>
      </a>

      <!-- Chatbot Option -->
      <button class="trec-widget-option-btn opt-chat" id="trecChatTriggerBtn" data-tooltip="Ask AI Assistant" aria-label="Ask AI Assistant">
        <i data-lucide="bot"></i>
      </button>
    </div>

    <!-- Trigger Button -->
    <button class="trec-widget-trigger" id="trecWidgetTrigger" aria-label="Contact Options">
      <div class="trec-widget-badge" id="trecWidgetBadge"></div>
      <i data-lucide="message-circle" class="lucide-message-circle"></i>
      <i data-lucide="x" class="lucide-x"></i>
    </button>
  </div>

  <!-- Chatbot Panel -->
  <div class="trec-chatbot-panel" id="trecChatbotPanel">
    <div class="chatbot-header">
      <div class="chatbot-avatar">
        <i data-lucide="bot"></i>
      </div>
      <div class="chatbot-header-info">
        <div class="chatbot-name">TREC Assistant</div>
        <div class="chatbot-status">
          <span class="chatbot-status-dot"></span>
          Online • Ready to help
        </div>
      </div>
      <button class="chatbot-close" id="trecChatClose" aria-label="Close chat">
        <i data-lucide="x"></i>
      </button>
    </div>
    <div class="chatbot-messages" id="trecChatMessages"></div>
    <div class="chatbot-input-bar">
      <input type="text" class="chatbot-input" id="trecChatInput" placeholder="Ask about services, TSCC, booking..." aria-label="Chat input">
      <button class="chatbot-send-btn" id="trecChatSend" aria-label="Send message">
        <i data-lucide="send"></i>
      </button>
    </div>
  </div>
@endif

@yield('scripts')

<script>
// ── Body load fade-in + Lucide icons
document.addEventListener('DOMContentLoaded', () => {
  requestAnimationFrame(() => document.body.classList.add('loaded'));
  if (typeof lucide !== 'undefined') lucide.createIcons();

  // ── Floating Contact Widget Logic (Speed Dial)
  const widgetTrigger = document.getElementById('trecWidgetTrigger');
  const widgetOptions = document.getElementById('trecWidgetOptions');
  const widgetBadge   = document.getElementById('trecWidgetBadge');

  if (widgetTrigger && widgetOptions) {
    widgetTrigger.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = widgetOptions.classList.toggle('open');
      widgetTrigger.classList.toggle('active', isOpen);
      
      // Hide badge on click
      if (isOpen && widgetBadge) {
        widgetBadge.style.opacity = '0';
        widgetBadge.style.pointerEvents = 'none';
      }
    });

    document.addEventListener('click', (e) => {
      if (!widgetOptions.contains(e.target) && !widgetTrigger.contains(e.target)) {
        widgetOptions.classList.remove('open');
        widgetTrigger.classList.remove('active');
      }
    });
  }

  // ── Chatbot Logic
  const chatbotPanel = document.getElementById('trecChatbotPanel');
  const chatTriggerBtn = document.getElementById('trecChatTriggerBtn');
  const chatCloseBtn = document.getElementById('trecChatClose');
  const chatMessages = document.getElementById('trecChatMessages');
  const chatInput = document.getElementById('trecChatInput');
  const chatSendBtn = document.getElementById('trecChatSend');

  function showBotWelcome() {
    appendBotMessage("Hello! I am your TREC AI Assistant. Ask me anything about our services, booking a session, our annual TSCC conference, or about our organization.");
    showQuickReplies([
      { text: "Counselling Services", value: "services" },
      { text: "Book a Session", value: "book a session" },
      { text: "TSCC Conference", value: "tscc" },
      { text: "Contact Info", value: "contact" },
      { text: "About TREC", value: "about" }
    ]);
  }

  function appendBotMessage(htmlContent) {
    if (!chatMessages) return;
    const bubble = document.createElement('div');
    bubble.className = 'chat-bubble bot';
    bubble.innerHTML = htmlContent;
    chatMessages.appendChild(bubble);
    scrollToBottom();
  }

  function appendUserMessage(text) {
    if (!chatMessages) return;
    const bubble = document.createElement('div');
    bubble.className = 'chat-bubble user';
    bubble.textContent = text;
    chatMessages.appendChild(bubble);
    scrollToBottom();
  }

  function showQuickReplies(replies) {
    if (!chatMessages) return;
    const container = document.createElement('div');
    container.className = 'chat-quick-replies';
    replies.forEach(r => {
      const btn = document.createElement('button');
      btn.className = 'chat-qr-btn';
      btn.textContent = r.text;
      btn.addEventListener('click', () => {
        container.remove();
        appendUserMessage(r.text);
        showTypingAndRespond(r.value);
      });
      container.appendChild(btn);
    });
    chatMessages.appendChild(container);
    scrollToBottom();
  }

  function scrollToBottom() {
    if (chatMessages) {
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  }

  function showTypingAndRespond(query) {
    if (!chatMessages) return;
    const typingIndicator = document.createElement('div');
    typingIndicator.className = 'chat-typing';
    typingIndicator.innerHTML = '<span></span><span></span><span></span>';
    chatMessages.appendChild(typingIndicator);
    scrollToBottom();

    setTimeout(() => {
      typingIndicator.remove();
      const response = getBotResponse(query);
      appendBotMessage(response);
    }, 750);
  }

  function getBotResponse(query) {
    const q = query.toLowerCase().trim();

    // ── GREETINGS ──
    if (q.match(/\b(hi|hello|hey|greetings|howdy|good morning|good afternoon|good evening|counselor|bot|assistant)\b/)) {
      return "Hello and welcome to The Ripple Effect Consult! 👋 I'm your TREC assistant. Whether you need personal counselling, school wellbeing support, or want to attend our flagship TSCC Conference — we're here to help. What can I do for you today?";
    }

    // ── FOUNDER ──
    if (q.includes('founder') || q.includes('faatimah') || q.includes('samuel') || q.includes('ceo') || q.includes('director') || q.includes('lead') || q.includes('who started') || q.includes('who founded')) {
      return "TREC was founded by <b>Faatimah Samuel</b> — a distinguished counselling psychologist, certified school counsellor, and mental health advocate with over a decade of experience transforming lives across Nigeria.<br><br>She holds the prestigious <b>MCASSON</b> (Member, Counselling Association of Nigeria) and <b>FPMC</b> (Fellow, Professional Mentoring Council) certifications. Faatimah is also the visionary behind the annual <b>School Counselling Conference (TSCC)</b>.<br><br>🔗 <a href='https://ng.linkedin.com/in/faatimah-samuel-mcasson-fpmc-619a79173' target='_blank'>Connect with her on LinkedIn</a><br><br>Would you like to <a href='/contact'>book a consultation</a> with our team today?";
    }

    // ── SOCIAL MEDIA ──
    if (q.includes('social') || q.includes('instagram') || q.includes('facebook') || q.includes('twitter') || q.includes('tiktok') || q.includes('follow') || q.includes('handle') || q.includes('linkedin')) {
      return "Follow TREC and TSCC on social media for mental health tips, event updates, and counselling insights:<br><ul><li>📘 <b>Facebook:</b> <a href='https://www.facebook.com/people/The-Ripple-Effect-Consult/100063916400380/' target='_blank'>The Ripple Effect Consult</a></li><li>📸 <b>Instagram:</b> <a href='https://www.instagram.com/tscc2026' target='_blank'>@tscc2026</a></li><li>🐦 <b>Twitter/X:</b> <a href='https://x.com/Theschoolcon' target='_blank'>@Theschoolcon</a></li><li>🎵 <b>TikTok:</b> <a href='https://www.tiktok.com/@theschoolcounsellingcon0' target='_blank'>@theschoolcounsellingcon0</a></li><li>💼 <b>LinkedIn (Founder):</b> <a href='https://ng.linkedin.com/in/faatimah-samuel-mcasson-fpmc-619a79173' target='_blank'>Faatimah Samuel</a></li></ul>While you're here — would you like to <a href='/contact'>book a free consultation</a>?";
    }

    // ── BOOKING ──
    if (q.includes('book') || q.includes('appointment') || q.includes('schedule') || q.includes('session') || q.includes('consult') || q.includes('register') || q.includes('sign up') || q.includes('enroll')) {
      return "Great choice! Taking that first step is the most important one. 🌟<br><br>You can book a session in just a few clicks on our <a href='/contact'><b>Contact / Booking Page</b></a>. We offer:<ul><li>✅ <b>Free initial consultation</b></li><li>✅ Individual & Group Counselling</li><li>✅ Corporate & School Wellbeing packages</li></ul>Our team will get back to you promptly. Ready to start your journey? <a href='/contact'>Book now →</a>";
    }

    // ── TSCC ──
    if (q.includes('tscc') || q.includes('conference') || q.includes('annual') || q.includes('2026')) {
      return "🎓 <b>The School Counselling Conference (TSCC) 2026</b> is Nigeria's premier annual event for school counsellors, educators, and mental health professionals!<br><br>It features:<ul><li>🎤 Expert Keynote Speakers</li><li>📚 CPD-accredited Workshops</li><li>🤝 Networking with 400+ delegates</li><li>🏫 Collaboration with 50+ schools</li></ul>Don't miss out — visit our <a href='/tscc'>TSCC Page</a> to register or enquire about <b>sponsorship opportunities</b>. Sponsoring TSCC puts your brand in front of Nigeria's top education leaders!";
    }

    // ── SPONSORSHIP ──
    if (q.includes('sponsor') || q.includes('partnership') || q.includes('partner') || q.includes('brand') || q.includes('advertise') || q.includes('exhibit')) {
      return "💼 Partnering with TREC or sponsoring the TSCC Conference is a powerful way to reach Nigeria's education and mental health community!<br><br>Benefits include:<ul><li>🌍 Brand exposure to 400+ educators and counsellors</li><li>📢 Featured promotions across our social media platforms</li><li>🤝 Strategic partnerships with top schools</li></ul>Reach us now to secure your spot: <a href='/contact'>Submit a sponsorship enquiry →</a> or email <a href='mailto:rippleeffectconsult@gmail.com'>rippleeffectconsult@gmail.com</a>";
    }

    // ── SERVICES ──
    if (q.includes('service') || q.includes('offer') || q.includes('counselling') || q.includes('therapy') || q.includes('training') || q.includes('corporate') || q.includes('parenting') || q.includes('what do you do')) {
      return "TREC provides world-class counselling, training, and consultation services:<ul><li>🧠 <b>Individual Counselling:</b> Anxiety, depression, grief, relationships — one-on-one with a certified therapist.</li><li>👥 <b>Group Counselling:</b> Peer support groups and grief circles.</li><li>🏢 <b>Corporate Training:</b> Stress management, leadership wellbeing, and employee wellness.</li><li>🏫 <b>School Wellbeing:</b> Full audits, student counselling, staff training, and policy development.</li><li>👨‍👩‍👧 <b>Parenting Workshops:</b> Practical tools to raise emotionally resilient children.</li></ul>Each service is tailored to your unique needs. <a href='/contact'><b>Book a free consultation today →</b></a>";
    }

    // ── PRICING ──
    if (q.includes('price') || q.includes('cost') || q.includes('pricing') || q.includes('fee') || q.includes('charge') || q.includes('pay') || q.includes('free') || q.includes('how much')) {
      return "We believe impactful mental health support should be accessible. Here's how we work:<ul><li>🎁 <b>Free Initial Consultation</b> — no strings attached!</li><li>💳 Flexible pricing for individual, group, and corporate packages.</li><li>🏫 Custom school wellbeing packages tailored to your institution's needs.</li></ul>To get a personalised quote, <a href='/contact'><b>contact us here →</b></a> — our team responds within 24 hours.";
    }

    // ── CONTACT / LOCATION ──
    if (q.includes('contact') || q.includes('phone') || q.includes('email') || q.includes('number') || q.includes('call') || q.includes('address') || q.includes('location') || q.includes('where') || q.includes('hour') || q.includes('time') || q.includes('office') || q.includes('map') || q.includes('reach')) {
      return "Here's how to reach TREC Nigeria:<ul><li>📞 <b>Phone:</b> <a href='tel:+2349056057502'>+234 905 605 7502</a> or <a href='tel:+2348080639507'>+234 808 063 9507</a></li><li>📧 <b>Email:</b> <a href='mailto:rippleeffectconsult@gmail.com'>rippleeffectconsult@gmail.com</a></li><li>📍 <b>Address:</b> 11 Raji Crescent, Baruwa, Ipaja, Lagos, Nigeria.</li><li>🕘 <b>Hours:</b> Monday – Friday, 9:00 AM – 5:00 PM.</li></ul>Or <a href='/contact'><b>fill our online form</b></a> and we'll get back to you within 24 hours!";
    }

    // ── ABOUT / WHO ARE YOU ──
    if (q.includes('about') || q.includes('who') || q.includes('story') || q.includes('team') || q.includes('trec') || q.includes('ripple') || q.includes('history') || q.includes('background')) {
      return "The Ripple Effect Consult (TREC) was founded in <b>2017</b> in Lagos, Nigeria by <b>Faatimah Samuel (MCASSON, FPMC)</b> — a passionate mental health advocate.<br><br>Over 8 years, we've:<ul><li>🧠 Counselled <b>500+ individuals</b></li><li>🏫 Supported <b>50+ schools</b></li><li>🎓 Trained <b>200+ professionals</b></li></ul>Our mission is to make mental health support accessible, sustainable, and impactful across Nigeria. <a href='/about'>Learn our full story →</a><br><br>Ready to experience the TREC difference? <a href='/contact'><b>Book a session →</b></a>";
    }

    // ── SCHOOL / WELLBEING ──
    if (q.includes('wellbeing') || q.includes('school package') || q.includes('teacher') || q.includes('student') || q.includes('school counsell')) {
      return "Our <b>School Wellbeing Package</b> is a comprehensive, 6-step framework:<ol><li>📋 Wellbeing Audit</li><li>📄 Policy Development</li><li>🧠 Student Counselling</li><li>👩‍🏫 Staff Training</li><li>👪 Parent Engagement</li><li>🔄 Review & Evaluation</li></ol>This embeds lasting emotional health into your school's culture. Many schools report dramatic improvements in student behaviour and staff retention.<br><br><a href='/contact'><b>Request a school wellbeing consultation →</b></a>";
    }

    // ── BLOG ──
    if (q.includes('blog') || q.includes('article') || q.includes('post') || q.includes('resource') || q.includes('read') || q.includes('tip')) {
      return "We regularly share evidence-based mental health resources, coping strategies, and industry insights on our <a href='/blog'><b>Blog</b></a>. 📚 Great for parents, educators, and individuals on their wellness journey. Check it out — and while you're at it, why not <a href='/contact'>book a free consultation?</a>";
    }

    // ── THANK YOU ──
    if (q.includes('thank') || q.includes('thanks') || q.includes('appreciate') || q.includes('great') || q.includes('awesome') || q.includes('perfect')) {
      return "You're very welcome! 😊 It was our pleasure. Remember, taking care of your mental health is one of the best investments you can make. <a href='/contact'><b>Book a free session</b></a> anytime — our team is always here for you!";
    }

    // ── FALLBACK (sales-driven) ──
    return "Thanks for reaching out! I want to make sure I point you in the right direction. 🙂 You can ask me about our <b>services</b>, <b>booking a session</b>, the <b>TSCC Conference</b>, our <b>founder</b>, <b>social media</b>, or our <b>contact details</b>.<br><br>Or simply <a href='/contact'><b>send us a message directly →</b></a> and our team will personally assist you within 24 hours!";
  }

  // Open chatbot
  if (chatTriggerBtn && chatbotPanel) {
    chatTriggerBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpening = !chatbotPanel.classList.contains('open');
      
      if (isOpening) {
        chatbotPanel.classList.add('open');
        // Close speed dial options
        if (widgetOptions) widgetOptions.classList.remove('open');
        if (widgetTrigger) widgetTrigger.classList.remove('active');

        // Initialize welcome message if empty
        if (chatMessages && chatMessages.children.length === 0) {
          showBotWelcome();
        }

        // Focus input
        setTimeout(() => chatInput && chatInput.focus(), 300);
      } else {
        chatbotPanel.classList.remove('open');
      }
    });
  }

  // Close chatbot
  if (chatCloseBtn && chatbotPanel) {
    chatCloseBtn.addEventListener('click', () => {
      chatbotPanel.classList.remove('open');
    });
  }

  // Click outside to close chatbot
  document.addEventListener('click', (e) => {
    if (chatbotPanel && chatbotPanel.classList.contains('open')) {
      if (!chatbotPanel.contains(e.target) && !chatTriggerBtn.contains(e.target)) {
        chatbotPanel.classList.remove('open');
      }
    }
  });

  // Send message on click
  if (chatSendBtn && chatInput) {
    chatSendBtn.addEventListener('click', () => {
      const text = chatInput.value.trim();
      if (!text) return;
      appendUserMessage(text);
      chatInput.value = '';
      showTypingAndRespond(text);
    });

    chatInput.addEventListener('keydown', (e) => {
      if (e.key === 'Enter') {
        const text = chatInput.value.trim();
        if (!text) return;
        appendUserMessage(text);
        chatInput.value = '';
        showTypingAndRespond(text);
      }
    });
  }
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
