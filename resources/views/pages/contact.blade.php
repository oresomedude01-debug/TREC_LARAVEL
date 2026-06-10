@extends('layouts.app')

@section('title', 'Contact TREC - Mental Health Counselling & Consultation Services')
@section('meta_desc', 'Contact TREC (The Ripple Effect Consult) for professional mental health counselling, psychological consultation, or to discuss wellness programs for your organisation.')
@section('meta_keywords', 'contact TREC, mental health counselling contact, consultation booking, reach out counselling services, contact mental health professional, counselling inquiry, mental wellness contact')
@section('og_title', 'Contact TREC - Get in Touch for Mental Health Services')
@section('og_desc', 'Contact TREC today to inquire about our mental health counselling, psychological consultation, or organisational wellness programs.')
@section('breadcrumb_title', 'Contact')

@section('styles')
<style>
/* ══════════════════════════════════════════════════════
   CONTACT PAGE — COMPLETE OVERHAUL
   TREC Nigeria | Premium UI/UX
══════════════════════════════════════════════════════ */

/* ── CSS VARIABLES ── */
:root {
  --con-red-glow:    hsla(357, 71%, 51%, 0.18);
  --con-orange-glow: hsla(27, 78%, 49%, 0.14);
  --con-green-glow:  hsla(78, 66%, 32%, 0.14);
}

/* ── HERO ── */
.con-hero {
  background: var(--cream);
  padding: 8rem 2rem 6rem;
  position: relative;
  overflow: hidden;
}
.con-hero-sphere {
  position: absolute;
  border-radius: 50%;
  pointer-events: none;
  filter: blur(70px);
  opacity: 0.55;
}
.con-hero-sphere-1 {
  width: 520px; height: 520px;
  background: var(--con-red-glow);
  top: -180px; right: -120px;
  animation: sphereFloat 8s ease-in-out infinite;
}
.con-hero-sphere-2 {
  width: 360px; height: 360px;
  background: var(--con-green-glow);
  bottom: -100px; left: -80px;
  animation: sphereFloat 11s ease-in-out infinite reverse;
}
@keyframes sphereFloat {
  0%, 100% { transform: translateY(0) scale(1); }
  50%       { transform: translateY(-24px) scale(1.05); }
}
.con-hero::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0; right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--red), var(--orange), var(--green));
}
.con-hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}
.con-hero h1 {
  font-family: var(--font-h);
  font-size: clamp(2.8rem, 5.5vw, 4.6rem);
  font-weight: 900;
  color: var(--black);
  line-height: 1.0;
  letter-spacing: -2.5px;
  margin-bottom: 1.1rem;
}
.con-hero h1 em {
  font-style: normal;
  background: linear-gradient(135deg, var(--red), var(--orange));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.con-hero p {
  font-size: 1.05rem;
  font-weight: 300;
  max-width: 540px;
  line-height: 1.95;
  color: var(--charcoal);
  margin-bottom: 2rem;
}
.con-hero-meta {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  flex-wrap: wrap;
}
.con-live-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: rgba(107, 143, 26, 0.1);
  border: 1px solid rgba(107, 143, 26, 0.25);
  color: var(--green);
  padding: 8px 16px;
  border-radius: 100px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.5px;
}
.con-live-dot {
  width: 8px; height: 8px;
  background: var(--green);
  border-radius: 50%;
  animation: livePulse 2s ease-in-out infinite;
  flex-shrink: 0;
}
@keyframes livePulse {
  0%, 100% { box-shadow: 0 0 0 0 rgba(107,143,26,0.5); }
  50%       { box-shadow: 0 0 0 6px rgba(107,143,26,0); }
}
.con-hero-stat {
  display: flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 13px;
  color: var(--charcoal);
  opacity: 0.7;
}
.con-hero-stat strong {
  font-weight: 700;
  color: var(--black);
  opacity: 1;
}

/* ── BODY LAYOUT ── */
.con-body {
  max-width: 1200px;
  margin: 0 auto;
  padding: 5rem 2rem;
  display: grid;
  grid-template-columns: 1fr 1.65fr;
  gap: 5rem;
  align-items: start;
}

/* ── LEFT SIDEBAR ── */
.con-sidebar {}
.con-sidebar-heading {
  font-family: var(--font-h);
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--black);
  margin-bottom: 1.5rem;
  padding-bottom: 0.75rem;
  border-bottom: 2px solid var(--mid);
}

/* Info Cards */
.ci-item {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
  align-items: flex-start;
  background: var(--white);
  padding: 1.2rem;
  border-radius: 16px;
  border: 1px solid var(--mid);
  box-shadow: 0 2px 16px rgba(0,0,0,0.025);
  transition: all 0.3s var(--ease);
  text-decoration: none;
}
.ci-item:hover {
  transform: translateY(-3px);
  border-color: rgba(216, 45, 55, 0.2);
  box-shadow: 0 8px 28px rgba(0,0,0,0.06);
}
.ci-item:hover .ci-icon { transform: scale(1.1) rotate(-5deg); }
.ci-icon {
  width: 46px; height: 46px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: transform 0.3s var(--ease-spring);
}
.ci-icon .lucide { width: 20px; height: 20px; stroke-width: 1.75; }
.ci-r { background: rgba(216,45,55,.1); color: var(--red); }
.ci-o { background: rgba(229,105,24,.1); color: var(--orange); }
.ci-g { background: rgba(107,143,26,.1); color: var(--green); }
.ci-b { background: rgba(65,64,66,.08);  color: var(--charcoal); }
.ci-text strong {
  display: block;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--charcoal);
  margin-bottom: 3px;
  opacity: 0.5;
}
.ci-text p, .ci-text a {
  font-size: 13px;
  font-weight: 400;
  color: var(--charcoal);
  line-height: 1.6;
  text-decoration: none;
}
.ci-text a { display: block; transition: color 0.2s; }
.ci-text a:hover { color: var(--red); }

/* Social Row */
.con-socials {
  display: flex;
  gap: 0.6rem;
  margin-top: 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px solid var(--mid);
  margin-bottom: 2.5rem;
}
.con-social {
  width: 42px; height: 42px;
  border-radius: 12px;
  border: 1.5px solid var(--mid);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--charcoal);
  background: var(--white);
  transition: all 0.3s var(--ease);
}
.con-social:hover {
  background: var(--red);
  border-color: var(--red);
  color: #fff;
  transform: translateY(-3px) scale(1.08);
  box-shadow: 0 6px 20px rgba(216,45,55,0.3);
}
.con-social svg { width: 16px; height: 16px; fill: currentColor; }

