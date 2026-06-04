@extends('layouts.app')
@section('title', 'TSCC — The School Counselling Conference')
@section('meta_desc', 'Nigeria\'s premier annual school counselling conference — expert keynotes, CPD workshops, networking, and advocacy for counsellors and educators.')

@section('styles')
<style>
/* ── HERO ── */
.tscc-hero {
  background: var(--black);
  min-height: 92vh;
  display: flex;
  align-items: center;
  position: relative;
  overflow: hidden;
  padding: 7rem 2rem 6rem;
}
.tscc-hero-bg {
  position: absolute;
  inset: 0;
  background:
    radial-gradient(ellipse 60% 80% at 10% 50%, rgba(229,105,24,0.22), transparent 55%),
    radial-gradient(ellipse 50% 60% at 90% 30%, rgba(216,45,55,0.15), transparent 55%);
  z-index: 1;
}
.tscc-grid-overlay {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
  background-size: 60px 60px;
  z-index: 1;
}
.tscc-bar {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--red), var(--orange), var(--green));
  z-index: 10;
}

/* Background Blur Spheres */
.glow-sphere {
  position: absolute;
  border-radius: 50%;
  filter: blur(120px);
  opacity: 0.15;
  z-index: 1;
  pointer-events: none;
  animation: glowPulse 8s ease-in-out infinite alternate;
}
.gs-1 {
  width: 400px;
  height: 400px;
  background: var(--orange);
  top: 10%;
  left: -10%;
}
.gs-2 {
  width: 300px;
  height: 300px;
  background: var(--red);
  bottom: 10%;
  right: 10%;
  animation-delay: -3.5s;
}
@keyframes glowPulse {
  0% { transform: scale(1) translate(0, 0); opacity: 0.12; }
  100% { transform: scale(1.25) translate(30px, -20px); opacity: 0.24; }
}

.tscc-hero-inner {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 5rem;
  align-items: center;
  position: relative;
  z-index: 5;
  width: 100%;
}

/* Event badge */
.event-badge {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(229,105,24,0.12);
  border: 1px solid rgba(229,105,24,0.25);
  color: var(--orange);
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 2.5px;
  text-transform: uppercase;
  padding: 7px 16px;
  border-radius: 100px;
  margin-bottom: 1.75rem;
}
.event-badge .lucide {
  width: 12px;
  height: 12px;
  stroke-width: 2.5;
}
.event-badge-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--orange);
  animation: pulse 2s ease-in-out infinite;
}

.tscc-hero h1 {
  font-family: var(--font-h);
  font-size: clamp(3rem, 5.5vw, 4.8rem);
  font-weight: 900;
  color: #fff;
  line-height: 1.05;
  letter-spacing: -2px;
  margin-bottom: 1.5rem;
}
.tscc-hero h1 span {
  color: var(--orange);
  background: linear-gradient(to right, var(--orange), var(--red));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.tscc-hero p {
  font-size: 1.05rem;
  font-weight: 300;
  color: rgba(255,255,255,0.65);
  max-width: 520px;
  line-height: 1.85;
  margin-bottom: 2.5rem;
}
.tscc-btns {
  display: flex;
  gap: 1rem;
  flex-wrap: wrap;
}

/* Right: Hero Image Area with 3D Tilt and Float Badges */
.hero-image-area {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  perspective: 1200px;
}
.hero-image-wrapper {
  position: relative;
  width: 100%;
  max-width: 380px;
  border-radius: 24px;
  padding: 10px;
  background: rgba(255, 255, 255, 0.02);
  border: 1px solid rgba(255, 255, 255, 0.06);
  box-shadow: 0 30px 60px rgba(0,0,0,0.35);
  transform-style: preserve-3d;
  transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s ease;
}
.hero-image-wrapper:hover {
  transform: rotateY(-6deg) rotateX(4deg) scale(1.02);
  box-shadow: 0 40px 80px rgba(229,105,24,0.12), 0 30px 60px rgba(0,0,0,0.45);
}
.hero-portrait {
  width: 100%;
  height: auto;
  aspect-ratio: 4/5;
  object-fit: cover;
  border-radius: 18px;
  display: block;
}

/* Floating Badges */
.floating-badge {
  position: absolute;
  background: rgba(13, 13, 13, 0.75);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 0.75rem 1.25rem;
  border-radius: 100px;
  display: flex;
  align-items: center;
  gap: 0.6rem;
  color: #fff;
  box-shadow: 0 15px 35px rgba(0,0,0,0.3);
  z-index: 10;
  transform: translateZ(40px);
  transition: all 0.3s ease;
}
.floating-badge:hover {
  background: var(--orange);
  border-color: var(--orange);
  transform: translateZ(60px) scale(1.05);
}
.floating-badge .lucide {
  width: 15px;
  height: 15px;
  color: var(--orange);
}
.floating-badge:hover .lucide {
  color: #fff;
}
.floating-badge span {
  font-size: 12px;
  font-weight: 500;
  letter-spacing: 0.2px;
  white-space: nowrap;
}

/* Floating badge animations & offsets */
.fb-1 {
  top: 15%;
  left: -50px;
  animation: floatSlow 6s ease-in-out infinite alternate;
}
.fb-2 {
  bottom: 25%;
  right: -55px;
  animation: floatMedium 5s ease-in-out infinite alternate;
  animation-delay: -1.5s;
}
.fb-3 {
  bottom: -15px;
  left: 20px;
  animation: floatFast 7s ease-in-out infinite alternate;
  animation-delay: -3s;
}

@keyframes floatSlow {
  0% { transform: translateZ(40px) translateY(0); }
  100% { transform: translateZ(40px) translateY(-12px); }
}
@keyframes floatMedium {
  0% { transform: translateZ(40px) translateY(0); }
  100% { transform: translateZ(40px) translateY(10px); }
}
@keyframes floatFast {
  0% { transform: translateZ(40px) translateX(0); }
  100% { transform: translateZ(40px) translateX(12px) translateY(-5px); }
}

/* ── QUICK FACTS RIBBON ── */
.facts-ribbon {
  background: var(--white);
  border-bottom: 1px solid var(--mid);
  padding: 2.25rem 0;
  position: relative;
  z-index: 10;
  box-shadow: 0 4px 20px rgba(0,0,0,0.02);
}
.facts-ribbon-grid {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 1.5rem;
  padding: 0 2rem;
}
.facts-ribbon-item {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding-right: 1rem;
  border-right: 1px solid var(--mid);
}
.facts-ribbon-item:last-child {
  border-right: none;
  padding-right: 0;
}
.facts-ribbon-icon {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: rgba(229,105,24,0.08);
  color: var(--orange);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: all 0.3s ease;
}
.facts-ribbon-item:hover .facts-ribbon-icon {
  background: var(--orange);
  color: #fff;
  transform: scale(1.08);
}
.facts-ribbon-icon .lucide {
  width: 18px;
  height: 18px;
  stroke-width: 2.25;
}
.facts-ribbon-content {
  display: flex;
  flex-direction: column;
}
.facts-ribbon-label {
  font-size: 9px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  color: rgba(65, 64, 66, 0.55);
  margin-bottom: 0.15rem;
}
.facts-ribbon-value {
  font-size: 13px;
  font-weight: 600;
  color: var(--black);
  line-height: 1.35;
}

/* ── 3D PARALLAX INTERACTIVE CARD BASE ── */
.interactive-card {
  transform-style: preserve-3d;
  transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s ease, border-color 0.5s ease;
}
.interactive-card h3, .interactive-card h4 {
  transform: translateZ(20px);
}
.interactive-card p, .interactive-card ul {
  transform: translateZ(10px);
}
.interactive-card .obj-card-icon, 
.interactive-card .feat-icon-wrapper, 
.interactive-card .tier-header-icon, 
.interactive-card .tier-badge {
  transform: translateZ(30px);
  transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.3s, color 0.3s;
}

/* ── ABOUT SECTION ── */
.tscc-about-sec {
  padding: 6.5rem 2rem;
  background: var(--cream);
}
.tscc-content-box {
  max-width: 900px;
  margin: 0 auto;
}
.tscc-editorial-intro {
  margin-bottom: 4rem;
}
.tscc-vision-mission {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 2rem;
  margin: 3.5rem 0;
}
.vm-panel {
  background: rgba(255,255,255,0.7);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.6);
  padding: 3rem 2.5rem;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.02);
  border-top: 4px solid var(--mid);
  transition: all 0.4s var(--ease-spring);
  display: flex;
  flex-direction: column;
  gap: 1rem;
}
.vm-panel:hover {
  background: #fff;
  border-top-color: var(--orange);
  transform: translateY(-6px);
  box-shadow: 0 20px 40px rgba(229,105,24,0.06);
  border-color: rgba(255,255,255,0.8);
}
.vm-icon-box {
  width: 46px;
  height: 46px;
  border-radius: 10px;
  background: rgba(229,105,24,0.08);
  color: var(--orange);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 0.5rem;
}
.vm-icon-box .lucide {
  width: 22px;
  height: 22px;
}
.vm-panel h3 {
  font-family: var(--font-h);
  font-size: 1.6rem;
  font-weight: 800;
  color: var(--black);
}
.vm-panel p {
  font-size: 0.95rem;
  font-weight: 300;
  color: var(--charcoal);
  line-height: 1.8;
  margin: 0;
}

