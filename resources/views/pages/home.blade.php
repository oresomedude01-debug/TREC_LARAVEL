@extends('layouts.app')

@section('title', 'Home - TREC Mental Health Counselling & Consultation')
@section('meta_desc', 'TREC (The Ripple Effect Consult) - Professional mental health counselling, psychological consultation, and wellness training for individuals, schools, and organisations. Expert mental health services in Nigeria.')
@section('meta_keywords', 'TREC, The Ripple Effect Consult, mental health counselling, counseling services, mental health support, psychological consultation, stress management, anxiety support, mental wellness, school counselling, workplace mental health, professional consultation, psychotherapy, emotional wellbeing, mental health Nigeria')
@section('og_title', 'TREC - Professional Mental Health Counselling & Consultation Services')
@section('og_desc', 'TREC (The Ripple Effect Consult) provides expert mental health counselling, psychological consultation, and wellness programs for individuals, schools, and organisations.')
@section('breadcrumb_title', 'Home')
@section('styles')
<style>
/* ══════════════════════════════════════
   HERO — FULL-BLEED BG + SVG NETWORK
══════════════════════════════════════ */

/* ── Hero base ── */
.hero {
  position: relative;
  height: 750px;
  background-image: url('/hero-counsellor.png');
  background-size: cover;
  background-position: 50% center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
}

/* Prevent image cropping of faces on medium screens */
@media (max-width: 1200px) {
  .hero {
    height: 720px;
    background-position: 45% center;
  }
}

/* Ensure hero doesn't push content off-screen and allows peek of next section */
@media (max-width: 1024px) {
  .hero {
    height: 680px;
    background-position: 40% center;
  }
}

@media (max-width: 768px) {
  .hero {
    height: 640px;
    background-attachment: scroll;
    background-position: 35% center;
  }
}

@media (max-width: 640px) {
  .hero {
    min-height: 600px;
    height: auto;
    background-position: center center;
    background-size: cover;
  }
}

/* ── Overlays ── */
.hero-overlay-l {
  position: absolute; inset: 0; pointer-events: none; z-index: 1;
  background: linear-gradient(
    to right,
    rgba(10,10,20,0.88) 0%,
    rgba(10,10,20,0.82) 35%,
    rgba(10,10,20,0.60) 55%,
    rgba(10,10,20,0.15) 78%,
    rgba(10,10,20,0.00) 100%
  );
}

@media (max-width: 768px) {
  .hero-overlay-l {
    background: linear-gradient(
      to right,
      rgba(10,10,20,0.90) 0%,
      rgba(10,10,20,0.85) 30%,
      rgba(10,10,20,0.65) 50%,
      rgba(10,10,20,0.25) 75%,
      rgba(10,10,20,0.05) 100%
    );
  }
}

@media (max-width: 640px) {
  .hero-overlay-l {
    background: linear-gradient(
      to right,
      rgba(10,10,20,0.92) 0%,
      rgba(10,10,20,0.88) 25%,
      rgba(10,10,20,0.70) 45%,
      rgba(10,10,20,0.35) 70%,
      rgba(10,10,20,0.10) 100%
    );
  }
}

.hero-overlay-b {
  position: absolute; inset: 0; pointer-events: none; z-index: 1;
  background: linear-gradient(to top, rgba(10,10,20,0.55) 0%, transparent 35%);
}

.hero-overlay-t {
  position: absolute; inset: 0; pointer-events: none; z-index: 1;
  background: radial-gradient(ellipse 65% 70% at 0% 0%, rgba(216,45,55,0.08) 0%, transparent 60%);
}

/* ── Ripple rings (right-anchored, white tones) ── */
.hero-ripples {
  position: absolute; inset: 0; pointer-events: none; overflow: hidden; z-index: 2;
}
.rr {
  position: absolute; border-radius: 50%;
  animation: heroRipple 8s ease-out infinite;
  top: 50%; left: 78%;
  transform: translate(-50%, -50%) scale(0.85);
}
.rr:nth-child(1) { width: 120px;  height: 120px;  border: 2px solid rgba(255,255,255,0.40); animation-delay: 0s;   }
.rr:nth-child(2) { width: 260px;  height: 260px;  border: 1.5px solid rgba(255,255,255,0.25); animation-delay: 1.3s; }
.rr:nth-child(3) { width: 420px;  height: 420px;  border: 1px solid rgba(255,255,255,0.15); animation-delay: 2.6s; }
.rr:nth-child(4) { width: 610px;  height: 610px;  border: 1px solid rgba(255,255,255,0.08); animation-delay: 3.9s; }
.rr:nth-child(5) { width: 820px;  height: 820px;  border: 1px solid rgba(255,255,255,0.04); animation-delay: 5.2s; }
.rr:nth-child(6) { width: 1060px; height: 1060px; border: 1px solid rgba(255,255,255,0.02); animation-delay: 6.5s; }

@media (max-width: 1024px) {
  .rr {
    left: 80%;
  }
  .rr:nth-child(1) { width: 100px;  height: 100px; }
  .rr:nth-child(2) { width: 220px;  height: 220px; }
  .rr:nth-child(3) { width: 360px;  height: 360px; }
  .rr:nth-child(4) { width: 520px;  height: 520px; }
  .rr:nth-child(5) { width: 700px;  height: 700px; }
  .rr:nth-child(6) { width: 900px;  height: 900px; }
}

@media (max-width: 640px) {
  .rr {
    display: none;
  }
}

@keyframes heroRipple {
  0%   { opacity: 1; transform: translate(-50%, -50%) scale(0.80); }
  100% { opacity: 0; transform: translate(-50%, -50%) scale(1.05); }
}

/* ── Hero inner: two-column grid ── */
.hero-inner {
  position: relative; z-index: 3;
  max-width: 1280px; margin: 0 auto;
  padding: 5rem 2rem 5rem;
  width: 100%;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
  height: 100%;
}

@media (max-width: 1024px) {
  .hero-inner {
    padding: 4rem 2rem 4rem;
    gap: 2.5rem;
  }
}

@media (max-width: 768px) {
  .hero-inner {
    padding: 3.5rem 1.5rem 3.5rem;
    gap: 2rem;
  }
}

@media (max-width: 640px) {
  .hero-inner {
    grid-template-columns: 1fr;
    padding: 2.5rem 1.25rem 2.5rem;
    gap: 1.5rem;
    height: auto;
  }
}

/* ══════════════════════════════════════
   SVG NETWORK DIAGRAM — RIGHT COLUMN
══════════════════════════════════════ */
.hero-network {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
}

@media (max-width: 1024px) {
  .hero-network {
    max-width: 450px;
  }
}

@media (max-width: 768px) {
  .hero-network {
    max-width: 380px;
  }
}

@media (max-width: 640px) {
  .hero-network {
    display: none;
  }
}

.hero-network svg {
  width: 100%;
  max-width: 520px;
  height: auto;
  overflow: visible;
  filter: drop-shadow(0 20px 60px rgba(0,0,0,0.35));
  object-fit: contain;
}

/* Service Node Interactive Links */
.service-node-link {
  cursor: pointer;
  outline: none;
}
.service-node-link rect {
  transition: stroke-width 0.3s ease, stroke 0.3s ease, filter 0.3s ease;
}
.service-node-link:hover rect {
  stroke-width: 2.2px !important;
  stroke: rgba(255,255,255,0.85) !important;
  filter: brightness(1.25) drop-shadow(0 0 12px rgba(255,255,255,0.25));
}
.service-node-link:hover text {
  fill: #ffffff !important;
  text-shadow: 0 0 6px rgba(255,255,255,0.6);
  transition: fill 0.3s ease, text-shadow 0.3s ease;
}

/* Center hub pulse */
@keyframes hubPulse {
  0%,100% { r: 52; opacity: 0.18; }
  50%      { r: 68; opacity: 0.06; }
}
@keyframes hubPulse2 {
  0%,100% { r: 38; opacity: 0.30; }
  50%      { r: 52; opacity: 0.10; }
}
.hub-pulse  { animation: hubPulse  2.8s ease-in-out infinite; }
.hub-pulse2 { animation: hubPulse2 2.8s ease-in-out infinite 0.6s; }

/* Animated tentacle lines */
@keyframes flowDash {
  from { stroke-dashoffset: 180; }
  to   { stroke-dashoffset: 0; }
}
.tentacle {
  stroke-dasharray: 6 5;
  stroke-dashoffset: 0;
  animation: flowDash 2.2s linear infinite;
}
.t1  { animation-delay: 0s; }
.t2  { animation-delay: 0.35s; }
.t3  { animation-delay: 0.70s; }
.t4  { animation-delay: 1.05s; }
.t5  { animation-delay: 1.40s; }
.t6  { animation-delay: 1.75s; }

/* Connector dots at end of each tentacle */
@keyframes dotPop {
  0%,100% { r: 4; }
  50%      { r: 6; }
}
.conn-dot { animation: dotPop 2s ease-in-out infinite; }

/* Service node float animations */
@keyframes nodeFloat1 { 0%,100%{ transform:translateY(0); }   50%{ transform:translateY(-7px); } }
@keyframes nodeFloat2 { 0%,100%{ transform:translateY(-4px); }50%{ transform:translateY(4px); } }
@keyframes nodeFloat3 { 0%,100%{ transform:translateY(0); }   50%{ transform:translateY(-6px); } }
@keyframes nodeFloat4 { 0%,100%{ transform:translateY(-3px); }50%{ transform:translateY(5px); } }
@keyframes nodeFloat5 { 0%,100%{ transform:translateY(0); }   50%{ transform:translateY(-8px); } }
@keyframes nodeFloat6 { 0%,100%{ transform:translateY(-5px); }50%{ transform:translateY(3px); } }
.nf1 { transform-box:fill-box; transform-origin:center; animation: nodeFloat1 3.8s ease-in-out infinite; }
.nf2 { transform-box:fill-box; transform-origin:center; animation: nodeFloat2 4.2s ease-in-out infinite; }
.nf3 { transform-box:fill-box; transform-origin:center; animation: nodeFloat3 3.5s ease-in-out infinite; }
.nf4 { transform-box:fill-box; transform-origin:center; animation: nodeFloat4 4.6s ease-in-out infinite; }
.nf5 { transform-box:fill-box; transform-origin:center; animation: nodeFloat5 3.2s ease-in-out infinite; }
.nf6 { transform-box:fill-box; transform-origin:center; animation: nodeFloat6 4.9s ease-in-out infinite; }