/* ── FAQ ACCORDION ── */
.faq-section { margin-top: 0; }
.faq-section h3 {
  font-family: var(--font-h);
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--black);
  margin-bottom: 1rem;
  padding-bottom: 0.75rem;
  border-bottom: 2px solid var(--mid);
}
.faq-item {
  border: 1px solid var(--mid);
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 0.6rem;
  background: var(--white);
  transition: border-color 0.2s;
}
.faq-item.open { border-color: rgba(216,45,55,0.25); }
.faq-trigger {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.25rem;
  cursor: pointer;
  gap: 1rem;
}
.faq-trigger-text {
  font-size: 13px;
  font-weight: 600;
  color: var(--black);
  line-height: 1.4;
}
.faq-icon {
  flex-shrink: 0;
  width: 20px; height: 20px;
  border-radius: 6px;
  background: var(--light);
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background 0.2s, transform 0.3s var(--ease);
}
.faq-icon .lucide { width: 12px; height: 12px; stroke-width: 2.5; color: var(--charcoal); }
.faq-item.open .faq-icon { background: rgba(216,45,55,0.1); transform: rotate(180deg); }
.faq-item.open .faq-icon .lucide { color: var(--red); }
.faq-body {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s var(--ease), padding 0.3s;
}
.faq-item.open .faq-body { max-height: 300px; }
.faq-body-inner {
  padding: 0 1.25rem 1.25rem;
  font-size: 12.5px;
  color: var(--charcoal);
  line-height: 1.7;
  opacity: 0.8;
}

/* ── FORM SECTION ── */
.form-sec {
  background: var(--white);
  border-radius: 24px;
  padding: 2.75rem;
  box-shadow: 0 8px 60px rgba(0,0,0,0.06);
  border: 1px solid var(--mid);
  position: relative;
  overflow: hidden;
}
.form-sec::before {
  content: '';
  position: absolute;
  top: -100px; right: -100px;
  width: 300px; height: 300px;
  border-radius: 50%;
  background: radial-gradient(var(--con-red-glow), transparent 70%);
  pointer-events: none;
}

/* ── PROGRESS TRACKER ── */
.form-progress {
  background: var(--cream);
  border: 1px solid var(--mid);
  border-radius: 16px;
  padding: 1.25rem 1.5rem;
  margin-bottom: 2.5rem;
}
.form-progress-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}
.progress-step-label {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--charcoal);
  opacity: 0.55;
}
.progress-step-name {
  font-size: 12px;
  font-weight: 700;
  color: var(--red);
}
.form-stepper {
  display: flex;
  align-items: center;
}
.step-dot {
  width: 32px; height: 32px;
  border-radius: 50%;
  border: 2px solid var(--mid);
  background: var(--white);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 11px;
  font-weight: 700;
  color: var(--charcoal);
  opacity: 0.4;
  transition: all 0.4s var(--ease-spring);
  flex-shrink: 0;
  z-index: 2;
  position: relative;
}
.step-dot.active {
  border-color: var(--red);
  background: var(--red);
  color: #fff;
  opacity: 1;
  box-shadow: 0 0 0 5px rgba(216,45,55,0.15);
  transform: scale(1.1);
}
.step-dot.completed {
  border-color: var(--green);
  background: var(--green);
  color: #fff;
  opacity: 1;
}
.step-dot.completed::after {
  content: '✓';
  font-size: 12px;
  font-weight: 800;
}
.step-dot.completed span { display: none; }
.step-line {
  flex: 1;
  height: 3px;
  background: var(--mid);
  transition: background 0.6s ease;
  z-index: 1;
  margin: 0 -2px;
}
.step-line.filled { background: var(--green); }

/* ── STEP PANELS ── */
.form-step-panel {
  display: none;
  animation: stepIn 0.4s cubic-bezier(0.34, 1.2, 0.64, 1) forwards;
}
.form-step-panel.active { display: block; }
.form-step-panel.go-back { animation: stepBack 0.4s cubic-bezier(0.34, 1.2, 0.64, 1) forwards; }
@keyframes stepIn {
  from { opacity: 0; transform: translateX(28px) scale(0.97); }
  to   { opacity: 1; transform: translateX(0) scale(1); }
}
@keyframes stepBack {
  from { opacity: 0; transform: translateX(-28px) scale(0.97); }
  to   { opacity: 1; transform: translateX(0) scale(1); }
}

.step-heading { margin-bottom: 1.75rem; }
.step-heading h2 {
  font-family: var(--font-h);
  font-size: 1.9rem;
  font-weight: 900;
  color: var(--black);
  line-height: 1.1;
  letter-spacing: -1px;
  margin-bottom: 0.35rem;
}
.step-heading p {
  font-size: 13px;
  color: var(--charcoal);
  opacity: 0.65;
  line-height: 1.6;
}

/* ── FLOATING LABEL INPUTS ── */
.fl-group { position: relative; margin-bottom: 1.5rem; }
.fl-group label {
  position: absolute;
  top: 15px; left: 16px;
  font-size: 13px;
  font-weight: 500;
  color: rgba(65,64,66,.45);
  transition: all 0.22s var(--ease);
  pointer-events: none;
  background: var(--white);
  padding: 0 4px;
  line-height: 1;
}
.fl-group input:focus ~ label,
.fl-group input:not(:placeholder-shown) ~ label,
.fl-group textarea:focus ~ label,
.fl-group textarea:not(:placeholder-shown) ~ label {
  top: -7px; left: 12px;
  font-size: 10px; font-weight: 700;
  letter-spacing: 1px; text-transform: uppercase;
  color: var(--red);
}
.fl-group input, .fl-group textarea {
  width: 100%; padding: 15px 46px 15px 16px;
  border: 1.5px solid var(--mid);
  border-radius: 12px;
  background: var(--white);
  font-family: var(--font-b);
  font-size: 14px;
  color: var(--black);
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
  appearance: none;
}
.fl-group input:focus, .fl-group textarea:focus {
  border-color: var(--red);
  box-shadow: 0 0 0 4px rgba(216,45,55,0.08);
}
.fl-group textarea {
  min-height: 140px;
  resize: vertical;
  padding-right: 16px;
  line-height: 1.65;
}