.tscc-why-matters {
  background: rgba(255,255,255,0.7);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.6);
  border-left: 4px solid var(--orange);
  padding: 2.5rem;
  border-radius: 0 20px 20px 0;
  margin: 3.5rem 0;
  box-shadow: 0 8px 30px rgba(0,0,0,0.01);
  transition: all 0.3s ease;
}
.tscc-why-matters:hover {
  background: #fff;
  box-shadow: 0 15px 35px rgba(0,0,0,0.03);
}
.tscc-why-matters h3 {
  font-family: var(--font-h);
  font-size: 1.5rem;
  font-weight: 800;
  color: var(--black);
  margin-bottom: 1rem;
}

/* ── OBJECTIVES GRID ── */
.objectives-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
  margin: 3rem 0;
}
.obj-card {
  background: #fff;
  border-top: 4px solid var(--mid);
  padding: 2.25rem 2rem;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.02);
  position: relative;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}
.obj-card:hover {
  border-top-color: var(--orange);
  box-shadow: 0 15px 35px rgba(229,105,24,0.08);
}
.obj-card-icon {
  width: 44px;
  height: 44px;
  border-radius: 8px;
  background: rgba(229,105,24,0.08);
  color: var(--orange);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 0.5rem;
}
.obj-card-icon .lucide {
  width: 20px;
  height: 20px;
}
.obj-card:hover .obj-card-icon {
  background: var(--orange);
  color: #fff;
  transform: translateZ(30px) scale(1.05);
}
.obj-card-num {
  position: absolute;
  top: 1.5rem;
  right: 1.5rem;
  font-family: var(--font-h);
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--mid);
  opacity: 0.5;
  transition: all 0.3s ease;
  transform: translateZ(10px);
}
.obj-card:hover .obj-card-num {
  color: var(--orange);
  opacity: 0.2;
}
.obj-card h4 {
  font-family: var(--font-h);
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--black);
  margin-top: 0.25rem;
}
.obj-card p {
  font-size: 0.9rem;
  font-weight: 300;
  color: var(--charcoal);
  line-height: 1.65;
  margin: 0;
}

/* ── TARGET AUDIENCE ── */
.audience-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
  margin: 3rem 0;
}
.audience-card {
  background: #fff;
  border: 1px solid var(--mid);
  padding: 2.25rem 2rem;
  border-radius: 12px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(0,0,0,0.02);
}
.audience-card:hover {
  border-color: rgba(229,105,24,0.3);
  box-shadow: 0 12px 30px rgba(229,105,24,0.06);
  transform: translateY(-3px);
}
.audience-card-header {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  margin-bottom: 1.5rem;
  padding-bottom: 0.75rem;
  border-bottom: 1px solid var(--light);
}
.audience-card-icon {
  color: var(--orange);
  width: 22px;
  height: 22px;
  stroke-width: 2;
}
.audience-card h4 {
  font-family: var(--font-h);
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--black);
}
.audience-card ul {
  list-style: none;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}
.audience-card li {
  font-size: 0.92rem;
  font-weight: 300;
  color: var(--charcoal);
  display: flex;
  align-items: center;
  gap: 0.65rem;
}
.audience-card li .lucide {
  width: 14px;
  height: 14px;
  color: var(--orange);
  stroke-width: 2.5;
  flex-shrink: 0;
}

/* ── GALLERY SECTION (Bento Grid Style) ── */
.tscc-gallery-sec {
  background: var(--white);
  padding: 6.5rem 2rem;
}
.gallery-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-auto-rows: 240px;
  gap: 1.25rem;
  grid-auto-flow: dense;
  margin-top: 3.5rem;
}
.gallery-item {
  position: relative;
  overflow: hidden;
  border-radius: 16px;
  cursor: pointer;
  box-shadow: 0 4px 20px rgba(0,0,0,0.03);
}
.gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
.gallery-item:hover img {
  transform: scale(1.06);
}
.gallery-item::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(13,13,13,0.5) 0%, transparent 60%);
  opacity: 0;
  transition: opacity 0.35s ease;
  z-index: 1;
}
.gallery-item:hover::after {
  opacity: 1;
}
.gallery-hover-info {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 1.5rem;
  color: #fff;
  opacity: 0;
  transform: translateY(10px);
  transition: all 0.35s ease;
  z-index: 2;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 1rem;
}
.gallery-item:hover .gallery-hover-info {
  opacity: 1;
  transform: translateY(0);
}
.gallery-hover-title {
  font-size: 13.5px;
  font-weight: 500;
  letter-spacing: 0.3px;
}
.gallery-hover-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: #fff;
  color: var(--black);
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.gallery-hover-btn .lucide {
  width: 14px;
  height: 14px;
  stroke-width: 2.5;
}