/* ── RIGHT COLUMN: content panel ── */
.hero-content-panel {
  max-width: 560px;
  width: 100%;
}

/* Welcome pill */
.hero-welcome-pill {
  display: inline-flex; align-items: center; gap: 8px;
  background: rgba(255,255,255,0.10);
  border: 1px solid rgba(255,255,255,0.22);
  padding: 6px 16px 6px 8px; border-radius: 100px;
  font-size: 11.5px; font-weight: 700; color: rgba(255,255,255,0.90);
  letter-spacing: .6px; text-transform: uppercase;
  margin-bottom: 1.75rem;
  backdrop-filter: blur(8px);
}
.hero-welcome-pill .hw-dot {
  width: 8px; height: 8px; border-radius: 50%;
  background: var(--red);
  box-shadow: 0 0 0 3px rgba(216,45,55,0.30);
  animation: hwPulse 2.4s ease-in-out infinite; flex-shrink: 0;
}
@keyframes hwPulse {
  0%,100% { box-shadow: 0 0 0 3px rgba(216,45,55,.30); }
  50%      { box-shadow: 0 0 0 8px rgba(216,45,55,.08); }
}

/* Brand statement */
.hero-brand-statement {
  font-size: 11px; font-weight: 700; letter-spacing: 3.5px;
  text-transform: uppercase; color: var(--orange);
  margin-bottom: 1rem; display: flex; align-items: center; gap: 10px;
}
.hero-brand-statement::before {
  content: ''; width: 24px; height: 2.5px;
  background: currentColor; border-radius: 2px; flex-shrink: 0;
}

/* Headline */
h1.hero-headline {
  font-family: var(--font-h);
  font-size: clamp(2.4rem, 4vw, 3.9rem);
  font-weight: 900; color: #fff;
  line-height: 1.06; letter-spacing: -2px; margin-bottom: 1.4rem;
}
h1.hero-headline .hl-accent {
  background: linear-gradient(135deg, var(--red) 0%, var(--orange) 100%);
  -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
h1.hero-headline .hl-green { color: #8fc430; -webkit-text-fill-color: #8fc430; }

/* Supporting text */
.hero-supporting {
  font-size: 1.02rem; font-weight: 300; color: rgba(255,255,255,0.75);
  line-height: 1.85; max-width: 470px; margin-bottom: 1.4rem;
}

/* Emotional quote */
.hero-quote {
  background: rgba(255,255,255,0.08);
  border-left: 3.5px solid var(--red);
  border-radius: 0 10px 10px 0;
  padding: .9rem 1.25rem; margin-bottom: 2rem;
  font-size: .875rem; font-style: italic;
  color: rgba(255,255,255,0.70); line-height: 1.75;
  max-width: 470px; backdrop-filter: blur(4px);
}

/* CTA buttons */
.hero-ctas {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-bottom: 2.25rem;
}

@media (max-width: 768px) {
  .hero-ctas {
    gap: 0.9rem;
    margin-bottom: 2rem;
  }
}

@media (max-width: 640px) {
  .hero-ctas {
    flex-direction: column;
    gap: 0.8rem;
    margin-bottom: 1.8rem;
  }
}

.btn-hero-primary {
  background: linear-gradient(135deg, var(--red) 0%, #c02430 100%);
  color: #fff;
  padding: 15px 34px;
  font-size: 14.5px;
  font-weight: 700;
  border-radius: 10px;
  letter-spacing: .3px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 8px 28px rgba(216,45,55,.35), 0 2px 8px rgba(216,45,55,.18);
  transition: all .28s var(--ease);
  border: none;
  cursor: pointer;
}

@media (max-width: 640px) {
  .btn-hero-primary {
    width: 100%;
    justify-content: center;
    padding: 12px 28px;
    font-size: 13.5px;
  }
}

.btn-hero-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 14px 40px rgba(216,45,55,.45), 0 4px 14px rgba(216,45,55,.22);
}
.btn-hero-primary .btn-arrow {
  font-size: 1rem;
  transition: transform .25s var(--ease);
  display: inline-block;
}
.btn-hero-primary:hover .btn-arrow { transform: translateX(4px); }

.btn-hero-secondary {
  background: rgba(255,255,255,0.80);
  color: var(--black);
  padding: 15px 34px;
  font-size: 14.5px;
  font-weight: 600;
  border-radius: 10px;
  border: 2px solid rgba(13,13,13,.18);
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all .28s var(--ease);
  cursor: pointer;
  backdrop-filter: blur(6px);
}

@media (max-width: 640px) {
  .btn-hero-secondary {
    width: 100%;
    justify-content: center;
    padding: 12px 28px;
    font-size: 13.5px;
  }
}

.btn-hero-secondary:hover {
  border-color: var(--red);
  color: var(--red);
  background: rgba(255,255,255,.95);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,0,0,.10);
}

/* Trust indicators */
.hero-trust {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: .65rem .85rem; max-width: 440px;
}
.trust-item {
  display: flex; align-items: center; gap: 8px;
  font-size: 12.5px; font-weight: 500;
  color: rgba(255,255,255,0.80); line-height: 1.3;
}
.trust-check {
  width: 20px; height: 20px; border-radius: 50%;
  background: linear-gradient(135deg, var(--green), #8fc430);
  display: flex; align-items: center; justify-content: center;
  flex-shrink: 0; font-size: 10px; color: #fff; font-weight: 800;
  box-shadow: 0 2px 8px rgba(107,143,26,.45);
}

/* ── Scroll hint ── */
.hero-scroll-cue {
  position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
  display: flex; flex-direction: column; align-items: center; gap: 8px;
  color: rgba(255,255,255,.40); font-size: 10px;
  letter-spacing: 2px; text-transform: uppercase; z-index: 4;
}
.scroll-mouse-light {
  width: 20px; height: 32px; border: 1.5px solid rgba(255,255,255,.30);
  border-radius: 10px; display: flex; justify-content: center; padding-top: 5px;
}
.scroll-dot-light {
  width: 3px; height: 7px; background: rgba(255,255,255,.45);
  border-radius: 2px; animation: scrollBounceLight 1.8s ease-in-out infinite;
}
@keyframes scrollBounceLight { 0%{transform:translateY(0);opacity:1;} 100%{transform:translateY(9px);opacity:0;} }

/* ── Layered overlays for readability + warmth ── */
/* Layer 1: cream-white panel on left fading to transparent */
.hero-overlay-l {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to right,
    rgba(255, 252, 246, 0.97) 0%,
    rgba(255, 252, 246, 0.93) 30%,
    rgba(255, 252, 246, 0.70) 52%,
    rgba(255, 252, 246, 0.18) 72%,
    rgba(255, 252, 246, 0.00) 100%
  );
  pointer-events: none;
  z-index: 1;
}
/* Layer 2: subtle warm bottom vignette */
.hero-overlay-b {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(13, 13, 13, 0.28) 0%,
    transparent 40%
  );
  pointer-events: none;
  z-index: 1;
}
/* Layer 3: top-left ambient colour tint */
.hero-overlay-t {
  position: absolute;
  inset: 0;
  background: radial-gradient(
    ellipse 70% 80% at 0% 0%,
    rgba(216, 45, 55, 0.06) 0%,
    transparent 60%
  );
  pointer-events: none;
  z-index: 1;
}

/* ── Ripple rings (brand identity) centred on right side ── */
.hero-ripples {
  position: absolute;
  inset: 0;
  pointer-events: none;
  overflow: hidden;
  z-index: 2;
}
.rr {
  position: absolute;
  border-radius: 50%;
  animation: heroRipple 7s ease-out infinite;
  top: 50%;
  left: 75%;
  transform: translate(-50%, -50%) scale(0.85);
}
.rr:nth-child(1) { width: 140px;  height: 140px;  border: 2px solid rgba(255,255,255,0.55); animation-delay: 0s;   }
.rr:nth-child(2) { width: 300px;  height: 300px;  border: 1.5px solid rgba(255,255,255,0.35); animation-delay: 1.1s; }
.rr:nth-child(3) { width: 480px;  height: 480px;  border: 1px solid rgba(255,255,255,0.22); animation-delay: 2.2s; }
.rr:nth-child(4) { width: 680px;  height: 680px;  border: 1px solid rgba(255,255,255,0.12); animation-delay: 3.3s; }
.rr:nth-child(5) { width: 900px;  height: 900px;  border: 1px solid rgba(255,255,255,0.06); animation-delay: 4.4s; }
.rr:nth-child(6) { width: 1140px; height: 1140px; border: 1px solid rgba(255,255,255,0.03); animation-delay: 5.5s; }
@keyframes heroRipple {
  0%   { opacity: 1;   transform: translate(-50%, -50%) scale(0.82); }
  100% { opacity: 0;   transform: translate(-50%, -50%) scale(1.04); }
}

/* ── Hero inner: left-aligned single content column ── */
.hero-inner {
  position: relative;
  z-index: 3;
  max-width: 1240px;
  margin: 0 auto;
  padding: 5rem 2rem 6rem;
  width: 100%;
  display: flex;
  align-items: center;
}

/* ── Content panel ── */
.hero-content-panel {
  max-width: 580px;
  width: 100%;
}

@media (max-width: 1024px) {
  .hero-content-panel {
    max-width: 550px;
  }
}

@media (max-width: 768px) {
  .hero-content-panel {
    max-width: 100%;
  }
}

@media (max-width: 640px) {
  .hero-content-panel {
    max-width: 100%;
    width: 100%;
  }
}

/* Welcome pill */
.hero-welcome-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.85);
  border: 1px solid rgba(216, 45, 55, 0.25);
  padding: 6px 16px 6px 8px;
  border-radius: 100px;
  font-size: 11.5px;
  font-weight: 700;
  color: var(--red);
  letter-spacing: .6px;
  text-transform: uppercase;
  margin-bottom: 1.75rem;
  backdrop-filter: blur(6px);
  box-shadow: 0 2px 12px rgba(216,45,55,.10);
}