/* Validation status icon inside input */
.fl-valid-icon {
  position: absolute;
  right: 14px; top: 50%;
  transform: translateY(-50%);
  pointer-events: none;
  opacity: 0;
  transition: opacity 0.3s;
}
.fl-group.valid .fl-valid-icon { opacity: 1; }
.fl-group.valid input,
.fl-group.valid textarea {
  border-color: rgba(107,143,26,0.5);
}
.fl-group.invalid input,
.fl-group.invalid textarea {
  border-color: var(--red);
  box-shadow: 0 0 0 4px rgba(216,45,55,0.1);
  animation: shake 0.4s;
}
@keyframes shake {
  0%, 100% { transform: translateX(0); }
  20%       { transform: translateX(-5px); }
  60%       { transform: translateX(5px); }
  80%       { transform: translateX(-3px); }
}
.char-counter {
  position: absolute;
  bottom: 10px; right: 14px;
  font-size: 10px;
  font-weight: 600;
  color: var(--charcoal);
  opacity: 0.35;
  transition: opacity 0.2s;
}
.fl-group textarea:focus ~ .char-counter { opacity: 0.8; }

.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

/* Field errors */
.field-error {
  font-size: 11px;
  font-weight: 600;
  color: var(--red);
  margin-top: -1.1rem;
  margin-bottom: 1rem;
  display: flex;
  align-items: center;
  gap: 0.3rem;
  display: none;
}
.field-error.visible { display: flex; }

/* Server errors */
.form-errors {
  background: rgba(216,45,55,.07);
  border: 1px solid rgba(216,45,55,.2);
  border-radius: 12px;
  padding: 1rem 1.25rem;
  margin-bottom: 1.75rem;
  color: var(--red);
  font-size: 13px;
}
.form-errors ul { margin: 0; padding-left: 1.25rem; }
.form-errors li { margin-bottom: 0.25rem; }

/* ── SERVICE CARDS ── */
.service-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0.75rem;
  margin-bottom: 1.5rem;
}
.service-option { position: relative; cursor: pointer; }
.service-option input[type="radio"] {
  position: absolute;
  opacity: 0;
  pointer-events: none;
}
.service-card {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
  padding: 1.2rem;
  border: 1.5px solid var(--mid);
  border-radius: 14px;
  background: var(--white);
  transition: all 0.3s var(--ease);
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transform-style: preserve-3d;
  will-change: transform;
}
.service-card::before {
  content: '';
  position: absolute;
  inset: 0;
  opacity: 0;
  background: linear-gradient(135deg, rgba(216,45,55,0.04), rgba(229,105,24,0.02));
  transition: opacity 0.3s;
  pointer-events: none;
}
.service-card-check {
  position: absolute;
  top: 10px; right: 10px;
  width: 20px; height: 20px;
  border-radius: 50%;
  background: var(--red);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transform: scale(0.4) rotate(-90deg);
  transition: all 0.35s var(--ease-spring);
  z-index: 2;
}
.service-card-check .lucide { width: 11px; height: 11px; stroke-width: 3; color: #fff; }
.service-option input:checked + .service-card {
  border-color: var(--red);
  box-shadow: 0 0 0 3px rgba(216,45,55,0.12), 0 6px 24px rgba(0,0,0,0.06);
  transform: translateY(-2px);
}
.service-option input:checked + .service-card::before { opacity: 1; }
.service-option input:checked + .service-card .service-card-check {
  opacity: 1;
  transform: scale(1) rotate(0deg);
}
.service-card:hover {
  border-color: rgba(216,45,55,0.3);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}
.service-card-icon {
  width: 36px; height: 36px;
  border-radius: 9px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 0.3rem;
  transition: transform 0.3s var(--ease-spring);
}
.service-card:hover .service-card-icon,
.service-option input:checked + .service-card .service-card-icon {
  transform: scale(1.12) rotate(-5deg);
}
.service-card-icon .lucide { width: 18px; height: 18px; stroke-width: 2; }
.service-card h4 {
  font-family: var(--font-h);
  font-size: 1rem;
  font-weight: 700;
  color: var(--black);
  line-height: 1.2;
}
.service-card p {
  font-size: 11px;
  color: var(--charcoal);
  opacity: 0.6;
  line-height: 1.4;
}
.service-grid-err .service-card { animation: shake 0.4s; }

/* ── REVIEW RECEIPT (STEP 4) ── */
.receipt-card {
  background: var(--cream);
  border-radius: 18px;
  border: 1px solid var(--mid);
  overflow: hidden;
  margin-bottom: 1.5rem;
}
.receipt-header {
  background: linear-gradient(135deg, var(--black), #2a2a2a);
  color: #fff;
  padding: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.receipt-header-left { display: flex; align-items: center; gap: 0.75rem; }
.receipt-logo-dot {
  width: 36px; height: 36px;
  border-radius: 10px;
  background: var(--red);
  display: flex;
  align-items: center;
  justify-content: center;
}
.receipt-logo-dot .lucide { width: 18px; height: 18px; stroke-width: 2; color: #fff; }
.receipt-brand { font-family: var(--font-h); font-size: 1rem; font-weight: 700; }
.receipt-brand span { display: block; font-family: var(--font-b); font-size: 10px; font-weight: 400; opacity: 0.6; letter-spacing: 1.5px; text-transform: uppercase; margin-top: 2px; }
.receipt-ref { font-size: 10px; opacity: 0.45; letter-spacing: 1px; text-align: right; }
.receipt-ref strong { display: block; font-size: 13px; opacity: 1; letter-spacing: 0; font-family: var(--font-h); }
.receipt-body { padding: 1.5rem; }
.receipt-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: 1rem;
  padding: 0.75rem 0;
  border-bottom: 1px dashed var(--mid);
}
.receipt-row:last-child { border-bottom: none; padding-bottom: 0; }
.receipt-key {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: var(--charcoal);
  opacity: 0.5;
  min-width: 110px;
  flex-shrink: 0;
}
.receipt-val {
  font-size: 13.5px;
  font-weight: 500;
  color: var(--black);
  text-align: right;
  line-height: 1.5;
}
.receipt-footer {
  background: rgba(107,143,26,0.08);
  border-top: 1px solid rgba(107,143,26,0.2);
  padding: 1rem 1.5rem;
  display: flex;
  align-items: center;
  gap: 0.6rem;
  font-size: 12px;
  color: var(--green);
  font-weight: 600;
}
.receipt-footer .lucide { width: 14px; height: 14px; stroke-width: 2.5; }
.receipt-edit-links {
  display: flex;
  gap: 0.75rem;
  flex-wrap: wrap;
  margin-bottom: 1.5rem;
}
.receipt-edit-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  font-size: 11.5px;
  font-weight: 700;
  color: var(--charcoal);
  background: var(--light);
  border: 1px solid var(--mid);
  padding: 7px 14px;
  border-radius: 100px;
  cursor: pointer;
  transition: all 0.2s var(--ease);
}
.receipt-edit-btn:hover { border-color: var(--red); color: var(--red); background: rgba(216,45,55,0.04); }
.receipt-edit-btn .lucide { width: 12px; height: 12px; stroke-width: 2.5; }

/* ── NAV BUTTONS ── */
.form-nav {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-top: 2rem;
}
.btn-back {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 13px;
  font-weight: 600;
  color: var(--charcoal);
  background: none;
  border: 1.5px solid var(--mid);
  border-radius: 12px;
  padding: 13px 20px;
  cursor: pointer;
  transition: all 0.2s var(--ease);
  white-space: nowrap;
}
.btn-back:hover { border-color: var(--charcoal); background: var(--light); }
.btn-back .lucide { width: 16px; height: 16px; stroke-width: 2; }
.btn-next {
  flex: 1;
  padding: 15px;
  font-size: 14.5px;
  font-weight: 700;
  letter-spacing: 0.3px;
  background: var(--red);
  color: #fff;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  transition: all 0.3s var(--ease);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 0.65rem;
  box-shadow: 0 4px 18px rgba(216,45,55,0.3);
  position: relative;
  overflow: hidden;
}
.btn-next::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(255,255,255,0.12), transparent);
  pointer-events: none;
}
.btn-next:hover {
  background: #b8242e;
  transform: translateY(-2px);
  box-shadow: 0 8px 28px rgba(216,45,55,0.4);
}
.btn-next .btn-arrow { transition: transform 0.25s; }
.btn-next:hover .btn-arrow { transform: translateX(4px); }
.btn-next.loading { opacity: 0.7; pointer-events: none; }
.btn-next .lucide { width: 16px; height: 16px; stroke-width: 2; }