/* Bento Sizing Spans */
.gallery-item.gi-large {
  grid-column: span 2;
  grid-row: span 2;
}
.gallery-item.gi-wide {
  grid-column: span 2;
}
.gallery-item.gi-tall {
  grid-row: span 2;
}

/* Lightbox Modal */
.lightbox {
  display: none;
  position: fixed;
  z-index: 99999;
  inset: 0;
  background: rgba(13,13,13,0.96);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  align-items: center;
  justify-content: center;
  flex-direction: column;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.lightbox.active {
  display: flex;
  opacity: 1;
}
.lightbox-content {
  max-width: 85%;
  max-height: 75vh;
  object-fit: contain;
  border-radius: 8px;
  box-shadow: 0 30px 70px rgba(0,0,0,0.6);
  transform: scale(0.96);
  transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}
.lightbox.active .lightbox-content {
  transform: scale(1);
}
.lightbox-close {
  position: absolute;
  top: 2rem;
  right: 2rem;
  color: rgba(255,255,255,0.6);
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.1);
  width: 44px;
  height: 44px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s;
}
.lightbox-close:hover {
  color: #fff;
  background: var(--red);
  border-color: var(--red);
}
.lightbox-close .lucide {
  width: 20px;
  height: 20px;
  stroke-width: 2;
}
.lightbox-caption {
  color: rgba(255,255,255,0.7);
  margin-top: 1.5rem;
  font-size: 1rem;
  font-weight: 300;
  text-align: center;
}
.lightbox-prev, .lightbox-next {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.1);
  color: #fff;
  width: 52px;
  height: 52px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
  z-index: 10;
}
.lightbox-prev:hover, .lightbox-next:hover {
  background: var(--orange);
  border-color: var(--orange);
}
.lightbox-prev .lucide, .lightbox-next .lucide {
  width: 22px;
  height: 22px;
  stroke-width: 2;
}
.lightbox-prev { left: 2rem; }
.lightbox-next { right: 2rem; }

/* ── WHY TSCC ── */
.tscc-why {
  background: var(--white);
  padding: 6.5rem 2rem;
  border-top: 1px solid var(--mid);
}
.feat-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
  margin-top: 3.5rem;
}
.feat-card {
  background: #fff;
  border: 1px solid var(--mid);
  border-radius: 16px;
  padding: 2.75rem 2.25rem;
  position: relative;
  overflow: hidden;
}
.feat-card::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(229,105,24,0.03), transparent);
  opacity: 0;
  transition: opacity 0.3s ease;
}
.feat-card:hover {
  box-shadow: 0 20px 40px rgba(0,0,0,.06);
  border-color: rgba(229,105,24,0.25);
}
.feat-card:hover::after {
  opacity: 1;
}
.feat-icon-wrapper {
  width: 54px;
  height: 54px;
  border-radius: 12px;
  background: var(--light);
  color: var(--charcoal);
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.5rem;
}
.feat-icon-wrapper .lucide {
  width: 24px;
  height: 24px;
  stroke-width: 1.75;
}
.feat-card:hover .feat-icon-wrapper {
  background: var(--orange);
  color: #fff;
  transform: translateZ(30px) scale(1.1) rotate(5deg);
  box-shadow: 0 8px 20px rgba(229,105,24,0.25);
}
.feat-card h4 {
  font-family: var(--font-h);
  font-size: 1.3rem;
  font-weight: 700;
  color: var(--black);
  margin-bottom: 0.6rem;
  position: relative;
  z-index: 2;
}
.feat-card p {
  font-size: 0.88rem;
  font-weight: 300;
  color: var(--charcoal);
  line-height: 1.8;
  position: relative;
  z-index: 2;
}

/* ── SPONSORSHIP TIERS ── */
.sponsor-sec {
  background: var(--cream);
  padding: 6.5rem 2rem;
}
.tier-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 1.5rem;
  margin-top: 3.5rem;
  align-items: stretch;
}
.tier-card {
  border-radius: 24px;
  padding: 3.5rem 2.75rem;
  position: relative;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.tier-card.tc-bronze {
  background: #fff;
  border: 1px solid rgba(200,138,74,0.25);
  box-shadow: 0 4px 20px rgba(200,138,74,0.04);
}
.tier-card.tc-silver {
  background: #fff;
  border: 1px solid rgba(156,163,175,0.25);
  box-shadow: 0 4px 20px rgba(156,163,175,0.04);
}

/* Shimmer Gold Card Overhaul */
.tier-card.tc-gold {
  background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);
  border: 1px solid rgba(212,160,23,0.35);
  box-shadow: 0 10px 40px rgba(0,0,0,0.15);
  color: #fff;
  overflow: hidden;
}
.tier-card.tc-gold::before {
  content: '';
  position: absolute;
  inset: -60%;
  background: linear-gradient(
    90deg,
    transparent 30%,
    rgba(212, 160, 23, 0.15) 50%,
    transparent 70%
  );
  transform: rotate(25deg);
  animation: goldShimmer 6s linear infinite;
  pointer-events: none;
  z-index: 1;
}
@keyframes goldShimmer {
  0% { transform: translate(-30%, -30%) rotate(25deg); }
  100% { transform: translate(30%, 30%) rotate(25deg); }
}

.tier-card.tc-bronze:hover {
  box-shadow: 0 25px 50px rgba(200,138,74,0.12);
  border-color: #c88a4a;
}
.tier-card.tc-silver:hover {
  box-shadow: 0 25px 50px rgba(156,163,175,0.12);
  border-color: #9ca3af;
}
.tier-card.tc-gold:hover {
  box-shadow: 0 25px 50px rgba(212,160,23,0.25), 0 0 30px rgba(212,160,23,0.1);
  border-color: #d4a017;
}