@media (max-width: 768px) {
  .hero-welcome-pill {
    padding: 5px 14px 5px 7px;
    font-size: 10.5px;
    margin-bottom: 1.5rem;
  }
}

@media (max-width: 640px) {
  .hero-welcome-pill {
    padding: 5px 12px 5px 6px;
    font-size: 10px;
    margin-bottom: 1.25rem;
  }
}

.hero-welcome-pill .hw-dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: var(--red);
  box-shadow: 0 0 0 3px rgba(216, 45, 55, 0.20);
  animation: hwPulse 2.4s ease-in-out infinite;
  flex-shrink: 0;
}

@media (max-width: 640px) {
  .hero-welcome-pill .hw-dot {
    width: 6px;
    height: 6px;
  }
}

@keyframes hwPulse {
  0%,100% { box-shadow: 0 0 0 3px rgba(216,45,55,.20); }
  50%      { box-shadow: 0 0 0 7px rgba(216,45,55,.07); }
}

/* Brand statement */
.hero-brand-statement {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 3.5px;
  text-transform: uppercase;
  color: var(--orange);
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

@media (max-width: 768px) {
  .hero-brand-statement {
    font-size: 10px;
    letter-spacing: 2.5px;
    margin-bottom: 0.9rem;
    gap: 8px;
  }
}

@media (max-width: 640px) {
  .hero-brand-statement {
    font-size: 9px;
    letter-spacing: 2px;
    margin-bottom: 0.8rem;
    gap: 6px;
  }
}

.hero-brand-statement::before {
  content: '';
  width: 24px;
  height: 2.5px;
  background: currentColor;
  border-radius: 2px;
  flex-shrink: 0;
}

@media (max-width: 768px) {
  .hero-brand-statement::before {
    width: 18px;
    height: 2px;
  }
}

@media (max-width: 640px) {
  .hero-brand-statement::before {
    width: 14px;
    height: 1.5px;
  }
}

/* Main headline */
h1.hero-headline {
  font-family: var(--font-h);
  font-size: clamp(2.6rem, 4.5vw, 4.2rem);
  font-weight: 900;
  color: var(--black);
  line-height: 1.06;
  letter-spacing: -2px;
  margin-bottom: 1.5rem;
}

@media (max-width: 1024px) {
  h1.hero-headline {
    font-size: clamp(2.4rem, 4vw, 3.8rem);
    margin-bottom: 1.4rem;
  }
}

@media (max-width: 768px) {
  h1.hero-headline {
    font-size: clamp(2.2rem, 3.5vw, 3.4rem);
    margin-bottom: 1.3rem;
  }
}

@media (max-width: 640px) {
  h1.hero-headline {
    font-size: clamp(1.75rem, 5vw, 2.4rem);
    margin-bottom: 1rem;
    line-height: 1.1;
  }
}
h1.hero-headline .hl-accent {
  background: linear-gradient(135deg, var(--red) 0%, var(--orange) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
h1.hero-headline .hl-green { color: var(--green); -webkit-text-fill-color: var(--green); }

/* Supporting text */
.hero-supporting {
  font-size: 1.05rem;
  font-weight: 400;
  color: var(--charcoal);
  line-height: 1.85;
  max-width: 480px;
  margin-bottom: 1.5rem;
}

@media (max-width: 1024px) {
  .hero-supporting {
    font-size: 1.02rem;
    margin-bottom: 1.4rem;
  }
}

@media (max-width: 768px) {
  .hero-supporting {
    font-size: 0.98rem;
    margin-bottom: 1.3rem;
    line-height: 1.8;
  }
}

@media (max-width: 640px) {
  .hero-supporting {
    font-size: 0.95rem;
    margin-bottom: 1.2rem;
    max-width: 100%;
  }
}

/* Emotional quote */
.hero-quote {
  background: rgba(255, 255, 255, 0.70);
  border-left: 3.5px solid var(--red);
  border-radius: 0 10px 10px 0;
  padding: .9rem 1.25rem;
  margin-bottom: 2.25rem;
  font-size: .88rem;
  font-style: italic;
  color: var(--charcoal);
  line-height: 1.75;
  max-width: 480px;
  backdrop-filter: blur(4px);
  box-shadow: 0 2px 16px rgba(0,0,0,.06);
}

@media (max-width: 1024px) {
  .hero-quote {
    padding: 0.85rem 1.15rem;
    margin-bottom: 2rem;
    font-size: 0.85rem;
  }
}

@media (max-width: 768px) {
  .hero-quote {
    padding: 0.8rem 1rem;
    margin-bottom: 1.8rem;
    font-size: 0.82rem;
    max-width: 100%;
  }
}

@media (max-width: 640px) {
  .hero-quote {
    padding: 0.75rem 0.9rem;
    margin-bottom: 1.5rem;
    font-size: 0.80rem;
    border-left-width: 3px;
  }
}

/* CTA buttons */
.hero-ctas {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
  margin-bottom: 2.25rem;
}
.btn-hero-primary {
  background: linear-gradient(135deg, var(--red) 0%, #c02430 100%);
  color: #fff;
  padding: 15px 34px;
  font-size: 14.5px;
  font-weight: 700;
  border-radius: 10px;
  letter-spacing: .3px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 8px 28px rgba(216,45,55,.35), 0 2px 8px rgba(216,45,55,.18);
  transition: all .28s var(--ease);
  border: none;
  cursor: pointer;
}
.btn-hero-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 14px 40px rgba(216,45,55,.45), 0 4px 14px rgba(216,45,55,.22);
}
.btn-hero-primary .btn-arrow {
  font-size: 1rem;
  transition: transform .25s var(--ease);
  display: inline-block;
}
.btn-hero-primary:hover .btn-arrow { transform: translateX(4px); }

.btn-hero-secondary {
  background: rgba(255,255,255,0.80);
  color: var(--black);
  padding: 15px 34px;
  font-size: 14.5px;
  font-weight: 600;
  border-radius: 10px;
  border: 2px solid rgba(13,13,13,.18);
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all .28s var(--ease);
  cursor: pointer;
  backdrop-filter: blur(6px);
}
.btn-hero-secondary:hover {
  border-color: var(--red);
  color: var(--red);
  background: rgba(255,255,255,.95);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,0,0,.10);
}

/* Trust indicators */
.hero-trust {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: .7rem .9rem;
  max-width: 460px;
}

@media (max-width: 1024px) {
  .hero-trust {
    gap: 0.65rem 0.85rem;
    max-width: 440px;
  }
}

@media (max-width: 768px) {
  .hero-trust {
    gap: 0.6rem 0.8rem;
    max-width: 100%;
  }
}

@media (max-width: 640px) {
  .hero-trust {
    grid-template-columns: 1fr;
    gap: 0.6rem;
    max-width: 100%;
  }
}

.trust-item {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: var(--black);
  line-height: 1.3;
}

@media (max-width: 768px) {
  .trust-item {
    font-size: 12.5px;
    font-weight: 500;
  }
}

@media (max-width: 640px) {
  .trust-item {
    font-size: 12px;
    gap: 6px;
  }
}

.trust-check {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--green), #8fc430);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  font-size: 10px;
  color: #fff;
  font-weight: 800;
  box-shadow: 0 2px 8px rgba(107,143,26,.35);
}

@media (max-width: 640px) {
  .trust-check {
    width: 18px;
    height: 18px;
    font-size: 9px;
  }
}

/* ── Floating bottom-right stat panel ── */
.hero-stat-panel {
  position: absolute;
  bottom: 2.5rem;
  right: 2.5rem;
  z-index: 4;
  display: flex;
  gap: 1rem;
}

@media (max-width: 1024px) {
  .hero-stat-panel {
    bottom: 2rem;
    right: 2rem;
    gap: 0.8rem;
  }
}

@media (max-width: 768px) {
  .hero-stat-panel {
    bottom: 1.5rem;
    right: 1.5rem;
    gap: 0.7rem;
  }
}

@media (max-width: 640px) {
  .hero-stat-panel {
    display: none;
  }
}

.hero-stat-card {
  background: rgba(255,255,255,0.90);
  backdrop-filter: blur(12px);
  border-radius: 16px;
  padding: 1rem 1.4rem;
  box-shadow: 0 8px 32px rgba(0,0,0,.14), 0 2px 8px rgba(0,0,0,.07);
  text-align: center;
  min-width: 90px;
  animation: statFloat 5s ease-in-out infinite alternate;
}

@media (max-width: 1024px) {
  .hero-stat-card {
    padding: 0.9rem 1.2rem;
    min-width: 80px;
  }
}

.hero-stat-card:nth-child(2) { animation-delay: 1.5s; }
.hero-stat-card:nth-child(3) { animation-delay: 3s; }
@keyframes statFloat {
  from { transform: translateY(0); }
  to   { transform: translateY(-7px); }
}
.hsc-val {
  font-family: var(--font-h);
  font-size: 1.7rem;
  font-weight: 900;
  line-height: 1;
  margin-bottom: .2rem;
}

@media (max-width: 1024px) {
  .hsc-val {
    font-size: 1.5rem;
  }
}

.hsc-val.sv-r { color: var(--red); }
.hsc-val.sv-o { color: var(--orange); }
.hsc-val.sv-g { color: var(--green); }
.hsc-label {
  font-size: 10.5px;
  font-weight: 500;
  color: var(--charcoal);
  opacity: .65;
  line-height: 1.3;
}

@media (max-width: 1024px) {
  .hsc-label {
    font-size: 9.5px;
  }
}

/* ── Scroll hint ── */
.hero-scroll-cue {
  position: absolute;
  bottom: 2rem;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  color: rgba(255,255,255,.55);
  font-size: 10px;
  letter-spacing: 2px;
  text-transform: uppercase;
  z-index: 4;
}

@media (max-width: 768px) {
  .hero-scroll-cue {
    bottom: 1.5rem;
    font-size: 9px;
  }
}

@media (max-width: 640px) {
  .hero-scroll-cue {
    display: none;
  }
}

.scroll-mouse-light {
  width: 20px;
  height: 32px;
  border: 1.5px solid rgba(255,255,255,.45);
  border-radius: 10px;
  display: flex;
  justify-content: center;
  padding-top: 5px;
}
.scroll-dot-light {
  width: 3px;
  height: 7px;
  background: rgba(255,255,255,.55);
  border-radius: 2px;
  animation: scrollBounceLight 1.8s ease-in-out infinite;
}
@keyframes scrollBounceLight { 0% { transform: translateY(0); opacity: 1; } 100% { transform: translateY(9px); opacity: 0; } }

/* ══════════════════════════════════════
   MARQUEE STRIP
══════════════════════════════════════ */
.marquee-strip {
  background: var(--red); padding: .9rem 0; overflow: hidden; position: relative;
}
.marquee-track {
  display: flex; gap: 0; white-space: nowrap;
  animation: marqueeScroll 25s linear infinite;
}
.marquee-item {
  display: inline-flex; align-items: center; gap: 12px;
  color: #fff; font-size: 12px; font-weight: 700; letter-spacing: 2px;
  text-transform: uppercase; padding: 0 2rem;
  border-right: 1px solid rgba(255,255,255,.2); flex-shrink: 0;
}
.marquee-dot { width: 5px; height: 5px; border-radius: 50%; background: rgba(255,255,255,.5); flex-shrink: 0; }
@keyframes marqueeScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }

/* ══════════════════════════════════════
   WHO WE ARE — PREMIUM REDESIGN
══════════════════════════════════════ */
.who-section {
  background: var(--cream);
  padding: 4rem 2rem;
  position: relative;
  overflow: hidden;
}

.who-container {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.who-grid {
  display: grid;
  grid-template-columns: 43% 57%;
  gap: 4.5rem;
  align-items: center;
}

/* Left Column: Human-Centered Image */
@keyframes bounceScroll {
  0% { transform: translateY(0); }
  25% { transform: translateY(-15px); }
  50% { transform: translateY(0); }
  75% { transform: translateY(-8px); }
  100% { transform: translateY(0); }
}

.who-image-box {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.07);
  aspect-ratio: 16 / 9;
  background: var(--light);
}

.who-image-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s var(--ease);
}

.who-image-box.reveal-left.visible img {
  animation: bounceScroll 1.2s ease-out;
}

.who-image-box:hover img {
  transform: scale(1.03);
}

.who-description-accent {
  border-left: 4px solid var(--orange);
  padding-left: 20px;
}

.who-image-bg-glow {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 120%;
  height: 120%;
  background: radial-gradient(circle, rgba(107, 143, 26, 0.05) 0%, transparent 65%);
  z-index: -1;
  pointer-events: none;
}

/* Right Column: Premium Content */
.who-content-block {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.who-eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--green);
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 10px;
}

.who-eyebrow::before {
  content: '';
  width: 20px;
  height: 2px;
  background: currentColor;
  flex-shrink: 0;
}

.who-heading {
  font-family: var(--font-h);
  font-size: clamp(2.2rem, 3.8vw, 3rem);
  font-weight: 900;
  color: var(--black);
  line-height: 1.15;
  margin-bottom: 1.5rem;
  letter-spacing: -1px;
}

.who-heading span {
  color: var(--green);
}

.who-description {
  font-size: 1rem;
  font-weight: 300;
  line-height: 1.85;
  color: var(--charcoal);
  max-width: 600px;
  margin-bottom: 2.5rem;
}

/* Feature grid */
.who-features {
  display: grid;
  grid-template-columns: 1fr;
  gap: 0.75rem;
  width: 100%;
}

.who-feature-card {
  background: transparent;
  border: 1px solid transparent;
  border-radius: 0;
  padding: 1.25rem 0;
  display: flex;
  gap: 1.1rem;
  transition: border-color 0.3s ease, transform 0.3s ease;
}

.who-feature-card:hover {
  border-bottom: 1px solid rgba(107, 143, 26, 0.4);
}

.who-feature-icon-wrapper {
  color: var(--green);
  background: rgba(107, 143, 26, 0.07);
  width: 44px;
  height: 44px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: transform 0.45s var(--ease-spring);
}

.who-feature-icon-wrapper .lucide {
  width: 20px;
  height: 20px;
}

.who-feature-card:hover .who-feature-icon-wrapper {
  transform: perspective(100px) rotateX(-5deg) rotateY(10deg) scale(1.12);
  box-shadow: 2px 4px 12px rgba(107, 143, 26, 0.15);
}

.who-feature-info h4 {
  font-family: var(--font-h);
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--black);
  margin-bottom: 0.35rem;
}

.who-feature-info p {
  font-size: 0.85rem;
  font-weight: 300;
  color: var(--charcoal);
  line-height: 1.6;
}

/* Learn More Button */
.who-learn-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 0.75rem 1.5rem;
  font-size: 0.95rem;
  font-weight: 600;
  color: var(--green);
  border: 1.5px solid var(--green);
  border-radius: 6px;
  text-decoration: none;
  transition: all 0.3s ease;
  letter-spacing: 0.3px;
}

.who-learn-btn:hover {
  background: var(--green);
  color: #fff;
  gap: 10px;
}

/* ── RESPONSIVE OVERRIDES ── */
@media(max-width: 1024px) {
  .who-section {
    padding: 3.5rem 2rem;
  }
  .who-grid {
    grid-template-columns: 1fr;
    gap: 3.5rem;
  }
  .who-image-box {
    max-width: 500px;
    margin: 0 auto;
    aspect-ratio: 16 / 10;
  }
  .who-content-block {
    align-items: center;
    text-align: center;
  }
  .who-eyebrow {
    justify-content: center;
  }
  .who-description {
    margin-left: auto;
    margin-right: auto;
  }
}

@media(max-width: 640px) {
  .who-section {
    padding: 3rem 1.25rem;
  }
  .who-features {
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }
  .who-feature-card {
    text-align: left;
  }
}


/* ══════════════════════════════════════
   SERVICES
══════════════════════════════════════ */
.svc-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem; margin-top: 3.5rem;
}
.svc-card {
  background: var(--white); border: 1px solid var(--mid);
  border-radius: 12px; padding: 2rem;
  position: relative; overflow: hidden;
  transition: transform .3s var(--ease), box-shadow .3s var(--ease), border-color .3s var(--ease);
  cursor: default;
}
.svc-card::before {
  content: ''; position: absolute; inset: 0;
  background: linear-gradient(135deg, rgba(216,45,55,.04), transparent 60%);
  opacity: 0; transition: opacity .3s;
}
.svc-card:hover { transform: translateY(-6px); box-shadow: 0 20px 50px rgba(0,0,0,.1); border-color: rgba(216,45,55,.25); }
.svc-card:hover::before { opacity: 1; }
.svc-icon {
  width: 52px; height: 52px; border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.4rem; margin-bottom: 1.25rem; flex-shrink: 0;
  transition: transform .3s ease;
}
.svc-card:hover .svc-icon { transform: scale(1.1); }
.si-r { background: rgba(216,45,55,.1); color: var(--red); }
.si-o { background: rgba(229,105,24,.1); color: var(--orange); }
.si-g { background: rgba(107,143,26,.1); color: var(--green); }
.svc-num {
  position: absolute; top: 1.5rem; right: 1.5rem;
  font-family: var(--font-h); font-size: 2.5rem; font-weight: 900;
  color: var(--light); line-height: 1; user-select: none;
}
.svc-card h3 { font-family: var(--font-h); font-size: 1.1rem; font-weight: 700; color: var(--black); margin-bottom: .6rem; }
.svc-card p { font-size: .87rem; font-weight: 300; line-height: 1.8; color: var(--charcoal); }
.svc-more {
  display: inline-flex; align-items: center; gap: 6px; margin-top: 1.25rem;
  font-size: 12px; font-weight: 700; color: var(--red);
  letter-spacing: .5px; text-transform: uppercase; transition: gap .2s;
}
.svc-card:hover .svc-more { gap: 10px; }