/* ── MAP SECTION ── */
.map-sec { background: var(--light); padding: 5rem 2rem; }
.map-inner { max-width: 1200px; margin: 0 auto; }
.map-sec-header {
  display: flex;
  align-items: flex-end;
  justify-content: space-between;
  margin-bottom: 1.75rem;
  gap: 1rem;
  flex-wrap: wrap;
}
.map-sec-header h2 {
  font-family: var(--font-h);
  font-size: 2.2rem;
  font-weight: 900;
  color: var(--black);
  letter-spacing: -1px;
}
.map-sec-header p { font-size: 13px; color: var(--charcoal); opacity: 0.6; max-width: 320px; line-height: 1.6; }
.map-placeholder {
  position: relative;
  height: 420px;
  border-radius: 24px;
  overflow: hidden;
  border: 1px solid var(--mid);
  background:
    radial-gradient(ellipse at 75% 25%, rgba(216,45,55,0.07), transparent 50%),
    radial-gradient(ellipse at 15% 75%, rgba(107,143,26,0.06), transparent 50%),
    linear-gradient(135deg, #faf9f6, #f5f4f0);
  display: flex;
  align-items: center;
  padding: 3rem;
}
.map-dot-grid {
  position: absolute;
  inset: 0;
  opacity: 0.045;
  background-image:
    radial-gradient(circle, var(--black) 1px, transparent 0),
    radial-gradient(circle, var(--black) 1px, transparent 0);
  background-size: 28px 28px;
  background-position: 0 0, 14px 14px;
  pointer-events: none;
}
.map-decoration {
  position: absolute;
  right: 3rem; top: 50%; transform: translateY(-50%);
  width: 280px; height: 280px;
  border-radius: 50%;
  background: radial-gradient(rgba(216,45,55,0.08), transparent 70%);
  border: 1px solid rgba(216,45,55,0.1);
  display: flex;
  align-items: center;
  justify-content: center;
}
.map-decoration::before {
  content: '';
  width: 180px; height: 180px;
  border-radius: 50%;
  border: 1px solid rgba(216,45,55,0.15);
  background: radial-gradient(rgba(216,45,55,0.06), transparent 70%);
}
.map-decoration-pin {
  position: absolute;
  width: 60px; height: 60px;
  border-radius: 50%;
  background: var(--red);
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 8px 30px rgba(216,45,55,0.4);
  animation: pinFloat 3s ease-in-out infinite;
}
.map-decoration-pin .lucide { width: 28px; height: 28px; stroke-width: 1.75; color: #fff; }
@keyframes pinFloat {
  0%, 100% { transform: translateY(0); }
  50%       { transform: translateY(-10px); }
}
.map-glass-card {
  background: rgba(255,255,255,0.88);
  backdrop-filter: blur(16px);
  border: 1px solid rgba(255,255,255,0.7);
  border-radius: 20px;
  padding: 2rem;
  max-width: 400px;
  box-shadow: 0 12px 48px rgba(0,0,0,0.1);
  position: relative;
  z-index: 2;
  transition: all 0.35s var(--ease);
}
.map-glass-card:hover { transform: translateY(-5px); box-shadow: 0 18px 56px rgba(0,0,0,0.13); }
.map-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  background: rgba(216,45,55,0.09);
  color: var(--red);
  padding: 6px 13px;
  border-radius: 100px;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.5px;
  margin-bottom: 1rem;
}
.map-badge .lucide { width: 12px; height: 12px; stroke-width: 2.5; }
.map-glass-card h4 {
  font-family: var(--font-h);
  font-size: 1.6rem;
  font-weight: 900;
  color: var(--black);
  line-height: 1.1;
  margin-bottom: 0.4rem;
}
.map-glass-card p {
  font-size: 13.5px;
  color: var(--charcoal);
  line-height: 1.6;
  margin-bottom: 1.5rem;
}
.map-glass-actions { display: flex; gap: 0.65rem; flex-wrap: wrap; }
.map-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: var(--black);
  color: var(--white);
  padding: 12px 20px;
  border-radius: 10px;
  font-size: 13px;
  font-weight: 600;
  transition: all 0.22s var(--ease);
}
.map-btn-primary:hover {
  background: var(--red);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(216,45,55,0.3);
}
.map-btn-primary .lucide { width: 14px; height: 14px; stroke-width: 2; }

/* ── RESPONSIVE ── */
@media (max-width: 980px) {
  .con-body { grid-template-columns: 1fr; gap: 3rem; }
  .form-row { grid-template-columns: 1fr; }
  .service-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 600px) {
  .con-hero { padding: 7rem 1.5rem 5rem; }
  .form-sec { padding: 1.75rem 1.25rem; }
  .service-grid { grid-template-columns: 1fr; }
  .map-placeholder { padding: 1.5rem; height: auto; }
  .map-decoration { display: none; }
  .map-glass-card { max-width: 100%; }
}
</style>
@endsection

@section('content')