.tier-header-icon {
  position: absolute;
  top: 3.25rem;
  right: 2.5rem;
  width: 32px;
  height: 32px;
  opacity: 0.15;
}
.tc-bronze .tier-header-icon { color: #c88a4a; }
.tc-silver .tier-header-icon { color: #9ca3af; }
.tc-gold .tier-header-icon { color: #d4a017; opacity: 0.45; }

.tier-card:hover .tier-header-icon {
  opacity: 0.9;
  transform: translateZ(30px) scale(1.15) rotate(15deg);
}
.tier-badge {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  padding: 5px 14px;
  border-radius: 100px;
  margin-bottom: 1.5rem;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  width: fit-content;
}
.tier-badge .lucide {
  width: 12px;
  height: 12px;
  stroke-width: 2.5;
}
.tb-bronze { background: rgba(200,138,74,0.1); color: #c88a4a; }
.tb-silver { background: rgba(156,163,175,0.1); color: #6b7280; }
.tb-gold { background: rgba(212,160,23,0.15); color: #d4a017; }

.tier-card h3 {
  font-family: var(--font-h);
  font-size: 1.65rem;
  font-weight: 900;
  margin-bottom: 0.5rem;
}
.tc-bronze h3, .tc-silver h3 { color: var(--black); }
.tc-gold h3 { color: #fff; text-shadow: 0 0 8px rgba(255,255,255,0.1); }

.tier-price-box {
  margin-bottom: 1.5rem;
  padding-bottom: 1.5rem;
  border-bottom: 1px solid var(--mid);
}
.tc-gold .tier-price-box {
  border-bottom-color: rgba(255,255,255,0.08);
}
.tier-price {
  font-size: 0.9rem;
  font-weight: 300;
  margin-bottom: 0.25rem;
}
.tc-bronze .tier-price, .tc-silver .tier-price { color: var(--charcoal); }
.tc-gold .tier-price { color: rgba(255,255,255,0.5); }

.tier-list {
  list-style: none;
  display: flex;
  flex-direction: column;
  gap: 0.85rem;
  margin: 0 auto 2.5rem 0;
  width: 100%;
}
.tier-list li {
  font-size: 0.92rem;
  font-weight: 300;
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  line-height: 1.45;
}
.tc-bronze .tier-list li, .tc-silver .tier-list li { color: var(--charcoal); }
.tc-gold .tier-list li { color: rgba(255,255,255,0.75); }

.tier-list li .lucide {
  width: 16px;
  height: 16px;
  stroke-width: 2.5;
  flex-shrink: 0;
  margin-top: 2px;
}
.tc-bronze .tier-list li .lucide { color: #c88a4a; }
.tc-silver .tier-list li .lucide { color: #6b7280; }
.tc-gold .tier-list li .lucide { color: #d4a017; text-shadow: 0 0 5px rgba(212,160,23,0.4); }

.tier-cta-btn {
  display: block;
  text-align: center;
  padding: 13px;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 600;
  letter-spacing: 0.3px;
  transition: all 0.25s;
  cursor: pointer;
  text-decoration: none;
  position: relative;
  z-index: 5;
}
.tc-bronze .tier-cta-btn {
  background: rgba(200,138,74,0.1);
  color: #c88a4a;
}
.tc-bronze .tier-cta-btn:hover {
  background: #c88a4a;
  color: #fff;
}
.tc-silver .tier-cta-btn {
  background: rgba(156,163,175,0.1);
  color: #6b7280;
}
.tc-silver .tier-cta-btn:hover {
  background: #6b7280;
  color: #fff;
}
.tc-gold .tier-cta-btn {
  background: var(--orange);
  color: #fff;
  box-shadow: 0 4px 14px rgba(229,105,24,0.3);
}
.tc-gold .tier-cta-btn:hover {
  background: #c95c15;
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(229,105,24,0.4);
}

/* ── PAST EDITIONS TIMELINE (Pulse Beacons) ── */
.editions-sec {
  background: var(--black);
  padding: 6.5rem 2rem;
}
.editions-container {
  max-width: 800px;
  margin: 0 auto;
}
.editions-list {
  display: flex;
  flex-direction: column;
  gap: 0;
  margin-top: 3.5rem;
  position: relative;
  padding-left: 2rem;
  border-left: 2px solid rgba(255,255,255,0.08);
  margin-left: 1rem;
}
.edition-row {
  position: relative;
  display: flex;
  flex-direction: column;
  padding: 2.25rem 0;
  border-bottom: none;
  align-items: flex-start;
  transition: transform 0.3s ease;
}
.edition-row:first-child {
  padding-top: 0;
}
.edition-row:last-child {
  padding-bottom: 0;
}
.edition-row::before {
  content: '';
  position: absolute;
  left: calc(-2rem - 6px);
  top: 2.9rem;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: rgba(255,255,255,0.25);
  border: 2px solid var(--black);
  transition: all 0.3s ease;
  box-shadow: 0 0 0 4px var(--black);
  z-index: 2;
}
/* Pulse ring markup */
.edition-row::after {
  content: '';
  position: absolute;
  left: calc(-2rem - 10px);
  top: 2.65rem;
  width: 18px;
  height: 18px;
  border-radius: 50%;
  border: 1px solid rgba(229,105,24,0.4);
  opacity: 0;
  transition: all 0.3s ease;
  pointer-events: none;
  z-index: 1;
  animation: beaconPulse 2s infinite;
}
.edition-row:first-child::before {
  top: 0.65rem;
}
.edition-row:first-child::after {
  top: 0.4rem;
}
@keyframes beaconPulse {
  0% { transform: scale(0.6); opacity: 1; }
  100% { transform: scale(1.6); opacity: 0; }
}

.edition-row:hover::before {
  background: var(--orange);
  box-shadow: 0 0 10px var(--orange), 0 0 0 4px var(--black);
  transform: scale(1.3);
}
.edition-row:hover::after {
  border-color: var(--orange);
  opacity: 1;
}

.edition-year {
  font-family: var(--font-h);
  font-size: 2.2rem;
  font-weight: 900;
  color: rgba(255,255,255,0.2);
  line-height: 1;
  transition: color 0.3s;
}
.edition-row:hover .edition-year {
  color: var(--orange);
}
.edition-body {
  margin-top: 0.25rem;
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}
.edition-title {
  font-size: 14.5px;
  font-weight: 500;
  color: rgba(255,255,255,0.85);
}
.edition-tag {
  font-size: 11.5px;
  font-weight: 600;
  color: rgba(255,255,255,0.45);
  letter-spacing: 0.5px;
}

/* ── CTA ── */
.tscc-cta {
  background: var(--orange);
  padding: 6rem 2rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}
.tscc-cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse at 50% 100%, rgba(0,0,0,0.22), transparent 70%);
}

/* ── STAY CONNECTED (Social Media Links) ── */
.social-links-sec {
  padding: 4.5rem 2rem;
  background: var(--black);
  text-align: center;
  position: relative;
  border-top: 1px solid rgba(255,255,255,0.06);
}
.social-btns {
  display: flex;
  justify-content: center;
  gap: 1rem;
  flex-wrap: wrap;
  margin-top: 2rem;
}
.social-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.65rem;
  padding: 0.85rem 1.75rem;
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  color: #fff;
  border-radius: 100px;
  font-weight: 500;
  font-size: 0.9rem;
  transition: all 0.3s var(--ease);
  text-decoration: none;
}
.social-btn .lucide {
  width: 16px;
  height: 16px;
  stroke-width: 2;
}
.social-btn.sb-facebook:hover {
  background: #1877F2;
  border-color: #1877F2;
  box-shadow: 0 8px 24px rgba(24,119,242,0.3);
  transform: translateY(-2px);
}
.social-btn.sb-instagram:hover {
  background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
  border-color: transparent;
  box-shadow: 0 8px 24px rgba(220,39,67,0.3);
  transform: translateY(-2px);
}
.social-btn.sb-twitter:hover {
  background: #000000;
  border-color: #333333;
  box-shadow: 0 8px 24px rgba(255,255,255,0.1);
  transform: translateY(-2px);
}
.social-btn.sb-tiktok:hover {
  background: #010101;
  border-color: #ee1d52;
  box-shadow: 0 8px 24px rgba(238,29,82,0.3), 0 8px 24px rgba(105,201,208,0.3);
  transform: translateY(-2px);
}

/* ── RESPONSIVE MEDIA QUERIES ── */
@media(max-width:960px){
  .tscc-hero-inner {
    grid-template-columns: 1fr;
    gap: 4.5rem;
    text-align: center;
  }
  .tscc-hero p {
    margin-left: auto;
    margin-right: auto;
  }
  .tscc-btns {
    justify-content: center;
  }
  .hero-image-area {
    max-width: 320px;
    margin: 0 auto;
  }
  .floating-badge {
    padding: 0.65rem 1.1rem;
  }
  .fb-1 { left: -40px; }
  .fb-2 { right: -40px; }
  
  /* Ribbon on Mobile/Tablet */
  .facts-ribbon {
    padding: 1.75rem 0;
  }
  .facts-ribbon-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem 1rem;
  }
  .facts-ribbon-item {
    border-right: none;
    padding-right: 0;
  }
  
  .tscc-vision-mission {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  .objectives-grid {
    grid-template-columns: 1fr 1fr;
  }
  .audience-grid {
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }
  .gallery-grid {
    grid-template-columns: repeat(2, 1fr);
    grid-auto-rows: 200px;
  }
  .gallery-item.gi-large {
    grid-column: span 2;
    grid-row: span 1;
  }
  .gallery-item.gi-tall {
    grid-row: span 1;
  }
  .feat-grid {
    grid-template-columns: 1fr 1fr;
  }
  .tier-grid {
    grid-template-columns: 1fr;
    gap: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
  }
  .tier-card {
    min-height: auto;
  }
}

@media(max-width:600px){
  .tscc-hero {
    padding-top: 6rem;
  }
  .tscc-hero h1 {
    letter-spacing: -1.5px;
  }
  .hero-image-area {
    max-width: 260px;
  }
  .fb-1 { left: -30px; top: 10%; }
  .fb-2 { right: -30px; bottom: 20%; }
  .fb-3 { left: 10px; bottom: -10px; }
  
  .facts-ribbon-grid {
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }
  .facts-ribbon-item {
    background: var(--light);
    padding: 1.25rem;
    border-radius: 12px;
    border-right: none;
    padding-right: 1.25rem;
  }
  
  .objectives-grid {
    grid-template-columns: 1fr;
  }
  .gallery-grid {
    grid-template-columns: 1fr;
    grid-auto-rows: auto;
    gap: 1rem;
  }
  .gallery-item {
    aspect-ratio: 4/3;
  }
  .gallery-item.gi-large, .gallery-item.gi-wide, .gallery-item.gi-tall {
    grid-column: span 1 !important;
    grid-row: span 1 !important;
  }
  .feat-grid {
    grid-template-columns: 1fr;
  }
  .social-btns {
    flex-direction: column;
    align-items: stretch;
    max-width: 280px;
    margin-left: auto;
    margin-right: auto;
  }
  .social-btn {
    justify-content: center;
  }
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
<div class="tscc-hero">
  <div class="tscc-hero-bg"></div>
  <div class="tscc-grid-overlay"></div>
  <div class="tscc-bar"></div>
  
  <!-- Glowing Spheres -->
  <div class="glow-sphere gs-1"></div>
  <div class="glow-sphere gs-2"></div>
  
  <div class="tscc-hero-inner">
    <div>
      <div class="event-badge reveal">
        <i data-lucide="sparkles"></i>
        <span class="event-badge-dot"></span>
        TREC Flagship Annual Event
      </div>
      <h1 class="reveal" style="transition-delay:.1s">From <span>Fragmentation</span><br>to a School<br>That Works</h1>
      <p class="reveal" style="transition-delay:.2s">Africa's leading platform for advancing school counselling, wellbeing systems, and whole-school transformation. Bringing together educators, counsellors, parents, policymakers, and development partners.</p>
      <div class="tscc-btns reveal" style="transition-delay:.3s">
        <a href="{{ route('contact') }}" class="btn-orange">Become a Sponsor</a>
        <a href="{{ route('contact') }}" class="btn-ghost" style="border-color:rgba(255,255,255,.2);color:#fff">Register Interest</a>
      </div>
    </div>
    
    <div class="hero-image-area reveal-right" style="transition-delay:.25s">
      <div class="hero-image-wrapper">
        <img src="{{ asset('tscc-images/counselor_hero.png') }}" alt="School Counselor" class="hero-portrait">
        
        <!-- Floating Badges -->
        <div class="floating-badge fb-1">
          <i data-lucide="map-pin"></i>
          <span>Lagos, Nigeria</span>
        </div>
        <div class="floating-badge fb-2">
          <i data-lucide="monitor"></i>
          <span>Hybrid Format</span>
        </div>
        <div class="floating-badge fb-3">
          <i data-lucide="users"></i>
          <span>400+ Delegates</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ── QUICK FACTS RIBBON ── -->
<section class="facts-ribbon">
  <div class="facts-ribbon-grid reveal-stagger">
    <div class="facts-ribbon-item">
      <div class="facts-ribbon-icon"><i data-lucide="calendar"></i></div>
      <div class="facts-ribbon-content">
        <span class="facts-ribbon-label">Event Date</span>
        <span class="facts-ribbon-value">TSCC 2025</span>
      </div>
    </div>
    <div class="facts-ribbon-item">
      <div class="facts-ribbon-icon"><i data-lucide="bookmark"></i></div>
      <div class="facts-ribbon-content">
        <span class="facts-ribbon-label">Conference Theme</span>
        <span class="facts-ribbon-value">Fragmentation to a School That Works</span>
      </div>
    </div>
    <div class="facts-ribbon-item">
      <div class="facts-ribbon-icon"><i data-lucide="map-pin"></i></div>
      <div class="facts-ribbon-content">
        <span class="facts-ribbon-label">Location</span>
        <span class="facts-ribbon-value">Lagos, Nigeria</span>
      </div>
    </div>
    <div class="facts-ribbon-item">
      <div class="facts-ribbon-icon"><i data-lucide="monitor"></i></div>
      <div class="facts-ribbon-content">
        <span class="facts-ribbon-label">Attendance Format</span>
        <span class="facts-ribbon-value">In-person & Virtual</span>
      </div>
    </div>
    <div class="facts-ribbon-item">
      <div class="facts-ribbon-icon"><i data-lucide="shield-check"></i></div>
      <div class="facts-ribbon-content">
        <span class="facts-ribbon-label">CPD Recognition</span>
        <span class="facts-ribbon-value">Certified Hours Awarded</span>
      </div>
    </div>
  </div>
</section>

<!-- ── OVERVIEW & MISSION ── -->
<section class="tscc-about-sec">
  <div class="wrap">
    <div class="reveal" style="text-align:center;margin-bottom:3rem">
      <div class="eyebrow" style="justify-content:center;color:var(--orange)">About TSCC</div>
      <h2 class="stitle">The School Counselling Conference</h2>
    </div>
    
    <div class="tscc-content-box reveal">
      <div class="tscc-editorial-intro">
        <p style="font-size:1.15rem;color:var(--black);line-height:1.8;font-weight:400;margin-bottom:1.5rem">
          <strong>TSCC is the flagship conference of The Ripple Effect Consult (TREC), designed to reposition school counselling from a support function to a strategic driver of school transformation.</strong>
        </p>
        <p>TSCC serves as a premier platform that brings together school owners, school leaders, counsellors, psychologists, teachers, parents, policymakers, development partners, corporate sponsors, and education stakeholders to explore how counselling systems can improve student wellbeing, strengthen school culture, enhance staff effectiveness, and improve overall school outcomes.</p>
        <p>The conference is built on the belief that counselling should not operate as an isolated department but as a central system that aligns people, processes, and outcomes within educational institutions.</p>
      </div>

      <div class="tscc-vision-mission">
        <div class="vm-panel">
          <div class="vm-icon-box">
            <i data-lucide="eye"></i>
          </div>
          <h3>Vision</h3>
          <p>To become Africa's leading platform for advancing school counselling, wellbeing systems, psychosocial support, and whole-school transformation.</p>
        </div>
        
        <div class="vm-panel">
          <div class="vm-icon-box">
            <i data-lucide="target"></i>
          </div>
          <h3>Mission</h3>
          <p>To empower schools with the knowledge, tools, frameworks, partnerships, and strategies needed to build sustainable counselling and wellbeing systems that support students, strengthen staff capacity, engage parents, and improve educational outcomes.</p>
        </div>
      </div>

      <div class="tscc-why-matters">
        <h3>Why TSCC Matters</h3>
        <p style="margin-bottom:0">Modern schools face increasingly complex challenges — student behavioural and emotional concerns, mental health challenges, teacher burnout, parent engagement difficulties, bullying, digital safety concerns, and crisis management needs. TSCC addresses these by promoting counselling as a strategic educational tool rather than a reactive intervention.</p>
      </div>

      <h2 class="stitle" style="font-size:1.8rem;text-align:center;margin:4.5rem 0 1.5rem">Strategic Objectives</h2>
      <div class="objectives-grid">
        <div class="obj-card interactive-card">
          <span class="obj-card-num">01</span>
          <div class="obj-card-icon"><i data-lucide="arrow-up-right"></i></div>
          <h4>Reposition Counselling</h4>
          <p>Promote counselling as a critical component of school management and educational effectiveness.</p>
        </div>
        <div class="obj-card interactive-card">
          <span class="obj-card-num">02</span>
          <div class="obj-card-icon"><i data-lucide="heart"></i></div>
          <h4>Strengthen Systems</h4>
          <p>Equip schools with practical frameworks for implementing counselling and psychosocial support structures.</p>
        </div>
        <div class="obj-card interactive-card">
          <span class="obj-card-num">03</span>
          <div class="obj-card-icon"><i data-lucide="graduation-cap"></i></div>
          <h4>Build Capacity</h4>
          <p>Develop competencies of school leaders, counsellors, teachers, parents, and stakeholders.</p>
        </div>
        <div class="obj-card interactive-card">
          <span class="obj-card-num">04</span>
          <div class="obj-card-icon"><i data-lucide="bar-chart-3"></i></div>
          <h4>Evidence-Based</h4>
          <p>Encourage data-driven approaches, assessments, and measurable outcomes in counselling interventions.</p>
        </div>
        <div class="obj-card interactive-card">
          <span class="obj-card-num">05</span>
          <div class="obj-card-icon"><i data-lucide="handshake"></i></div>
          <h4>Strategic Partnerships</h4>
          <p>Create collaboration opportunities among schools, government agencies, NGOs, and corporate organizations.</p>
        </div>
        <div class="obj-card interactive-card">
          <span class="obj-card-num">06</span>
          <div class="obj-card-icon"><i data-lucide="landmark"></i></div>
          <h4>Influence Policy</h4>
          <p>Contribute to conversations around educational reform, student wellbeing, and psychosocial support systems.</p>
        </div>
      </div>

      <h2 class="stitle" style="font-size:1.8rem;text-align:center;margin:4rem 0 1.5rem">Target Audience</h2>
      <div class="audience-grid">
        <div class="audience-card">
          <div class="audience-card-header">
            <i data-lucide="user-check" class="audience-card-icon"></i>
            <h4>School Leadership</h4>
          </div>
          <ul>
            <li><i data-lucide="chevron-right"></i>School Owners & Proprietors</li>
            <li><i data-lucide="chevron-right"></i>Principals & Vice Principals</li>
            <li><i data-lucide="chevron-right"></i>School Administrators</li>
          </ul>
        </div>
        <div class="audience-card">
          <div class="audience-card-header">
            <i data-lucide="brain" class="audience-card-icon"></i>
            <h4>Counsellors</h4>
          </div>
          <ul>
            <li><i data-lucide="chevron-right"></i>School Counsellors</li>
            <li><i data-lucide="chevron-right"></i>Educational Psychologists</li>
            <li><i data-lucide="chevron-right"></i>Mental Health Practitioners</li>
            <li><i data-lucide="chevron-right"></i>Social Workers</li>
          </ul>
        </div>
        <div class="audience-card">
          <div class="audience-card-header">
            <i data-lucide="users" class="audience-card-icon"></i>
            <h4>Stakeholders</h4>
          </div>
          <ul>
            <li><i data-lucide="chevron-right"></i>Teachers & Educators</li>
            <li><i data-lucide="chevron-right"></i>Parents & PTA Executives</li>
            <li><i data-lucide="chevron-right"></i>Government & NGOs</li>
            <li><i data-lucide="chevron-right"></i>Development Partners</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── EVENT GALLERY (Bento Grid) ── -->
<section class="tscc-gallery-sec">
  <div class="wrap">
    <div class="reveal" style="text-align:center">
      <div class="eyebrow" style="justify-content:center;color:var(--orange)">Photo Highlights</div>
      <h2 class="stitle">TSCC Moments & Memories</h2>
      <p class="slead" style="margin:0 auto">Capturing the energy, learning, and connections that make TSCC a transformative experience.</p>
    </div>
    
    <div class="gallery-grid reveal-stagger">
      <div class="gallery-item gi-large">
        <img src="{{ asset('tscc-images/IMG_8792.JPG') }}" alt="TSCC Conference - Keynote Session" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">TSCC Keynote Session</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8829.JPG') }}" alt="TSCC Conference - Workshop Session" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Interactive Workshop</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8698.JPG') }}" alt="TSCC Conference - Networking" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Delegate Connections</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item gi-wide">
        <img src="{{ asset('tscc-images/IMG_8655.JPG') }}" alt="TSCC Conference - Panel Discussion" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Panel Discussion</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8635.JPG') }}" alt="TSCC Conference - Delegate Engagement" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Attendee Engagement</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8627.JPG') }}" alt="TSCC Conference - Audience Session" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Audience Session</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8598.JPG') }}" alt="TSCC Conference - Expert Presenter" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Expert Presenters</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item gi-wide">
        <img src="{{ asset('tscc-images/IMG_8590.JPG') }}" alt="TSCC Conference - Exhibition" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Resource Exhibition</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8585.JPG') }}" alt="TSCC Conference - Networking Break" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Networking Break</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8580.JPG') }}" alt="TSCC Conference - Table Discussion" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Table Discussion</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8572.JPG') }}" alt="TSCC Conference - Keynote Stage" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Keynote Stage</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item gi-tall">
        <img src="{{ asset('tscc-images/IMG_7087.JPG') }}" alt="TSCC Conference - Awards ceremony" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Awards Ceremony</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_7049.JPG') }}" alt="TSCC Conference - Closing Session" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Closing Remarks</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item gi-wide">
        <img src="{{ asset('tscc-images/IMG_7048.JPG') }}" alt="TSCC Conference - Group Photo" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Participant Group Photo</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
      <div class="gallery-item">
        <img src="{{ asset('tscc-images/IMG_8576.JPG') }}" alt="TSCC Conference - Team Collaboration" loading="lazy">
        <div class="gallery-hover-info">
          <span class="gallery-hover-title">Team Collaboration</span>
          <div class="gallery-hover-btn"><i data-lucide="maximize-2"></i></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Lightbox Markup -->
<div id="galleryLightbox" class="lightbox">
  <span class="lightbox-close"><i data-lucide="x"></i></span>
  <button class="lightbox-prev" aria-label="Previous image"><i data-lucide="chevron-left"></i></button>
  <img class="lightbox-content" id="lightboxImg" src="" alt="">
  <div class="lightbox-caption" id="lightboxCaption"></div>
  <button class="lightbox-next" aria-label="Next image"><i data-lucide="chevron-right"></i></button>
</div>

<!-- ── WHY TSCC ── -->
<section class="tscc-why">
  <div class="wrap">
    <div class="reveal">
      <div class="eyebrow" style="color:var(--orange)">Why Attend</div>
      <h2 class="stitle">What Makes TSCC Special</h2>
      <p class="slead">TSCC is more than a conference — it is a growing movement to elevate school counselling as a national priority in Nigeria.</p>
    </div>
    
    <div class="feat-grid reveal-stagger">
      <div class="feat-card interactive-card">
        <div class="feat-icon-wrapper">
          <i data-lucide="mic"></i>
        </div>
        <h4>Expert Keynotes</h4>
        <p>World-class speakers from mental health, education, and policy — delivering cutting-edge insights you can apply immediately.</p>
      </div>
      <div class="feat-card interactive-card">
        <div class="feat-icon-wrapper">
          <i data-lucide="wrench"></i>
        </div>
        <h4>Skills Workshops</h4>
        <p>Practical, hands-on sessions that build your counselling toolkit with evidence-based techniques and culturally-relevant approaches.</p>
      </div>
      <div class="feat-card interactive-card">
        <div class="feat-icon-wrapper">
          <i data-lucide="users"></i>
        </div>
        <h4>Networking & Community</h4>
        <p>Connect with hundreds of counsellors, educators, and advocates — building the professional relationships that sustain your practice.</p>
      </div>
      <div class="feat-card interactive-card">
        <div class="feat-icon-wrapper">
          <i data-lucide="award"></i>
        </div>
        <h4>CPD Certification</h4>
        <p>Earn certified professional development hours recognised by national counselling bodies — advancing your career credentials.</p>
      </div>
      <div class="feat-card interactive-card">
        <div class="feat-icon-wrapper">
          <i data-lucide="landmark"></i>
        </div>
        <h4>Policy & Advocacy</h4>
        <p>Engage with policy makers and sector leaders to drive systemic change — turning conference energy into national reform.</p>
      </div>
      <div class="feat-card interactive-card">
        <div class="feat-icon-wrapper">
          <i data-lucide="presentation"></i>
        </div>
        <h4>Resource Exhibition</h4>
        <p>Discover the latest tools, technologies, and resources for school counselling — all curated for the Nigerian education context.</p>
      </div>
    </div>
  </div>
</section>

<!-- ── SPONSORSHIP TIERS ── -->
<section class="sponsor-sec">
  <div class="wrap">
    <div class="reveal" style="text-align:center">
      <div class="eyebrow" style="justify-content:center;color:var(--orange)">Partner With Us</div>
      <h2 class="stitle">Sponsorship Packages</h2>
      <p class="slead" style="margin:0 auto">Position your brand at Nigeria's most impactful school counselling event.</p>
    </div>
    
    <div class="tier-grid reveal-stagger">
      <div class="tier-card tc-bronze interactive-card">
        <div>
          <i data-lucide="shield" class="tier-header-icon"></i>
          <div class="tier-badge tb-bronze">
            <i data-lucide="shield"></i> Bronze
          </div>
          <h3>Community Partner</h3>
          <div class="tier-price-box">
            <p class="tier-price">Supporting Package</p>
          </div>
          <ul class="tier-list">
            <li><i data-lucide="check"></i>Logo on event materials</li>
            <li><i data-lucide="check"></i>2 delegate passes</li>
            <li><i data-lucide="check"></i>Social media mention</li>
            <li><i data-lucide="check"></i>Exhibition table space</li>
          </ul>
        </div>
        <a href="{{ route('contact') }}" class="tier-cta-btn">Enquire Now</a>
      </div>
      
      <div class="tier-card tc-silver interactive-card">
        <div>
          <i data-lucide="sparkles" class="tier-header-icon"></i>
          <div class="tier-badge tb-silver">
            <i data-lucide="sparkles"></i> Silver
          </div>
          <h3>Impact Partner</h3>
          <div class="tier-price-box">
            <p class="tier-price">Prominent Package</p>
          </div>
          <ul class="tier-list">
            <li><i data-lucide="check"></i>All Bronze benefits</li>
            <li><i data-lucide="check"></i>5 delegate passes</li>
            <li><i data-lucide="check"></i>Speaking slot (15 mins)</li>
            <li><i data-lucide="check"></i>Conference bag insert</li>
            <li><i data-lucide="check"></i>Website feature</li>
          </ul>
        </div>
        <a href="{{ route('contact') }}" class="tier-cta-btn">Enquire Now</a>
      </div>
      
      <div class="tier-card tc-gold interactive-card">
        <div>
          <i data-lucide="crown" class="tier-header-icon"></i>
          <div class="tier-badge tb-gold">
            <i data-lucide="crown"></i> Gold
          </div>
          <h3>Title Sponsor</h3>
          <div class="tier-price-box">
            <p class="tier-price">Premium Flagship Package</p>
          </div>
          <ul class="tier-list">
            <li><i data-lucide="check"></i>All Silver benefits</li>
            <li><i data-lucide="check"></i>10 delegate passes</li>
            <li><i data-lucide="check"></i>Keynote session naming rights</li>
            <li><i data-lucide="check"></i>Opening ceremony mention</li>
            <li><i data-lucide="check"></i>Priority exhibition placement</li>
            <li><i data-lucide="check"></i>Full-page programme feature</li>
          </ul>
        </div>
        <a href="{{ route('contact') }}" class="tier-cta-btn">Become Title Sponsor</a>
      </div>
    </div>
  </div>
</section>

<!-- ── PAST EDITIONS (Timeline) ── -->
<section class="editions-sec">
  <div class="wrap">
    <div class="editions-container">
      <div class="reveal">
        <div class="eyebrow" style="color:rgba(255,255,255,.35)">Our Journey</div>
        <h2 class="stitle wh">Past TSCC Editions</h2>
      </div>
      
      <div class="editions-list reveal-stagger">
        <div class="edition-row">
          <div class="edition-year">2024</div>
          <div class="edition-body">
            <span class="edition-title">TSCC VI — Resilience & Recovery in Schools</span>
            <span class="edition-tag">Lagos · 400+ Delegates</span>
          </div>
        </div>
        <div class="edition-row">
          <div class="edition-year">2023</div>
          <div class="edition-body">
            <span class="edition-title">TSCC V — The Future of School Counselling</span>
            <span class="edition-tag">Lagos · 350+ Delegates</span>
          </div>
        </div>
        <div class="edition-row">
          <div class="edition-year">2022</div>
          <div class="edition-body">
            <span class="edition-title">TSCC IV — Post-Pandemic Wellbeing</span>
            <span class="edition-tag">Hybrid · 500+ Delegates</span>
          </div>
        </div>
        <div class="edition-row">
          <div class="edition-year">2021</div>
          <div class="edition-body">
            <span class="edition-title">TSCC III — Mental Health in a Digital Age</span>
            <span class="edition-tag">Virtual · 600+ Delegates</span>
          </div>
        </div>
        <div class="edition-row">
          <div class="edition-year">2020</div>
          <div class="edition-body">
            <span class="edition-title">TSCC II — Building Psychologically Safe Schools</span>
            <span class="edition-tag">Lagos · 250+ Delegates</span>
          </div>
        </div>
        <div class="edition-row">
          <div class="edition-year">2019</div>
          <div class="edition-body">
            <span class="edition-title">TSCC I — Counselling at the Heart of Education</span>
            <span class="edition-tag">Lagos · 180 Delegates</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── REGISTER CTA ── -->
<section class="tscc-cta">
  <div class="reveal" style="position:relative;z-index:1">
    <h2 style="font-family:var(--font-h);color:#fff;font-size:clamp(2rem,4vw,3rem);font-weight:900;letter-spacing:-1px;margin-bottom:1rem">Be Part of TSCC 2025</h2>
    <p style="color:rgba(255,255,255,.7);font-size:1rem;font-weight:300;max-width:440px;margin:0 auto 2.5rem;line-height:1.85">Join hundreds of school counsellors, educators, and mental health advocates shaping the future of wellbeing in Nigerian schools.</p>
    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap">
      <a href="{{ route('contact') }}" class="btn-wh">Register Interest</a>
      <a href="{{ route('contact') }}" style="display:inline-block;padding:13px 30px;border:1.5px solid rgba(255,255,255,.5);color:#fff;font-size:14px;font-weight:500;border-radius:8px;transition:all .25s">Sponsor TSCC</a>
    </div>
  </div>
</section>

<!-- ── CONNECT WITH US ── -->
<section class="social-links-sec">
  <div class="wrap reveal" style="position:relative;z-index:1">
    <h3 style="font-family:var(--font-h);color:rgba(255,255,255,.85);font-size:1.3rem;font-weight:700;margin:0 0 1rem">Stay Connected</h3>
    <p style="color:rgba(255,255,255,.55);font-size:.95rem;margin-bottom:1.5rem">Follow TSCC on social media for updates, speaker announcements, and event highlights.</p>
    <div class="social-btns">
      <a href="https://www.facebook.com/profile.php?id=100063916400380" target="_blank" class="social-btn sb-facebook">
        <i data-lucide="facebook"></i> Facebook
      </a>
      <a href="https://www.instagram.com/tscc2026" target="_blank" class="social-btn sb-instagram">
        <i data-lucide="instagram"></i> Instagram
      </a>
      <a href="https://x.com/Theschoolcon" target="_blank" class="social-btn sb-twitter">
        <i data-lucide="twitter"></i> X (Twitter)
      </a>
      <a href="https://www.tiktok.com/@theschoolcounsellingcon0" target="_blank" class="social-btn sb-tiktok">
        <i data-lucide="music"></i> TikTok
      </a>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  // Lightbox Implementation
  const galleryItems = document.querySelectorAll('.gallery-item');
  const lightbox = document.getElementById('galleryLightbox');
  const lightboxImg = document.getElementById('lightboxImg');
  const lightboxCaption = document.getElementById('lightboxCaption');
  const lightboxClose = document.querySelector('.lightbox-close');
  const lightboxPrev = document.querySelector('.lightbox-prev');
  const lightboxNext = document.querySelector('.lightbox-next');
  
  let currentIndex = 0;
  const images = Array.from(galleryItems).map(item => {
    const img = item.querySelector('img');
    return {
      src: img.src,
      alt: img.alt
    };
  });
  
  function showImage(index) {
    if (index < 0) index = images.length - 1;
    if (index >= images.length) index = 0;
    currentIndex = index;
    
    lightboxImg.src = images[currentIndex].src;
    lightboxCaption.textContent = images[currentIndex].alt;
  }
  
  galleryItems.forEach((item, index) => {
    item.addEventListener('click', () => {
      lightbox.classList.add('active');
      document.body.style.overflow = 'hidden';
      showImage(index);
    });
  });
  
  const closeLightbox = () => {
    lightbox.classList.remove('active');
    document.body.style.overflow = '';
  };
  
  lightboxClose.addEventListener('click', closeLightbox);
  
  lightboxPrev.addEventListener('click', (e) => {
    e.stopPropagation();
    showImage(currentIndex - 1);
  });
  
  lightboxNext.addEventListener('click', (e) => {
    e.stopPropagation();
    showImage(currentIndex + 1);
  });
  
  lightbox.addEventListener('click', closeLightbox);
  
  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('active')) return;
    if (e.key === 'Escape') {
      closeLightbox();
    } else if (e.key === 'ArrowLeft') {
      showImage(currentIndex - 1);
    } else if (e.key === 'ArrowRight') {
      showImage(currentIndex + 1);
    }
  });

  // Hero Portrait Mouse Tilt Effect
  const wrapper = document.querySelector('.hero-image-wrapper');
  if (wrapper) {
    wrapper.addEventListener('mousemove', (e) => {
      const rect = wrapper.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;
      
      const rotateX = -(y / rect.height) * 20; 
      const rotateY = (x / rect.width) * 20; 
      
      wrapper.style.transform = `rotateY(${rotateY}deg) rotateX(${rotateX}deg) scale(1.05)`;
    });

    wrapper.addEventListener('mouseleave', () => {
      wrapper.style.transform = 'rotateY(-6deg) rotateX(4deg) scale(1)';
    });
  }

  // Page-Wide Interactive Cards Mouse Tilt Controller
  const interactiveCards = document.querySelectorAll('.interactive-card');
  interactiveCards.forEach(card => {
    card.addEventListener('mousemove', (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;
      
      // Calculate rotation angles (up to 15 degrees)
      const rotateX = -(y / rect.height) * 15;
      const rotateY = (x / rect.width) * 15;
      
      card.style.transform = `perspective(1000px) rotateY(${rotateY}deg) rotateX(${rotateX}deg) scale(1.03)`;
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'perspective(1000px) rotateY(0deg) rotateX(0deg) scale(1)';
    });
  });
});
</script>
@endsection