/* ══════════════════════════════════════
   IMPACT NUMBERS
══════════════════════════════════════ */
.impact-sec {
  background: var(--black); padding: 5rem 2rem; position: relative; overflow: hidden;
}
.impact-sec::before {
  content: ''; position: absolute; inset: 0;
  background: radial-gradient(ellipse 80% 60% at 50% 100%, rgba(216,45,55,.12), transparent 70%);
}
.impact-grid {
  display: grid; grid-template-columns: repeat(4, 1fr);
  gap: 2px; background: rgba(255,255,255,.06);
  position: relative; z-index: 1; border-radius: 12px; overflow: hidden;
}
.impact-item {
  background: var(--black); padding: 3rem 2rem; text-align: center;
  border: none; transition: background .3s;
}
.impact-item:hover { background: rgba(255,255,255,.03); }
.impact-num {
  font-family: var(--font-h); font-size: 3.2rem; font-weight: 900;
  line-height: 1; margin-bottom: .5rem;
}
.impact-num.in-r { color: var(--red); }
.impact-num.in-o { color: var(--orange); }
.impact-num.in-g { color: #8fc430; }
.impact-num.in-w { color: #fff; }
.impact-label { font-size: .85rem; font-weight: 400; color: rgba(255,255,255,.4); letter-spacing: .3px; }

/* ══════════════════════════════════════
   TESTIMONIALS
══════════════════════════════════════ */
.testi-sec { background: var(--cream); padding: 5.5rem 2rem; }
.testi-slider { position: relative; overflow: hidden; margin-top: 3rem; }
.testi-track { display: flex; transition: transform .55s var(--ease); }
.tcard { min-width: 100%; padding: 0 1rem; box-sizing: border-box; }
.tcard-inner {
  background: #fff; border-radius: 16px; padding: 2.75rem;
  max-width: 680px; margin: 0 auto;
  box-shadow: 0 8px 48px rgba(0,0,0,.07); position: relative;
}
.tcard-quote { font-family: var(--font-h); font-size: 5rem; color: var(--light); line-height: .7; margin-bottom: 1rem; user-select: none; }
.tcard-text { font-size: 1.1rem; font-weight: 300; font-style: italic; line-height: 1.85; color: var(--charcoal); margin-bottom: 2rem; }
.tcard-au { display: flex; align-items: center; gap: 14px; }
.au-av {
  width: 46px; height: 46px; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-h); font-size: 15px; font-weight: 700; color: #fff; flex-shrink: 0;
}
.av-r { background: linear-gradient(135deg, var(--red), #f04050); }
.av-g { background: linear-gradient(135deg, var(--green), #8fc430); }
.av-o { background: linear-gradient(135deg, var(--orange), #f59e0b); }
.au-name { font-size: 14px; font-weight: 600; color: var(--black); }
.au-role { font-size: 12px; color: var(--charcoal); opacity: .55; margin-top: 2px; }
.tcard-accent { position: absolute; bottom: 0; left: 0; right: 0; height: 4px; border-radius: 0 0 16px 16px; }
.ta-r { background: linear-gradient(90deg, var(--red), #f04050); }
.ta-g { background: linear-gradient(90deg, var(--green), #8fc430); }
.ta-o { background: linear-gradient(90deg, var(--orange), #f59e0b); }
.testi-controls { display: flex; justify-content: center; align-items: center; gap: 1rem; margin-top: 2rem; }
.testi-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--mid); cursor: pointer; transition: all .25s; border: none; padding: 0; }
.testi-dot.act { background: var(--red); transform: scale(1.3); }
.testi-arrow {
  width: 40px; height: 40px; border-radius: 50%; border: 1.5px solid var(--mid);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer; transition: all .2s; background: transparent;
  color: var(--charcoal); font-size: 1.1rem;
}
.testi-arrow:hover { background: var(--red); border-color: var(--red); color: #fff; }

/* ══════════════════════════════════════
   CTA SECTION
══════════════════════════════════════ */
.cta-sec {
  background: var(--black); padding: 6rem 2rem;
  text-align: center; position: relative; overflow: hidden;
}
.cta-sec::before {
  content: ''; position: absolute;
  top: 50%; left: 50%; transform: translate(-50%, -50%);
  width: 800px; height: 400px; border-radius: 50%;
  background: radial-gradient(ellipse, rgba(216,45,55,.2) 0%, transparent 70%);
}
.cta-sec::after {
  content: ''; position: absolute; inset: 0;
  border-top: 1px solid rgba(255,255,255,.05);
  border-bottom: 1px solid rgba(255,255,255,.05);
}
.cta-sec h2 {
  font-family: var(--font-h); color: #fff;
  font-size: clamp(2.2rem, 4vw, 3.2rem); font-weight: 900;
  margin-bottom: 1rem; position: relative; z-index: 1;
  letter-spacing: -1px; line-height: 1.1;
}
.cta-sec p {
  color: rgba(255,255,255,.55); font-size: 1.05rem; font-weight: 300;
  max-width: 460px; margin: 0 auto 2.5rem;
  position: relative; z-index: 1; line-height: 1.85;
}
.cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; position: relative; z-index: 1; }

/* ══════════════════════════════════════
   RESPONSIVE - REST OF PAGE
══════════════════════════════════════ */
@media (max-width: 1024px) {
  .svc-grid { grid-template-columns: repeat(2, 1fr); }
  .impact-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 768px) {
  .marquee-item { padding: 0 1.5rem; font-size: 11px; }
  .svc-grid { grid-template-columns: 1fr; }
  .impact-grid { grid-template-columns: 1fr; }
}

@media (max-width: 640px) {
  .svc-grid { grid-template-columns: 1fr; }
  .impact-grid { grid-template-columns: 1fr 1fr; }
}

/* ── FOUNDER SECTION ── */
.founder-sec {
  background: var(--cream);
  padding: 6rem 2rem;
  overflow: hidden;
}
.founder-card {
  display: grid;
  grid-template-columns: 1fr 1.3fr;
  gap: 4.5rem;
  align-items: center;
  background: #fff;
  border-radius: 24px;
  padding: 3.5rem;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.02);
  position: relative;
}
.founder-image-area {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}
.founder-glow-sphere {
  position: absolute;
  width: 250px;
  height: 250px;
  background: radial-gradient(circle, rgba(229,105,24,0.18) 0%, transparent 70%);
  z-index: 1;
  pointer-events: none;
}
.founder-img-wrapper {
  position: relative;
  width: 100%;
  max-width: 300px;
  border-radius: 20px;
  padding: 8px;
  background: rgba(0, 0, 0, 0.02);
  border: 1px solid rgba(0, 0, 0, 0.05);
  z-index: 2;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
}
.founder-portrait-img {
  width: 100%;
  height: auto;
  border-radius: 14px;
  display: block;
  object-fit: cover;
  aspect-ratio: 4/5;
}
.founder-badge {
  position: absolute;
  bottom: -15px;
  left: 50%;
  transform: translateX(-50%);
  background: linear-gradient(135deg, var(--red), var(--orange));
  color: #fff;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 6px 16px;
  border-radius: 100px;
  box-shadow: 0 6px 20px rgba(216, 45, 55, 0.25);
  white-space: nowrap;
  font-family: var(--font-h);
}
.founder-content-area {
  display: flex;
  flex-direction: column;
}
.founder-eyebrow {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--orange);
  margin-bottom: 0.75rem;
}
.founder-title {
  font-family: var(--font-h);
  font-size: 2.2rem;
  font-weight: 900;
  color: var(--black);
  line-height: 1.1;
  letter-spacing: -1px;
  margin-bottom: 0.5rem;
}
.founder-credentials {
  font-family: var(--font-b);
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 1.5px;
  color: var(--charcoal);
  opacity: 0.7;
  margin-bottom: 1.5rem;
  text-transform: uppercase;
}
.founder-bio {
  font-size: 0.95rem;
  font-weight: 300;
  line-height: 1.85;
  color: var(--charcoal);
  margin-bottom: 1rem;
}
.founder-bio:last-of-type {
  margin-bottom: 2rem;
}
.founder-footer {
  display: flex;
  align-items: center;
}
.founder-linkedin-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #0077b5;
  color: #fff;
  font-size: 13px;
  font-weight: 600;
  padding: 10px 20px;
  border-radius: 8px;
  text-decoration: none;
  transition: background 0.2s, transform 0.2s;
  box-shadow: 0 4px 15px rgba(0, 119, 181, 0.2);
}
.founder-linkedin-btn:hover {
  background: #006097;
  transform: translateY(-2px);
}
.linkedin-svg {
  width: 16px;
  height: 16px;
  fill: currentColor;
}

/* ── PACKAGE STEPS ── */
.package-sec{background:var(--white);padding:6rem 2rem}
.steps-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:1.5rem;margin-top:3rem}
.step-card{
  background: #fff;
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
  font-family:var(--font-ui);font-size:1rem;font-weight:700;color:#fff;
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

@media(max-width:960px){
  .steps-grid{grid-template-columns:1fr 1fr}
  .founder-card {
    grid-template-columns: 1fr;
    gap: 3rem;
    padding: 2.5rem;
  }
  .founder-image-area {
    margin-bottom: 1rem;
  }
}
/* ── TSCC HIGHLIGHT SECTION ── */
.tscc-highlight-sec {
  background: var(--black);
  padding: 6.5rem 2rem;
  position: relative;
  overflow: hidden;
}
.tscc-highlight-sec::before {
  content: ''; position: absolute;
  top: 0; right: 0; width: 450px; height: 450px;
  background: radial-gradient(circle, rgba(229,105,24,0.15) 0%, transparent 70%);
  pointer-events: none;
}
.tscc-highlight-sec::after {
  content: ''; position: absolute;
  bottom: 0; left: 0; width: 350px; height: 350px;
  background: radial-gradient(circle, rgba(216,45,55,0.1) 0%, transparent 70%);
  pointer-events: none;
}
.tscc-highlight-grid {
  display: grid;
  grid-template-columns: 1fr 1.1fr;
  gap: 5rem;
  align-items: center;
  position: relative;
  z-index: 5;
}
.tscc-highlight-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(229,105,24,0.12);
  border: 1px solid rgba(229,105,24,0.25);
  color: var(--orange);
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  padding: 6px 14px;
  border-radius: 100px;
  margin-bottom: 1.5rem;
}
.tscc-highlight-badge-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--orange);
  animation: badgePulse 2s infinite;
}
.tscc-highlight-sec h2 {
  font-family: var(--font-h);
  font-size: clamp(2.2rem, 4.5vw, 3.2rem);
  font-weight: 900;
  color: #fff;
  line-height: 1.1;
  letter-spacing: -1.5px;
  margin-bottom: 1.5rem;
}
.tscc-highlight-sec h2 span {
  background: linear-gradient(135deg, var(--orange), var(--red));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.tscc-highlight-text {
  color: rgba(255, 255, 255, 0.65);
  font-size: 1rem;
  font-weight: 300;
  line-height: 1.8;
  margin-bottom: 2rem;
}
.tscc-feature-list {
  display: flex;
  flex-direction: column;
  gap: 1.25rem;
  margin-bottom: 2.5rem;
}
.tscc-feature-item {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
}
.tscc-feature-icon {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--orange);
  flex-shrink: 0;
}
.tscc-feature-icon .lucide {
  width: 18px;
  height: 18px;
  stroke-width: 2.25;
}
.tscc-feature-info h4 {
  font-family: var(--font-h);
  font-size: 1.05rem;
  font-weight: 700;
  color: #fff;
  margin-bottom: 0.25rem;
}
.tscc-feature-info p {
  font-size: 0.88rem;
  font-weight: 300;
  color: rgba(255, 255, 255, 0.5);
  line-height: 1.5;
}
.tscc-visual-card {
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 24px;
  padding: 3rem;
  text-align: center;
  position: relative;
  overflow: hidden;
  box-shadow: 0 30px 60px rgba(0, 0, 0, 0.25);
  backdrop-filter: blur(12px);
  transform-style: preserve-3d;
  transition: transform 0.5s var(--ease);
}
.tscc-visual-card:hover {
  transform: translateY(-8px);
  border-color: rgba(229, 105, 24, 0.2);
}
.tscc-visual-accent {
  position: absolute;
  top: -50px;
  left: 50%;
  transform: translateX(-50%);
  width: 150px;
  height: 150px;
  background: radial-gradient(circle, rgba(229,105,24,0.3) 0%, transparent 70%);
  pointer-events: none;
}
.tscc-visual-year {
  font-family: var(--font-h);
  font-size: 5.5rem;
  font-weight: 900;
  color: rgba(255, 255, 255, 0.05);
  line-height: 1;
  letter-spacing: -2px;
  margin-bottom: 0.5rem;
  user-select: none;
}
.tscc-visual-title {
  font-family: var(--font-h);
  font-size: 1.8rem;
  font-weight: 800;
  color: #fff;
  margin-bottom: 0.5rem;
}
.tscc-visual-subtitle {
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 2px;
  color: var(--orange);
  text-transform: uppercase;
  margin-bottom: 2rem;
}
.tscc-visual-stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  padding-top: 2rem;
}
.tscc-stat-box h5 {
  font-family: var(--font-h);
  font-size: 1.6rem;
  font-weight: 900;
  color: #fff;
  margin-bottom: 0.25rem;
}
.tscc-stat-box p {
  font-size: 10px;
  font-weight: 600;
  letter-spacing: 0.5px;
  color: rgba(255, 255, 255, 0.4);
  text-transform: uppercase;
}
@media (max-width: 960px) {
  .tscc-highlight-grid {
    grid-template-columns: 1fr;
    gap: 3.5rem;
  }
}
</style>
@endsection

@section('content')

<!-- ══ HERO ══ -->
<section class="hero" aria-label="TREC Hero Section">

  <!-- Overlays -->
  <div class="hero-overlay-l" aria-hidden="true"></div>
  <div class="hero-overlay-b" aria-hidden="true"></div>
  <div class="hero-overlay-t" aria-hidden="true"></div>

  <!-- Ripple rings -->
  <div class="hero-ripples" aria-hidden="true">
    <div class="rr"></div><div class="rr"></div><div class="rr"></div>
    <div class="rr"></div><div class="rr"></div><div class="rr"></div>
  </div>

  <div class="hero-inner">

    <!-- ══ LEFT: CONTENT PANEL ══ -->
    <div class="hero-content-panel">

      <div class="hero-welcome-pill reveal">
        <span class="hw-dot"></span>
        Creating Ripples of Change Since 2017
      </div>

      <div class="hero-brand-statement reveal" style="transition-delay:.08s">
        People. Purpose. Impact.
      </div>

      <h1 class="hero-headline reveal" style="transition-delay:.14s">
        Transform Lives,<br>
        <span class="hl-accent">Build</span><br>
        <span class="hl-green">Futures</span>
      </h1>

      <p class="hero-supporting reveal" style="transition-delay:.20s">
        Helping individuals, schools, parents, and organisations build healthier minds, stronger relationships, and lasting impact.
      </p>

      <blockquote class="hero-quote reveal" style="transition-delay:.26s">
        "At TREC, we believe one conversation can change a life, one intervention can transform a school, and one ripple can impact an entire community."
      </blockquote>

      <div class="hero-ctas reveal" style="transition-delay:.32s">
        <a href="{{ route('contact') }}" id="hero-book-btn" class="btn-hero-primary">
          Book a Consultation <span class="btn-arrow">→</span>
        </a>
        <a href="{{ route('services') }}" id="hero-services-btn" class="btn-hero-secondary">
          Explore Services
        </a>
      </div>

      <div class="hero-trust reveal" style="transition-delay:.38s">
        <div class="trust-item"><span class="trust-check">✓</span><span>500+ Individuals Supported</span></div>
        <div class="trust-item"><span class="trust-check">✓</span><span>over 10 Schools Partnered</span></div>
        <div class="trust-item"><span class="trust-check">✓</span><span>2020 Established</span></div>
        <div class="trust-item"><span class="trust-check">✓</span><span>@php echo date('m') > 8 ? date('Y') - 2025 + 1 : date('Y') - 2025; @endphp TSCC Conducted</span></div>
      </div>

    </div><!-- /hero-content-panel -->

    <!-- ══ RIGHT: SVG NETWORK ANIMATION ══ -->
    <div class="hero-network reveal" style="transition-delay:.15s" aria-label="TREC Services Network Diagram">
      <svg viewBox="0 0 520 540" xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true">
        <defs>
          <!-- Hub gradient -->
          <radialGradient id="hubGrad" cx="50%" cy="50%" r="50%">
            <stop offset="0%"  stop-color="#e8334a"/>
            <stop offset="100%" stop-color="#c02030"/>
          </radialGradient>
          <!-- Node gradients -->
          <linearGradient id="ng1" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#1e2235"/><stop offset="100%" stop-color="#252840"/></linearGradient>
          <linearGradient id="ng2" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#1e2a20"/><stop offset="100%" stop-color="#1f3022"/></linearGradient>
          <linearGradient id="ng3" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#2d1e20"/><stop offset="100%" stop-color="#361e21"/></linearGradient>
          <linearGradient id="ng4" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#1e2235"/><stop offset="100%" stop-color="#252840"/></linearGradient>
          <linearGradient id="ng5" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#1a2a1e"/><stop offset="100%" stop-color="#1f3022"/></linearGradient>
          <linearGradient id="ng6" x1="0" y1="0" x2="1" y2="1"><stop offset="0%" stop-color="#2d2215"/><stop offset="100%" stop-color="#382a18"/></linearGradient>
          <!-- Glow filter -->
          <filter id="glow" x="-30%" y="-30%" width="160%" height="160%">
            <feGaussianBlur stdDeviation="3.5" result="blur"/>
            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
          </filter>
          <filter id="hubGlow" x="-50%" y="-50%" width="200%" height="200%">
            <feGaussianBlur stdDeviation="8" result="blur"/>
            <feMerge><feMergeNode in="blur"/><feMergeNode in="SourceGraphic"/></feMerge>
          </filter>
        </defs>

        <!-- ── TENTACLE LINES ── -->
        <!-- Line to: Counselling Department Set Up (top-left) -->
        <line class="tentacle t1" x1="260" y1="270" x2="100" y2="105"
          stroke="rgba(216,45,55,0.55)" stroke-width="1.8"/>
        <!-- Line to: Curriculum Development (top-right) -->
        <line class="tentacle t2" x1="260" y1="270" x2="420" y2="110"
          stroke="rgba(107,143,26,0.55)" stroke-width="1.8"/>
        <!-- Line to: TSCC & Strategic Events (right) -->
        <line class="tentacle t3" x1="260" y1="270" x2="460" y2="275"
          stroke="rgba(229,105,24,0.55)" stroke-width="1.8"/>
        <!-- Line to: Wellbeing Package (bottom-right) -->
        <line class="tentacle t4" x1="260" y1="270" x2="410" y2="430"
          stroke="rgba(216,45,55,0.55)" stroke-width="1.8"/>
        <!-- Line to: Training & Capacity Building (bottom-left) -->
        <line class="tentacle t5" x1="260" y1="270" x2="100" y2="435"
          stroke="rgba(107,143,26,0.55)" stroke-width="1.8"/>
        <!-- Line to: Needs Assessment (left) -->
        <line class="tentacle t6" x1="260" y1="270" x2="55" y2="275"
          stroke="rgba(229,105,24,0.55)" stroke-width="1.8"/>

        <!-- ── HUB — Center Circle ── -->
        <!-- Outer pulse rings -->
        <circle class="hub-pulse"  cx="260" cy="270" r="52" fill="none" stroke="rgba(216,45,55,0.18)" stroke-width="1.5"/>
        <circle class="hub-pulse2" cx="260" cy="270" r="38" fill="none" stroke="rgba(216,45,55,0.30)" stroke-width="1.5"/>
        <!-- Hub body -->
        <circle cx="260" cy="270" r="58" fill="rgba(216,45,55,0.12)" filter="url(#hubGlow)"/>
        <circle cx="260" cy="270" r="50" fill="url(#hubGrad)" filter="url(#hubGlow)"/>
        <circle cx="260" cy="270" r="50" fill="none" stroke="rgba(255,255,255,0.20)" stroke-width="1.5"/>
        <!-- Hub text -->
        <text x="260" y="264" text-anchor="middle" dominant-baseline="middle"
          font-family="Georgia,serif" font-size="15" font-weight="900" fill="#fff" letter-spacing="2">
          TREC
        </text>
        <text x="260" y="281" text-anchor="middle" dominant-baseline="middle"
          font-family="sans-serif" font-size="8.5" font-weight="400" fill="rgba(255,255,255,0.70)" letter-spacing="1">
          OUR SERVICES
        </text>

        <!-- ══ SERVICE NODES ══ -->

        <!-- 1 ── Counselling Department Set Up (top-left) -->
        <a href="{{ route('services.dept-setup') }}" class="service-node-link">
          <g class="nf1" filter="url(#glow)">
            <rect x="18" y="68" width="168" height="72" rx="14" fill="url(#ng1)" stroke="rgba(216,45,55,0.55)" stroke-width="1.5"/>
            <rect x="18" y="68" width="6" height="72" rx="3" fill="#D82D37"/>
            <g transform="translate(28, 85)"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="rgba(216,45,55,0.90)" stroke-width="2"><path d="M12 2H2v20h20V12"/><path d="M2 12h20M12 2v20"/><circle cx="17" cy="7" r="2"/></svg></g>
            <text x="48" y="95" font-family="sans-serif" font-size="9" font-weight="700" fill="rgba(216,45,55,0.90)" letter-spacing="1">DEPARTMENT</text>
            <text x="32" y="113" font-family="sans-serif" font-size="12" font-weight="700" fill="#ffffff">Counselling</text>
            <text x="32" y="129" font-family="sans-serif" font-size="12" font-weight="700" fill="#ffffff">Set Up</text>
          </g>
        </a>
        <circle class="conn-dot" cx="100" cy="105" r="4" fill="#D82D37"/>

        <!-- 2 ── Counselling Curriculum Development (top-right) -->
        <a href="{{ route('services.curriculum') }}" class="service-node-link">
          <g class="nf2" filter="url(#glow)">
            <rect x="336" y="68" width="166" height="72" rx="14" fill="url(#ng2)" stroke="rgba(107,143,26,0.55)" stroke-width="1.5"/>
            <rect x="496" y="68" width="6" height="72" rx="3" fill="#6b8f1a"/>
            <g transform="translate(348, 85)"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="rgba(107,143,26,0.90)" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg></g>
            <text x="356" y="95" font-family="sans-serif" font-size="9" font-weight="700" fill="rgba(107,143,26,0.90)" letter-spacing="1">CURRICULUM</text>
            <text x="348" y="113" font-family="sans-serif" font-size="12" font-weight="700" fill="#ffffff">Curriculum</text>
            <text x="348" y="129" font-family="sans-serif" font-size="12" font-weight="700" fill="#ffffff">Development</text>
          </g>
        </a>
        <circle class="conn-dot" cx="420" cy="110" r="4" fill="#6b8f1a"/>

        <!-- 3 ── TSCC and Strategic Education Events (right) -->
        <a href="{{ route('tscc') }}" class="service-node-link">
          <g class="nf3" filter="url(#glow)">
            <rect x="340" y="238" width="166" height="72" rx="14" fill="url(#ng3)" stroke="rgba(229,105,24,0.55)" stroke-width="1.5"/>
            <rect x="500" y="238" width="6" height="72" rx="3" fill="#E56918"/>
            <g transform="translate(352, 255)"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="rgba(229,105,24,0.90)" stroke-width="2"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/></svg></g>
            <text x="368" y="265" font-family="sans-serif" font-size="9" font-weight="700" fill="rgba(229,105,24,0.90)" letter-spacing="1">TSCC</text>
            <text x="352" y="283" font-family="sans-serif" font-size="12" font-weight="700" fill="#ffffff">TSCC &</text>
            <text x="352" y="299" font-family="sans-serif" font-size="12" font-weight="700" fill="#ffffff">Events</text>
          </g>
        </a>
        <circle class="conn-dot" cx="460" cy="275" r="4" fill="#E56918"/>

        <!-- 4 ── School Management Wellbeing Package (bottom-right) -->
        <a href="{{ route('services.wellbeing') }}" class="service-node-link">
          <g class="nf4" filter="url(#glow)">
            <rect x="330" y="398" width="168" height="72" rx="14" fill="url(#ng4)" stroke="rgba(216,45,55,0.55)" stroke-width="1.5"/>
            <rect x="492" y="398" width="6" height="72" rx="3" fill="#D82D37"/>
            <g transform="translate(342, 415)"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="rgba(216,45,55,0.90)" stroke-width="2"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></g>
            <text x="362" y="425" font-family="sans-serif" font-size="9" font-weight="700" fill="rgba(216,45,55,0.90)" letter-spacing="1">PACKAGE</text>
            <text x="338" y="443" font-family="sans-serif" font-size="11" font-weight="700" fill="#ffffff">Wellbeing</text>
            <text x="338" y="459" font-family="sans-serif" font-size="11" font-weight="700" fill="#ffffff">Package</text>
          </g>
        </a>
        <circle class="conn-dot" cx="410" cy="430" r="4" fill="#D82D37"/>

        <!-- 5 ── Training and Capacity Building (bottom-left) -->
        <a href="{{ route('services.training') }}" class="service-node-link">
          <g class="nf5" filter="url(#glow)">
            <rect x="20" y="398" width="166" height="72" rx="14" fill="url(#ng5)" stroke="rgba(107,143,26,0.55)" stroke-width="1.5"/>
            <rect x="20" y="398" width="6" height="72" rx="3" fill="#6b8f1a"/>
            <g transform="translate(30, 415)"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="rgba(107,143,26,0.90)" stroke-width="2"><path d="M4 4h16v2H4zM4 10h16v2H4zM4 16h16v2H4z"/><circle cx="2" cy="5" r="1.5"/><circle cx="2" cy="11" r="1.5"/><circle cx="2" cy="17" r="1.5"/></svg></g>
            <text x="44" y="425" font-family="sans-serif" font-size="9" font-weight="700" fill="rgba(107,143,26,0.90)" letter-spacing="1">TRAINING</text>
            <text x="32" y="443" font-family="sans-serif" font-size="11" font-weight="700" fill="#ffffff">Training &</text>
            <text x="24" y="459" font-family="sans-serif" font-size="11" font-weight="700" fill="#ffffff">Capacity Build</text>
          </g>
        </a>
        <circle class="conn-dot" cx="100" cy="435" r="4" fill="#6b8f1a"/>

        <!-- 6 ── Needs Assessment (left) -->
        <a href="{{ route('services.needs-assessment') }}" class="service-node-link">
          <g class="nf6" filter="url(#glow)">
            <rect x="0" y="238" width="110" height="72" rx="14" fill="url(#ng6)" stroke="rgba(229,105,24,0.55)" stroke-width="1.5"/>
            <rect x="0" y="238" width="6" height="72" rx="3" fill="#E56918"/>
            <g transform="translate(8, 255)"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="rgba(229,105,24,0.90)" stroke-width="2"><path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/><path d="M20.354 15.354l-7.07-7.07a2.828 2.828 0 1 0-4 4l7.07 7.07a2.828 2.828 0 1 0 4-4z"/></svg></g>
            <text x="18" y="270" font-family="sans-serif" font-size="9" font-weight="700" fill="rgba(229,105,24,0.90)" letter-spacing="0.5">ASSESS</text>
            <text x="12" y="288" font-family="sans-serif" font-size="11.5" font-weight="700" fill="#ffffff">Needs</text>
            <text x="12" y="304" font-family="sans-serif" font-size="11.5" font-weight="700" fill="#ffffff">Assessment</text>
          </g>
        </a>
        <circle class="conn-dot" cx="55" cy="275" r="4" fill="#E56918"/>

      </svg>
    </div><!-- /hero-network -->

  </div><!-- /hero-inner -->

  <div class="hero-scroll-cue" aria-hidden="true">
    <div class="scroll-mouse-light"><div class="scroll-dot-light"></div></div>
    <span>Scroll</span>
  </div>

</section>

<!-- ══ MARQUEE STRIP ══ -->
<div class="marquee-strip" aria-hidden="true">
  <div class="marquee-track">
    <div class="marquee-item">500+ Individuals Supported</div>
    <div class="marquee-item">over 10 Schools Partnered</div>
    <div class="marquee-item">2020 Established</div>
    <div class="marquee-item">@php echo date('m') > 8 ? date('Y') - 2020 + 1 : date('Y') - 2020; @endphp TSCC Conducted</div>
    <div class="marquee-item">Trusted by Organisations Nationwide</div>
    <div class="marquee-item">Proven Results · Real Impact</div>
    <div class="marquee-item">500+ Individuals Supported</div>
    <div class="marquee-item">over 10 Schools Partnered</div>
    <div class="marquee-item">2020 Established</div>
    <div class="marquee-item">@php echo date('m') > 8 ? date('Y') - 2020 + 1 : date('Y') - 2020; @endphp TSCC Conducted</div>
    <div class="marquee-item">Trusted by Organisations Nationwide</div>
    <div class="marquee-item">Proven Results · Real Impact</div>
  </div>
</div>

<!-- ══ WHO WE ARE ══ -->
<section class="who-section" aria-label="Who We Are">
  <div class="who-image-bg-glow"></div>
  <div class="who-container">
    <div class="who-grid">
      
      <!-- Left Column: Content Block -->
      <div class="who-content-block">
        <div class="who-eyebrow reveal-left">Who We Are</div>
        <h2 class="who-heading reveal-left" style="transition-delay: 0.1s;">
          Building Positive <span>Change</span> Through Counselling and Education
        </h2>
        <p class="who-description who-description-accent reveal-left" style="transition-delay: 0.2s;">
          At TREC, we empower individuals and organisations across Nigeria to build resilience, cultivate healthier minds, and create positive transformation through counselling and education.
        </p>
        
        <!-- Feature Highlights Grid -->
        <div class="who-features reveal-stagger" style="transition-delay: 0.3s;">
          
          <div class="who-feature-card">
            <div class="who-feature-icon-wrapper">
              <i data-lucide="heart"></i>
            </div>
            <div class="who-feature-info">
              <h4>Professional Counselling</h4>
              <p>Confidential therapy and mental health support for individuals and groups.</p>
            </div>
          </div>
          
          <div class="who-feature-card">
            <div class="who-feature-icon-wrapper">
              <i data-lucide="graduation-cap"></i>
            </div>
            <div class="who-feature-info">
              <h4>School Wellbeing Programs</h4>
              <p>Integrating emotional health frameworks directly into school culture.</p>
            </div>
          </div>
          
          <div class="who-feature-card">
            <div class="who-feature-icon-wrapper">
              <i data-lucide="users"></i>
            </div>
            <div class="who-feature-info">
              <h4>Parent & Family Support</h4>
              <p>Empowering parents to raise confident and emotionally resilient children.</p>
            </div>
          </div>
          
          <div class="who-feature-card">
            <div class="who-feature-icon-wrapper">
              <i data-lucide="briefcase"></i>
            </div>
            <div class="who-feature-info">
              <h4>Organisational Development</h4>
              <p>Bespoke training to cultivate psychologically safe and productive workplaces.</p>
            </div>
          </div>
          
        </div>
        
        <!-- Learn More Button -->
        <div class="who-cta reveal-left" style="transition-delay: 0.4s; margin-top: 2rem;">
          <a href="{{ route('about') }}" class="who-learn-btn">Learn More About Us →</a>
        </div>
      </div>
      
      <!-- Right Column: Image -->
      <div class="who-image-box reveal-right">
        <img src="{{ asset('IMG_7061.JPG') }}" alt="Professional warm counselling session at TREC office" loading="lazy">
      </div>
      
    </div>
  </div>
</section>

<!-- ══ MEET THE FOUNDER ══ -->
<section class="founder-sec reveal">
  <div class="wrap">
    <div class="founder-card">
      <div class="founder-image-area">
        <div class="founder-glow-sphere"></div>
        <div class="founder-img-wrapper" style="background: transparent; border: none; box-shadow: none;">
          <svg viewBox="0 0 120 120" class="founder-portrait-img" style="width: 100%; height: auto; border-radius: 50%; display: block; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);">
            <defs>
              <linearGradient id="avatarGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#f88923" />
                <stop offset="100%" stop-color="#d82d37" />
              </linearGradient>
              <linearGradient id="hijabGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#1f2937" />
                <stop offset="100%" stop-color="#111827" />
              </linearGradient>
              <linearGradient id="skinGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#a16207" />
                <stop offset="100%" stop-color="#78350f" />
              </linearGradient>
            </defs>
            <circle cx="60" cy="60" r="56" fill="url(#avatarGrad)" />
            <path d="M60 22 C34 22 28 36 28 64 C28 85 40 102 60 102 C80 102 92 85 92 64 C92 36 86 22 60 22 Z" fill="url(#hijabGrad)" />
            <path d="M28 80 C28 80 20 95 20 110 C20 115 100 115 100 110 C100 95 92 80 92 80 C80 95 40 95 28 80 Z" fill="url(#hijabGrad)" />
          </svg>
          <div class="founder-badge">Founder & Lead Consultant</div>
        </div>
      </div>
      <div class="founder-content-area">
        <div class="founder-eyebrow">Leadership</div>
        <h2 class="founder-title">Meet Faatimah Samuel</h2>
        <div class="founder-credentials">MCASSON, FPMC</div>
        <p class="founder-bio">
          Faatimah Samuel is the Founder and Lead Consultant at The Ripple Effect Consult (TREC). As an experienced counsellor, educational consultant, and family wellbeing advocate, she has dedicated over a decade to helping individuals, schools, and organisations build emotional resilience and psychological safety.
        </p>
        <p class="founder-bio">
          Under her leadership, TREC has grown into a multidisciplinary consultancy producing Nigeria's foremost school counselling platform — the TSCC. She is committed to bridging the gap between mental health awareness and meaningful action, ensuring that every transformation ripples outward into the community.
        </p>
        <div class="founder-footer">
          <a href="https://www.linkedin.com/in/faatimah-samuel-mcasson-fpmc-619a79173" target="_blank" class="founder-linkedin-btn" aria-label="LinkedIn Profile">
            <svg viewBox="0 0 24 24" class="linkedin-svg"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            Connect on LinkedIn
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══ THE SIX COMPONENTS ══ -->
<section class="package-sec" id="wellbeing-package">
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

<!-- ══ IMPACT NUMBERS ══ -->
<section class="impact-sec">
  <div class="wrap">
    <div class="reveal" style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow" style="justify-content:center;color:rgba(255,255,255,.4)">The Numbers</div>
      <h2 class="stitle wh">Our Ripple Effect in Numbers</h2>
    </div>
    <div class="impact-grid reveal-stagger">
      <div class="impact-item">
        <div class="impact-num in-r" data-count="500" data-suffix="+">500+</div>
        <div class="impact-label">Individuals Counselled</div>
      </div>
      <div class="impact-item">
        <div class="impact-num in-o">over 10</div>
        <div class="impact-label">Schools Partnered</div>
      </div>
      <div class="impact-item">
        <div class="impact-num in-g">@php echo date('m') > 7 ? date('Y') - 2020 + 1 : date('Y') - 2020; @endphp</div>
        <div class="impact-label">TSCC Conducted</div>
      </div>
      <div class="impact-item">
        <div class="impact-num in-w">2020</div>
        <div class="impact-label">Established</div>
      </div>
    </div>
  </div>
</section>

<!-- ══ TSCC HIGHLIGHT SECTION ══ -->
<section class="tscc-highlight-sec">
  <div class="wrap">
    <div class="tscc-highlight-grid">
      
      <!-- Left: Content -->
      <div class="reveal-left">
        <div class="tscc-highlight-badge">
          <span class="tscc-highlight-badge-dot"></span>
          Annual Strategic Event
        </div>
        <h2>The School Counselling<br><span>Conference (TSCC)</span></h2>
        <p class="tscc-highlight-text">
          TSCC is Nigeria’s premier annual conference driving sector-wide conversations, building professional capacity, and creating a community of practice for school counsellors, educators, and leaders nationwide.
        </p>
        
        <div class="tscc-feature-list">
          
          <div class="tscc-feature-item">
            <div class="tscc-feature-icon">
              <i data-lucide="mic"></i>
            </div>
            <div class="tscc-feature-info">
              <h4>Expert Keynote Speakers</h4>
              <p>Learn from leading regional and international voices in child psychology and educational leadership.</p>
            </div>
          </div>
          
          <div class="tscc-feature-item">
            <div class="tscc-feature-icon">
              <i data-lucide="award"></i>
            </div>
            <div class="tscc-feature-info">
              <h4>CPD Certified Workshops</h4>
              <p>Acquire hands-on training, practical tools, and continuous professional development (CPD) credits.</p>
            </div>
          </div>
          
          <div class="tscc-feature-item">
            <div class="tscc-feature-icon">
              <i data-lucide="network"></i>
            </div>
            <div class="tscc-feature-info">
              <h4>Advocacy & Collaboration</h4>
              <p>Connect with a powerful network of delegates, policymakers, and educational advocates.</p>
            </div>
          </div>
          
        </div>
        
        <a href="{{ route('tscc') }}" class="btn-orange" style="padding: 14px 32px; font-size: 13px;">
          Explore TSCC Conference →
        </a>
      </div>
      
      <!-- Right: Interactive Graphic -->
      <div class="reveal-right">
        <div class="tscc-visual-card">
          <div class="tscc-visual-accent"></div>
          <div class="tscc-visual-year">TSCC</div>
          <div class="tscc-visual-title">6th Annual Edition</div>
          <div class="tscc-visual-subtitle">Lagos & Hybrid Format</div>
          
          <div class="tscc-visual-stats">
            <div class="tscc-stat-box">
              <h5>400+</h5>
              <p>Delegates</p>
            </div>
            <div class="tscc-stat-box">
              <h5>over 10</h5>
              <p>School Partners</p>
            </div>
            <div class="tscc-stat-box">
              <h5>15+</h5>
              <p>CPD Sessions</p>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>

<!-- ══ TESTIMONIALS ══ -->
<section class="testi-sec">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow">Testimonials</div>
      <h2 class="stitle">What Our Clients Say</h2>
    </div>
    <div class="testi-slider reveal" style="transition-delay:.15s">
      <div class="testi-track" id="testiTrack">
        <div class="tcard">
          <div class="tcard-inner">
            <div class="tcard-quote">"</div>
            <p class="tcard-text">TREC transformed how our school approaches student wellbeing. The ripple effect we've seen across staff, students, and parents has been truly remarkable.</p>
            <div class="tcard-au">
              <div class="au-av av-r">AO</div>
              <div>
                <div class="au-name">Adaeze Okonkwo</div>
                <div class="au-role">School Principal, Lagos</div>
              </div>
            </div>
            <div class="tcard-accent ta-r"></div>
          </div>
        </div>
        <div class="tcard">
          <div class="tcard-inner">
            <div class="tcard-quote">"</div>
            <p class="tcard-text">The parenting workshop gave me tools I never had. I now understand my child's emotional world and our relationship has flourished beyond what I imagined possible.</p>
            <div class="tcard-au">
              <div class="au-av av-g">EM</div>
              <div>
                <div class="au-name">Emmanuel Musa</div>
                <div class="au-role">Parent & Workshop Participant</div>
              </div>
            </div>
            <div class="tcard-accent ta-g"></div>
          </div>
        </div>
        <div class="tcard">
          <div class="tcard-inner">
            <div class="tcard-quote">"</div>
            <p class="tcard-text">TSCC was a turning point for our NGO's approach to community mental health. World-class speakers, deep networking, and insights we still use today.</p>
            <div class="tcard-au">
              <div class="au-av av-o">FK</div>
              <div>
                <div class="au-name">Fatima Kuti</div>
                <div class="au-role">Programme Director, NGO Sector</div>
              </div>
            </div>
            <div class="tcard-accent ta-o"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="testi-controls">
      <button class="testi-arrow" id="testiPrev" aria-label="Previous">←</button>
      <button class="testi-dot act" data-i="0" aria-label="Slide 1"></button>
      <button class="testi-dot" data-i="1" aria-label="Slide 2"></button>
      <button class="testi-dot" data-i="2" aria-label="Slide 3"></button>
      <button class="testi-arrow" id="testiNext" aria-label="Next">→</button>
    </div>
  </div>
</section>

<!-- ══ CTA ══ -->
<section class="cta-sec">
  <div class="reveal">
    <h2>Ready to Create Your Ripple?</h2>
    <p>One conversation can be the beginning of lasting change — for you, your team, or your entire institution.</p>
    <div class="cta-btns">
      <a href="{{ route('contact') }}" class="btn-red" style="padding:16px 44px;font-size:15px">Book a Free Consultation</a>
      <a href="{{ route('services') }}" class="btn-ghost" style="border-color:rgba(255,255,255,.2);color:#fff;padding:16px 44px;font-size:15px">Explore Services</a>
    </div>
  </div>
</section>

<!-- ══ COMPLIANCE SECTION ══ -->
<section class="compliance-sec" style="background:var(--light);padding:3rem 2rem;text-align:center;border-top:1px solid var(--mid)">
  <div class="wrap" style="max-width:700px">
    <div class="eyebrow" style="justify-content:center;color:var(--charcoal)">Pricing Transparency</div>
    <p style="font-size:14px;color:var(--charcoal);line-height:1.7;margin-top:1rem">
      Ticket prices are displayed clearly on individual event pages.<br>
      Any applicable service fees or taxes are shown before payment is completed.
    </p>
    <div style="margin-top:1.5rem;display:flex;justify-content:center;gap:1.5rem">
      <a href="{{ route('pricing') }}" style="font-size:13px;font-weight:600;color:var(--red);text-decoration:underline">Read Pricing Policy</a>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
// ── Testimonial Carousel
let testiCurrent = 0;
const track = document.getElementById('testiTrack');
const dots = document.querySelectorAll('.testi-dot');
const total = track.children.length;
let autoTimer;

function goToSlide(n) {
  testiCurrent = (n + total) % total;
  track.style.transform = `translateX(-${testiCurrent * 100}%)`;
  dots.forEach((d, i) => d.classList.toggle('act', i === testiCurrent));
}

document.getElementById('testiNext').addEventListener('click', () => { goToSlide(testiCurrent + 1); resetAuto(); });
document.getElementById('testiPrev').addEventListener('click', () => { goToSlide(testiCurrent - 1); resetAuto(); });
dots.forEach(d => d.addEventListener('click', () => { goToSlide(parseInt(d.dataset.i)); resetAuto(); }));

function resetAuto() { clearInterval(autoTimer); autoTimer = setInterval(() => goToSlide(testiCurrent + 1), 5000); }
resetAuto();
</script>
@endsection