<!-- ══ HERO ══ -->
<div class="con-hero">
  <div class="con-hero-sphere con-hero-sphere-1"></div>
  <div class="con-hero-sphere con-hero-sphere-2"></div>
  <div class="con-hero-inner">
    <div class="eyebrow reveal">Get In Touch</div>
    <h1 class="reveal" style="transition-delay:.08s">Let's Start a<br><em>Conversation.</em></h1>
    <p class="reveal" style="transition-delay:.16s">Whether you're an individual, a school, an NGO, or a corporation — we'd love to hear from you and explore how TREC can create your ripple.</p>
    <div class="con-hero-meta reveal" style="transition-delay:.24s">
      <div class="con-live-badge">
        <span class="con-live-dot"></span>
        Office Currently Open
      </div>
      <div class="con-hero-stat">
        <i data-lucide="clock" style="width:14px;height:14px;stroke-width:2;opacity:.6"></i>
        Responds within <strong>24hrs</strong>
      </div>
      <div class="con-hero-stat">
        <i data-lucide="shield-check" style="width:14px;height:14px;stroke-width:2;opacity:.6"></i>
        <strong>100%</strong> confidential
      </div>
    </div>
  </div>
</div>

<!-- ══ BODY ══ -->
<div class="con-body">

  <!-- ── LEFT SIDEBAR ── -->
  <div class="con-sidebar">

    <p class="con-sidebar-heading">How to Reach Us</p>

    <!-- Location -->
    <div class="ci-item">
      <div class="ci-icon ci-r"><i data-lucide="map-pin"></i></div>
      <div class="ci-text">
        <strong>Location</strong>
        <p>11 Raji Crescent, New London Estate<br>Baruwa, Ipaja, Lagos, Nigeria</p>
      </div>
    </div>

    <!-- Email -->
    <a href="mailto:rippleeffectconsult@gmail.com" class="ci-item">
      <div class="ci-icon ci-o"><i data-lucide="mail"></i></div>
      <div class="ci-text">
        <strong>Email</strong>
        <p>rippleeffectconsult@gmail.com</p>
      </div>
    </a>

    <!-- Phone -->
    <a href="tel:+2349056057502" class="ci-item">
      <div class="ci-icon ci-g"><i data-lucide="phone"></i></div>
      <div class="ci-text">
        <strong>Phone</strong>
        <p>+234 905 605 7502<br>+234 808 063 9507</p>
      </div>
    </a>

    <!-- Office Hours -->
    <div class="ci-item">
      <div class="ci-icon ci-b"><i data-lucide="clock"></i></div>
      <div class="ci-text">
        <strong>Office Hours</strong>
        <p>Monday – Friday<br>9:00 am – 5:00 pm WAT</p>
      </div>
    </div>

    <!-- Socials -->
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

    <!-- FAQ Section -->
    <div class="faq-section">
      <h3>Quick Answers</h3>

      <div class="faq-item" id="faq-1">
        <div class="faq-trigger" onclick="toggleFaq('faq-1')">
          <span class="faq-trigger-text">How quickly do you respond to enquiries?</span>
          <div class="faq-icon"><i data-lucide="chevron-down"></i></div>
        </div>
        <div class="faq-body">
          <div class="faq-body-inner">We typically respond to all enquiries within 24 business hours. For urgent matters, you can reach us directly by phone during office hours.</div>
        </div>
      </div>

      <div class="faq-item" id="faq-2">
        <div class="faq-trigger" onclick="toggleFaq('faq-2')">
          <span class="faq-trigger-text">Do you offer online counselling sessions?</span>
          <div class="faq-icon"><i data-lucide="chevron-down"></i></div>
        </div>
        <div class="faq-body">
          <div class="faq-body-inner">Yes! We offer fully confidential virtual sessions via video call for clients who prefer remote access or are located outside Lagos. Sessions are just as effective as in-person appointments.</div>
        </div>
      </div>

      <div class="faq-item" id="faq-3">
        <div class="faq-trigger" onclick="toggleFaq('faq-3')">
          <span class="faq-trigger-text">What are the fees for individual counselling?</span>
          <div class="faq-icon"><i data-lucide="chevron-down"></i></div>
        </div>
        <div class="faq-body">
          <div class="faq-body-inner">Session fees vary based on the type and duration of support. We also offer sliding scale pricing for individuals with financial constraints. Please enquire via this form and we'll share a tailored breakdown.</div>
        </div>
      </div>

      <div class="faq-item" id="faq-4">
        <div class="faq-trigger" onclick="toggleFaq('faq-4')">
          <span class="faq-trigger-text">How can my school partner with TREC?</span>
          <div class="faq-icon"><i data-lucide="chevron-down"></i></div>
        </div>
        <div class="faq-body">
          <div class="faq-body-inner">Schools can access our School Management Wellbeing Package which includes needs assessments, curriculum development, teacher training, student counselling, and ongoing support. Fill in this form selecting "School Management Wellbeing Package" and we'll send you a proposal within 48 hours.</div>
        </div>
      </div>

    </div>
  </div>

  <!-- ── FORM SECTION ── -->
  <div class="form-sec reveal-right">

    @if ($errors->any())
      <div class="form-errors">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Progress Tracker -->
    <div class="form-progress" id="formProgress">
      <div class="form-progress-top">
        <span class="progress-step-label" id="progressStepText">Step 1 of 4</span>
        <span class="progress-step-name" id="progressStepTitle">Who Are You?</span>
      </div>
      <div class="form-stepper">
        <div class="step-dot active" id="dot-1"><span>1</span></div>
        <div class="step-line" id="line-1"></div>
        <div class="step-dot" id="dot-2"><span>2</span></div>
        <div class="step-line" id="line-2"></div>
        <div class="step-dot" id="dot-3"><span>3</span></div>
        <div class="step-line" id="line-3"></div>
        <div class="step-dot" id="dot-4"><span>4</span></div>
      </div>
    </div>

    <form method="POST" action="{{ route('contact.store') }}" id="contactForm">
      @csrf
      <!-- Hidden fields for final submission -->
      <input type="hidden" name="first_name"       id="h_first_name">
      <input type="hidden" name="last_name"        id="h_last_name">
      <input type="hidden" name="email"            id="h_email">
      <input type="hidden" name="organisation"     id="h_organisation">
      <input type="hidden" name="service_interest" id="h_service_interest">
      <input type="hidden" name="message"          id="h_message">

      <!-- ─── STEP 1: Personal Info ─── -->
      <div class="form-step-panel active" id="step-1">
        <div class="step-heading">
          <h2>Who Are You?</h2>
          <p>Tell us a little about yourself — we'll address you properly.</p>
        </div>

        <div class="form-row">
          <div class="fl-group" id="grp-fn">
            <input type="text" id="s1_first_name" placeholder=" " value="{{ old('first_name') }}" autocomplete="given-name">
            <label for="s1_first_name">First Name</label>
            <span class="fl-valid-icon"><i data-lucide="check-circle" style="width:18px;height:18px;stroke-width:2;color:var(--green)"></i></span>
          </div>
          <div class="fl-group" id="grp-ln">
            <input type="text" id="s1_last_name" placeholder=" " value="{{ old('last_name') }}" autocomplete="family-name">
            <label for="s1_last_name">Last Name</label>
            <span class="fl-valid-icon"><i data-lucide="check-circle" style="width:18px;height:18px;stroke-width:2;color:var(--green)"></i></span>
          </div>
        </div>
        <p class="field-error" id="err_name"><i data-lucide="alert-circle" style="width:11px;height:11px;stroke-width:2.5"></i> Please enter both your first and last name.</p>

        <div class="fl-group" id="grp-em">
          <input type="email" id="s1_email" placeholder=" " value="{{ old('email') }}" autocomplete="email">
          <label for="s1_email">Email Address</label>
          <span class="fl-valid-icon"><i data-lucide="check-circle" style="width:18px;height:18px;stroke-width:2;color:var(--green)"></i></span>
        </div>
        <p class="field-error" id="err_email"><i data-lucide="alert-circle" style="width:11px;height:11px;stroke-width:2.5"></i> Please enter a valid email address.</p>

        <div class="fl-group">
          <input type="text" id="s1_organisation" placeholder=" " value="{{ old('organisation') }}" autocomplete="organization">
          <label for="s1_organisation">Organisation (Optional)</label>
        </div>

        <div class="form-nav">
          <button type="button" class="btn-next" id="btn-next-1" onclick="goToStep(2)">
            Continue &nbsp;<i data-lucide="arrow-right" class="btn-arrow"></i>
          </button>
        </div>
      </div>

      <!-- ─── STEP 2: Service Interest ─── -->
      <div class="form-step-panel" id="step-2">
        <div class="step-heading">
          <h2>What Can We Help With?</h2>
          <p>Pick the service or area you'd like to enquire about.</p>
        </div>

        <div class="service-grid" id="serviceGrid">
          <label class="service-option">
            <input type="radio" name="s2_service" value="Counselling Department Set Up">
            <div class="service-card">
              <div class="service-card-check"><i data-lucide="check"></i></div>
              <div class="service-card-icon" style="background:rgba(216,45,55,.1);color:var(--red)"><i data-lucide="briefcase"></i></div>
              <h4>Department Set Up</h4>
              <p>Establishing functional counselling departments</p>
            </div>
          </label>
          <label class="service-option">
            <input type="radio" name="s2_service" value="Curriculum Development">
            <div class="service-card">
              <div class="service-card-check"><i data-lucide="check"></i></div>
              <div class="service-card-icon" style="background:rgba(229,105,24,.1);color:var(--orange)"><i data-lucide="book-open"></i></div>
              <h4>Curriculum Development</h4>
              <p>Age-appropriate wellbeing curricula</p>
            </div>
          </label>
          <label class="service-option">
            <input type="radio" name="s2_service" value="Needs Assessment">
            <div class="service-card">
              <div class="service-card-check"><i data-lucide="check"></i></div>
              <div class="service-card-icon" style="background:rgba(107,143,26,.1);color:var(--green)"><i data-lucide="clipboard-check"></i></div>
              <h4>Needs Assessment</h4>
              <p>Comprehensive psychosocial evaluations</p>
            </div>
          </label>
          <label class="service-option">
            <input type="radio" name="s2_service" value="Training and Capacity Building">
            <div class="service-card">
              <div class="service-card-check"><i data-lucide="check"></i></div>
              <div class="service-card-icon" style="background:rgba(216,45,55,.1);color:var(--red)"><i data-lucide="graduation-cap"></i></div>
              <h4>Training & Capacity Building</h4>
              <p>Skills development for school communities</p>
            </div>
          </label>
          <label class="service-option">
            <input type="radio" name="s2_service" value="School Management Wellbeing Package">
            <div class="service-card">
              <div class="service-card-check"><i data-lucide="check"></i></div>
              <div class="service-card-icon" style="background:rgba(229,105,24,.1);color:var(--orange)"><i data-lucide="shield-check"></i></div>
              <h4>Wellbeing Package</h4>
              <p>Integrated school support systems</p>
            </div>
          </label>
          <label class="service-option">
            <input type="radio" name="s2_service" value="TSCC and Strategic Education Events">
            <div class="service-card">
              <div class="service-card-check"><i data-lucide="check"></i></div>
              <div class="service-card-icon" style="background:rgba(107,143,26,.1);color:var(--green)"><i data-lucide="calendar-event"></i></div>
              <h4>TSCC & Events</h4>
              <p>Strategic education conference and events</p>
            </div>
          </label>
          <label class="service-option">
            <input type="radio" name="s2_service" value="General Enquiry">
            <div class="service-card">
              <div class="service-card-check"><i data-lucide="check"></i></div>
              <div class="service-card-icon" style="background:rgba(65,64,66,.08);color:var(--charcoal)"><i data-lucide="message-square"></i></div>
              <h4>General Enquiry</h4>
              <p>Something else on your mind?</p>
            </div>
          </label>
        </div>
        <p class="field-error" id="err_service"><i data-lucide="alert-circle" style="width:11px;height:11px;stroke-width:2.5"></i> Please select a service of interest.</p>

        <div class="form-nav">
          <button type="button" class="btn-back" onclick="goToStep(1)">
            <i data-lucide="arrow-left" class="lucide" style="width:16px;height:16px;stroke-width:2"></i> Back
          </button>
          <button type="button" class="btn-next" onclick="goToStep(3)">
            Continue &nbsp;<i data-lucide="arrow-right" class="btn-arrow"></i>
          </button>
        </div>
      </div>

      <!-- ─── STEP 3: Message ─── -->
      <div class="form-step-panel" id="step-3">
        <div class="step-heading">
          <h2>Your Message</h2>
          <p>Share any details — we read every message personally and carefully.</p>
        </div>

        <div class="fl-group" id="grp-msg" style="margin-bottom:0.5rem">
          <textarea id="s3_message" placeholder=" " rows="6">{{ old('message') }}</textarea>
          <label for="s3_message">Write your message…</label>
          <span class="char-counter" id="charCount">0 / 1000</span>
        </div>
        <p class="field-error" id="err_message"><i data-lucide="alert-circle" style="width:11px;height:11px;stroke-width:2.5"></i> Please write a message before continuing.</p>

        <div class="form-nav" style="margin-top:1.5rem">
          <button type="button" class="btn-back" onclick="goToStep(2)">
            <i data-lucide="arrow-left" class="lucide" style="width:16px;height:16px;stroke-width:2"></i> Back
          </button>
          <button type="button" class="btn-next" onclick="goToStep(4)">
            Review &amp; Submit &nbsp;<i data-lucide="arrow-right" class="btn-arrow"></i>
          </button>
        </div>
      </div>

      <!-- ─── STEP 4: Review Receipt ─── -->
      <div class="form-step-panel" id="step-4">
        <div class="step-heading">
          <h2>Review Your Enquiry</h2>
          <p>Everything look right? Hit submit and we'll be in touch shortly.</p>
        </div>

        <!-- Enquiry Receipt Card -->
        <div class="receipt-card">
          <div class="receipt-header">
            <div class="receipt-header-left">
              <div class="receipt-logo-dot"><i data-lucide="waves"></i></div>
              <div>
                <div class="receipt-brand">The Ripple Effect Consult<span>Enquiry Summary</span></div>
              </div>
            </div>
            <div class="receipt-ref">
              Reference<strong id="sum_ref">#TRC–——</strong>
            </div>
          </div>
          <div class="receipt-body">
            <div class="receipt-row">
              <span class="receipt-key">Full Name</span>
              <span class="receipt-val" id="sum_name">—</span>
            </div>
            <div class="receipt-row">
              <span class="receipt-key">Email</span>
              <span class="receipt-val" id="sum_email">—</span>
            </div>
            <div class="receipt-row" id="sum_org_row" style="display:none">
              <span class="receipt-key">Organisation</span>
              <span class="receipt-val" id="sum_org">—</span>
            </div>
            <div class="receipt-row">
              <span class="receipt-key">Service</span>
              <span class="receipt-val" id="sum_service">—</span>
            </div>
            <div class="receipt-row">
              <span class="receipt-key">Message</span>
              <span class="receipt-val" id="sum_message" style="max-width:220px;white-space:pre-wrap;word-break:break-word">—</span>
            </div>
          </div>
          <div class="receipt-footer">
            <i data-lucide="shield-check"></i>
            Your information is encrypted and 100% confidential.
          </div>
        </div>

        <!-- Edit Links -->
        <div class="receipt-edit-links">
          <button type="button" class="receipt-edit-btn" onclick="goToStep(1, true)">
            <i data-lucide="pencil"></i> Edit Details
          </button>
          <button type="button" class="receipt-edit-btn" onclick="goToStep(2, true)">
            <i data-lucide="pencil"></i> Change Service
          </button>
          <button type="button" class="receipt-edit-btn" onclick="goToStep(3, true)">
            <i data-lucide="pencil"></i> Edit Message
          </button>
        </div>

        <div class="form-nav">
          <button type="button" class="btn-back" onclick="goToStep(3)">
            <i data-lucide="arrow-left" class="lucide" style="width:16px;height:16px;stroke-width:2"></i> Back
          </button>
          <button type="submit" class="btn-next" id="submitBtn">
            <i data-lucide="send" style="width:16px;height:16px;stroke-width:2"></i>
            <span class="submit-text">Send Enquiry</span>
            <i data-lucide="arrow-right" class="btn-arrow"></i>
          </button>
        </div>
      </div>

    </form>
  </div>
</div>

<!-- ══ MAP SECTION ══ -->
<div class="map-sec">
  <div class="map-inner">
    <div class="map-sec-header reveal">
      <div>
        <div class="eyebrow" style="margin-bottom:.5rem">Our Location</div>
        <h2>Find Our Office</h2>
      </div>
      <p>Come visit us at our Lagos headquarters, or reach out remotely — we serve clients across Nigeria and beyond.</p>
    </div>
    <div class="map-placeholder reveal">
      <div class="map-dot-grid"></div>
      <div class="map-decoration">
        <div class="map-decoration-pin">
          <i data-lucide="map-pin"></i>
        </div>
      </div>
      <div class="map-glass-card">
        <div class="map-badge">
          <i data-lucide="map-pin"></i> Lagos Headquarters
        </div>
        <h4>TREC Nigeria<br>Office</h4>
        <p>11 Raji Crescent, New London Estate, Baruwa, Ipaja, Lagos, Nigeria.</p>
        <div class="map-glass-actions">
          <a href="https://maps.google.com/?q=11+Raji+Crescent+Baruwa+Ipaja+Lagos" target="_blank" class="map-btn-primary">
            <i data-lucide="navigation"></i> Get Directions
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
(function () {
  const TOTAL_STEPS = 4;
  const STEP_TITLES = ['Who Are You?', 'What Can We Help With?', 'Your Message', 'Review & Submit'];
  let currentStep = 1;
  let goingBack = false;

  /* ─── STEP NAVIGATION ─────────────────────────────── */
  window.goToStep = function (target, isEdit) {
    goingBack = (target < currentStep) || !!isEdit;
    if (!validateStep(currentStep)) return;

    const cur = document.getElementById('step-' + currentStep);
    cur.classList.remove('active', 'go-back');

    currentStep = target;
    const nxt = document.getElementById('step-' + currentStep);
    nxt.classList.remove('go-back');
    if (goingBack) nxt.classList.add('go-back');
    nxt.classList.add('active');

    updateProgress();
    if (currentStep === 4) populateSummary();
    window.scrollTo({ top: document.querySelector('.form-sec').offsetTop - 120, behavior: 'smooth' });
  };

  /* ─── PROGRESS INDICATOR ─────────────────────────── */
  function updateProgress() {
    document.getElementById('progressStepText').textContent  = 'Step ' + currentStep + ' of ' + TOTAL_STEPS;
    document.getElementById('progressStepTitle').textContent = STEP_TITLES[currentStep - 1];
    for (let i = 1; i <= TOTAL_STEPS; i++) {
      const dot = document.getElementById('dot-' + i);
      dot.classList.remove('active', 'completed');
      if (i < currentStep) dot.classList.add('completed');
      else if (i === currentStep) dot.classList.add('active');
    }
    for (let i = 1; i < TOTAL_STEPS; i++) {
      document.getElementById('line-' + i).classList.toggle('filled', i < currentStep);
    }
  }

  /* ─── VALIDATION ─────────────────────────────────── */
  function validateStep(step) {
    clearErrors();
    if (step === 1) return v1();
    if (step === 2) return v2();
    if (step === 3) return v3();
    return true;
  }

  function v1() {
    let ok = true;
    const fn = document.getElementById('s1_first_name');
    const ln = document.getElementById('s1_last_name');
    const em = document.getElementById('s1_email');

    setField('grp-fn', !!fn.value.trim());
    setField('grp-ln', !!ln.value.trim());

    if (!fn.value.trim() || !ln.value.trim()) {
      showError('err_name'); ok = false;
    }
    const validEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em.value.trim());
    setField('grp-em', validEmail && !!em.value.trim());
    if (!em.value.trim() || !validEmail) {
      showError('err_email'); ok = false;
    }
    return ok;
  }

  function v2() {
    const chosen = document.querySelector('input[name="s2_service"]:checked');
    if (!chosen) {
      showError('err_service');
      // Shake all cards
      document.querySelectorAll('.service-card').forEach(c => {
        c.style.animation = 'none';
        requestAnimationFrame(() => { c.style.animation = ''; c.classList.add('__shaking'); });
        setTimeout(() => c.classList.remove('__shaking'), 500);
      });
      document.getElementById('serviceGrid').classList.add('service-grid-err');
      setTimeout(() => document.getElementById('serviceGrid').classList.remove('service-grid-err'), 500);
      return false;
    }
    return true;
  }

  function v3() {
    const msg = document.getElementById('s3_message');
    if (!msg.value.trim()) {
      document.getElementById('grp-msg').classList.add('invalid');
      showError('err_message');
      return false;
    }
    document.getElementById('grp-msg').classList.remove('invalid');
    return true;
  }

  function setField(groupId, isValid) {
    const g = document.getElementById(groupId);
    if (!g) return;
    g.classList.toggle('valid', isValid);
    g.classList.toggle('invalid', !isValid);
  }

  function showError(id) {
    const el = document.getElementById(id);
    if (el) el.classList.add('visible');
  }

  function clearErrors() {
    document.querySelectorAll('.field-error').forEach(e => e.classList.remove('visible'));
  }

  /* ─── LIVE VALIDATION FEEDBACK ───────────────────── */
  ['s1_first_name', 's1_last_name'].forEach(id => {
    document.getElementById(id).addEventListener('input', function () {
      const grp = this.id === 's1_first_name' ? 'grp-fn' : 'grp-ln';
      setField(grp, !!this.value.trim());
      clearErrors();
    });
  });

  document.getElementById('s1_email').addEventListener('input', function () {
    const ok = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value.trim());
    setField('grp-em', ok && !!this.value.trim());
    clearErrors();
  });

  document.getElementById('s3_message').addEventListener('input', function () {
    const len = this.value.length;
    document.getElementById('charCount').textContent = len + ' / 1000';
    if (len > 1000) { this.value = this.value.slice(0, 1000); }
    if (this.value.trim()) {
      document.getElementById('grp-msg').classList.remove('invalid');
      clearErrors();
    }
    // Auto-grow
    this.style.height = 'auto';
    this.style.height = this.scrollHeight + 'px';
  });

  document.querySelectorAll('input[name="s2_service"]').forEach(r => {
    r.addEventListener('change', clearErrors);
  });

  /* ─── POPULATE SUMMARY ───────────────────────────── */
  function populateSummary() {
    const fn  = document.getElementById('s1_first_name').value.trim();
    const ln  = document.getElementById('s1_last_name').value.trim();
    const em  = document.getElementById('s1_email').value.trim();
    const org = document.getElementById('s1_organisation').value.trim();
    const svc = document.querySelector('input[name="s2_service"]:checked');
    const msg = document.getElementById('s3_message').value.trim();

    document.getElementById('sum_name').textContent    = fn + ' ' + ln;
    document.getElementById('sum_email').textContent   = em;
    document.getElementById('sum_service').textContent = svc ? svc.value : '—';
    document.getElementById('sum_message').textContent = msg;

    const orgRow = document.getElementById('sum_org_row');
    if (org) {
      document.getElementById('sum_org').textContent = org;
      orgRow.style.display = 'flex';
    } else {
      orgRow.style.display = 'none';
    }

    // Generate a pseudo-reference
    const ref = 'TRC–' + Math.random().toString(36).substring(2, 6).toUpperCase();
    document.getElementById('sum_ref').textContent = '#' + ref;

    // Populate hidden fields
    document.getElementById('h_first_name').value       = fn;
    document.getElementById('h_last_name').value        = ln;
    document.getElementById('h_email').value            = em;
    document.getElementById('h_organisation').value     = org;
    document.getElementById('h_service_interest').value = svc ? svc.value : '';
    document.getElementById('h_message').value          = msg;
  }

  /* ─── SUBMIT ─────────────────────────────────────── */
  document.getElementById('contactForm').addEventListener('submit', function () {
    populateSummary();
    const btn = document.getElementById('submitBtn');
    if (btn) {
      btn.classList.add('loading');
      btn.querySelector('.submit-text').textContent = 'Sending…';
    }
  });

  /* ─── FAQ ACCORDION ─────────────────────────────── */
  window.toggleFaq = function (id) {
    const item = document.getElementById(id);
    const wasOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(f => f.classList.remove('open'));
    if (!wasOpen) item.classList.add('open');
  };

  /* ─── SERVICE CARD 3D TILT ──────────────────────── */
  document.querySelectorAll('.service-card').forEach(card => {
    card.addEventListener('mousemove', function (e) {
      const r  = this.getBoundingClientRect();
      const x  = (e.clientX - r.left) / r.width  - 0.5;
      const y  = (e.clientY - r.top)  / r.height - 0.5;
      this.style.transform = `perspective(400px) rotateY(${x * 10}deg) rotateX(${-y * 10}deg) translateY(-2px)`;
    });
    card.addEventListener('mouseleave', function () {
      this.style.transform = '';
    });
  });

  /* ─── OFFICE STATUS ─────────────────────────────── */
  (function () {
    const now  = new Date();
    const day  = now.getDay(); // 0=Sun, 6=Sat
    const hour = now.getHours();
    const badge = document.querySelector('.con-live-badge');
    if (!badge) return;
    const open = day >= 1 && day <= 5 && hour >= 9 && hour < 17;
    if (!open) {
      badge.style.background = 'rgba(65,64,66,0.08)';
      badge.style.borderColor = 'rgba(65,64,66,0.2)';
      badge.style.color = 'var(--charcoal)';
      badge.querySelector('.con-live-dot').style.background = 'var(--charcoal)';
      badge.querySelector('.con-live-dot').style.animation = 'none';
      badge.innerHTML = badge.innerHTML.replace('Office Currently Open', 'Office Currently Closed');
    }
  })();

  /* ─── RESTORE STEP ON SERVER ERRORS ─────────────── */
  @if($errors->any())
    currentStep = 1;
    updateProgress();
  @endif

})();
</script>
@endsection
