@extends('layouts.app')
@section('title', 'Gallery')
@section('meta_desc', 'Moments of impact — a visual story of TREC\'s work across conferences, workshops, counselling sessions, and the communities we serve.')

@section('styles')
<style>
/* ── HERO ── */
.gal-hero{
  background:var(--black);padding:7rem 2rem 5.5rem;
  position:relative;overflow:hidden;
}
.gal-hero-bar{position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))}
.gal-hero-bg{
  position:absolute;inset:0;
  background:radial-gradient(ellipse 60% 70% at 80% 50%,rgba(229,105,24,.12),transparent 60%);
}
.gal-hero h1{font-family:var(--font-display);font-size:clamp(2.8rem,5vw,4.2rem);font-weight:400;color:#fff;line-height:1.0;letter-spacing:-2px;margin-bottom:1rem}
.gal-hero p{font-size:1.05rem;font-weight:300;color:rgba(255,255,255,.5);max-width:520px;line-height:1.9}

/* ── FILTERS ── */
.gal-filter-bar{
  background:var(--white);border-bottom:1px solid var(--mid);
  padding:1.25rem 2rem;position:sticky;top:70px;z-index:100;
}
.gal-filters{
  max-width:1200px;margin:0 auto;
  display:flex;align-items:center;gap:.75rem;flex-wrap:wrap;
}
.gal-filter-btn{
  font-size:12px;font-weight:600;letter-spacing:.5px;
  padding:8px 18px;border-radius:100px;border:1.5px solid var(--mid);
  background:transparent;color:var(--charcoal);cursor:pointer;
  transition:all .2s;white-space:nowrap;
}
.gal-filter-btn:hover{border-color:var(--charcoal);color:var(--black)}
.gal-filter-btn.act{background:var(--black);border-color:var(--black);color:#fff}
.gal-count{margin-left:auto;font-size:12px;color:var(--charcoal);opacity:.5;font-weight:400}

/* ── GALLERY GRID ── */
.gal-body{max-width:1200px;margin:0 auto;padding:3rem 2rem 5rem}

.gal-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  grid-auto-rows:220px;
  gap:1rem;
}

/* Masonry size variants — applied by JS round-robin */
.gal-item{
  position:relative;overflow:hidden;border-radius:12px;cursor:pointer;
  background:var(--light);
  transition:transform .35s cubic-bezier(.22,1,.36,1), box-shadow .35s;
}
.gal-item:hover{transform:scale(1.02);box-shadow:0 20px 60px rgba(0,0,0,.18);z-index:2}
.gal-item.tall{grid-row:span 2}
.gal-item.wide{grid-column:span 2}
.gal-item.big{grid-column:span 2;grid-row:span 2}

/* ── SKELETON SHIMMER ── */
@keyframes shimmer{
  0%{background-position:-800px 0}
  100%{background-position:800px 0}
}
.gal-skeleton{
  position:absolute;inset:0;
  background:linear-gradient(90deg,#e8e8e8 25%,#f5f5f5 50%,#e8e8e8 75%);
  background-size:800px 100%;
  animation:shimmer 1.4s infinite linear;
  border-radius:inherit;
  z-index:1;
  transition:opacity .4s ease;
}

/* Real image — hidden until loaded */
.gal-item img.gal-img{
  position:absolute;top:0;left:0;width:100%;height:100%;
  object-fit:cover;z-index:2;
  opacity:0;
  transition:opacity .5s ease, transform .45s cubic-bezier(.22,1,.36,1);
}
.gal-item img.gal-img.loaded{opacity:1}
.gal-item:hover img.gal-img{transform:scale(1.07)}

/* Hide skeleton once image loads */
.gal-item.img-ready .gal-skeleton{opacity:0;pointer-events:none}

/* Overlay label */
.gal-overlay{
  position:absolute;inset:0;
  background:linear-gradient(to top,rgba(13,13,13,.78) 0%,transparent 55%);
  opacity:0;transition:opacity .3s;
  display:flex;align-items:flex-end;
  padding:1.25rem;z-index:3;
}
.gal-item:hover .gal-overlay{opacity:1}
.gal-label{
  color:#fff;font-size:13px;font-weight:500;
  display:flex;align-items:center;gap:.5rem;
  text-shadow:0 1px 4px rgba(0,0,0,.5);
}
.gal-cat-dot{width:6px;height:6px;border-radius:50%;background:var(--orange);flex-shrink:0}

/* No images state */
.gal-empty{
  grid-column:1/-1;text-align:center;padding:5rem 2rem;
}
.gal-empty-icon{font-size:4rem;margin-bottom:1rem;opacity:.3}
.gal-empty p{font-size:1rem;color:var(--charcoal);font-weight:300;margin-bottom:1.5rem}
.gal-empty a{display:inline-block;padding:10px 24px;border:1.5px solid var(--charcoal);border-radius:100px;font-size:13px;font-weight:600;color:var(--charcoal);text-decoration:none;transition:all .2s}
.gal-empty a:hover{background:var(--black);color:#fff;border-color:var(--black)}

/* Setup notice */
.gal-notice{
  background:#fff8e7;border:1.5px solid #f59e0b;border-radius:12px;
  padding:1.5rem 2rem;margin-bottom:2rem;
  display:flex;gap:1rem;align-items:flex-start;
}
.gal-notice-icon{font-size:1.5rem;flex-shrink:0;line-height:1}
.gal-notice h4{font-size:.9rem;font-weight:700;color:#92400e;margin:0 0 .4rem}
.gal-notice p{font-size:.85rem;color:#78350f;margin:0;line-height:1.6}
.gal-notice code{background:rgba(0,0,0,.07);padding:1px 6px;border-radius:4px;font-size:.8rem;font-family:monospace}

/* ── LIGHTBOX ── */
.lightbox{
  position:fixed;inset:0;z-index:9000;
  background:rgba(13,13,13,.96);
  display:flex;align-items:center;justify-content:center;
  opacity:0;pointer-events:none;
  transition:opacity .3s;
}
.lightbox.open{opacity:1;pointer-events:all}
.lb-close{
  position:absolute;top:1.5rem;right:1.5rem;
  width:44px;height:44px;border-radius:50%;
  background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);
  color:#fff;font-size:1.25rem;cursor:pointer;
  display:flex;align-items:center;justify-content:center;
  transition:background .2s;
}
.lb-close:hover{background:var(--red)}
.lb-wrap{
  position:relative;
  max-width:90vw;max-height:88vh;
  display:flex;align-items:center;justify-content:center;
}
.lb-wrap img{
  max-width:90vw;max-height:85vh;
  border-radius:10px;
  object-fit:contain;
  box-shadow:0 40px 100px rgba(0,0,0,.6);
  display:block;
}
.lb-spinner{
  width:40px;height:40px;border-radius:50%;
  border:3px solid rgba(255,255,255,.15);
  border-top-color:#fff;
  animation:spin .7s linear infinite;
}
@keyframes spin{to{transform:rotate(360deg)}}
.lb-caption{
  position:absolute;bottom:-2.5rem;left:0;right:0;
  text-align:center;color:rgba(255,255,255,.55);
  font-size:13px;font-weight:400;
}

/* Staggered reveal */
@keyframes fadeUp{
  from{opacity:0;transform:translateY(20px)}
  to{opacity:1;transform:translateY(0)}
}
.gal-item.reveal-item{
  opacity:0;animation:fadeUp .5s forwards;
}

@media(max-width:960px){
  .gal-grid{grid-template-columns:repeat(3,1fr);grid-auto-rows:200px}
  .gal-item.big{grid-column:span 2}
}
@media(max-width:600px){
  .gal-grid{grid-template-columns:repeat(2,1fr);grid-auto-rows:160px}
  .gal-item.big,.gal-item.wide{grid-column:span 2}
  .gal-item.tall{grid-row:span 2}
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
<div class="gal-hero">
  <div class="gal-hero-bar"></div>
  <div class="gal-hero-bg"></div>
  <div class="wrap" style="position:relative;z-index:2">
    <div class="eyebrow reveal" style="color:var(--orange)">Gallery</div>
    <h1 class="reveal" style="transition-delay:.1s">Moments of Impact</h1>
    <p class="reveal" style="transition-delay:.2s">A visual story of TREC's work — conferences, workshops, counselling sessions, and the communities we're honoured to serve.</p>
  </div>
</div>

<!-- ── FILTER BAR ── -->
<div class="gal-filter-bar">
  <div class="gal-filters">
    <button class="gal-filter-btn act" data-filter="all" id="filterAll">All</button>
    <button class="gal-filter-btn" data-filter="conference">Conferences</button>
    <button class="gal-filter-btn" data-filter="workshop">Workshops</button>
    <button class="gal-filter-btn" data-filter="community">Community</button>
    <button class="gal-filter-btn" data-filter="team">Our Team</button>
    <span class="gal-count" id="galCount"></span>
  </div>
</div>

<!-- ── GALLERY BODY ── -->
<div class="gal-body">

  @php
    // Size pattern cycles across grid items for masonry variety
    $sizes  = ['', 'tall', '', '', 'wide', '', 'big', '', 'tall', '', 'wide', ''];
    $apiKey = config('services.google_drive.api_key');
  @endphp

  {{-- Setup notice when no API key is configured --}}
  @if(!$apiKey)
  <div class="gal-notice">
    <div class="gal-notice-icon">⚠️</div>
    <div>
      <h4>Google Drive API Key Required</h4>
      <p>
        Add your free key to <code>.env</code>: &nbsp;<code>GOOGLE_DRIVE_API_KEY=your_key_here</code><br>
        Get one free in 2 minutes at
        <a href="https://console.cloud.google.com/apis/credentials" target="_blank" rel="noopener" style="color:#92400e">Google Cloud Console</a>
        → Enable "Google Drive API" → Create Credentials → API Key.
        <br>Then run: <code>php artisan cache:clear</code>
      </p>
    </div>
  </div>
  @endif

  @if(!empty($galleryImages))
  <div class="gal-grid" id="galGrid">
    @foreach($galleryImages as $i => $img)
    @php $size = $sizes[$i % count($sizes)]; @endphp
    <div class="gal-item reveal-item {{ $size }}"
         data-cat="all"
         data-full="{{ $img['full'] }}"
         data-label="{{ $img['label'] }}"
         style="animation-delay:{{ min($i * 60, 600) }}ms">
      <div class="gal-skeleton"></div>
      <img class="gal-img"
           src="{{ $img['thumb'] }}"
           alt="{{ $img['label'] }}"
           loading="lazy"
           decoding="async">
      <div class="gal-overlay">
        <div class="gal-label"><span class="gal-cat-dot"></span>{{ $img['label'] }}</div>
      </div>
    </div>
    @endforeach
  </div>

  @else
  <div class="gal-grid" id="galGrid">
    <div class="gal-empty">
      <div class="gal-empty-icon">🖼️</div>
      @if($apiKey)
        <p>No images found in the configured Google Drive folder.<br>Make sure the folder is shared publicly and contains images.</p>
        <a href="{{ route('gallery') }}">↺ &nbsp;Refresh</a>
      @else
        <p>Configure your Google Drive API key to display images here.</p>
      @endif
    </div>
  </div>
  @endif

</div>

<!-- ── LIGHTBOX ── -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Image viewer">
  <button class="lb-close" id="lbClose" aria-label="Close">✕</button>
  <div class="lb-wrap" id="lbWrap">
    <div class="lb-spinner" id="lbSpinner"></div>
  </div>
</div>

@endsection

@section('scripts')
<script>
// ── IMAGE SKELETON / LAZY LOAD REVEAL ──────────────────────────────────
document.querySelectorAll('.gal-img').forEach(img => {
  const item = img.closest('.gal-item');
  const onLoad = () => {
    img.classList.add('loaded');
    item.classList.add('img-ready');
  };
  if (img.complete && img.naturalWidth) {
    onLoad();
  } else {
    img.addEventListener('load', onLoad);
    img.addEventListener('error', () => {
      // Hide skeleton even on error
      item.classList.add('img-ready');
    });
  }
});

// ── FILTERS ────────────────────────────────────────────────────────────
const filterBtns = document.querySelectorAll('.gal-filter-btn');
const galItems   = document.querySelectorAll('.gal-item');
const galCount   = document.getElementById('galCount');

function updateCount() {
  const visible = [...galItems].filter(i => i.style.display !== 'none').length;
  galCount.textContent = visible + ' photo' + (visible !== 1 ? 's' : '');
}

filterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    filterBtns.forEach(b => b.classList.remove('act'));
    btn.classList.add('act');
    const cat = btn.dataset.filter;
    galItems.forEach(item => {
      const show = cat === 'all' || item.dataset.cat === cat;
      item.style.display = show ? '' : 'none';
    });
    updateCount();
  });
});
updateCount();

// ── LIGHTBOX ────────────────────────────────────────────────────────────
const lightbox  = document.getElementById('lightbox');
const lbWrap    = document.getElementById('lbWrap');
const lbSpinner = document.getElementById('lbSpinner');

function openLightbox(fullUrl, label) {
  // Show spinner
  lbWrap.innerHTML = '<div class="lb-spinner"></div>';
  lightbox.classList.add('open');
  document.body.style.overflow = 'hidden';

  const img = new Image();
  img.onload = () => {
    lbWrap.innerHTML = '';
    img.className = '';
    lbWrap.appendChild(img);
    if (label) {
      const cap = document.createElement('div');
      cap.className = 'lb-caption';
      cap.textContent = label;
      lbWrap.appendChild(cap);
    }
  };
  img.onerror = () => {
    lbWrap.innerHTML = '<p style="color:rgba(255,255,255,.5);padding:2rem">Could not load full image.</p>';
  };
  img.src = fullUrl;
}

function closeLightbox() {
  lightbox.classList.remove('open');
  document.body.style.overflow = '';
  lbWrap.innerHTML = '';
}

document.getElementById('lbClose').addEventListener('click', closeLightbox);
lightbox.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

galItems.forEach(item => {
  item.addEventListener('click', () => {
    const fullUrl = item.dataset.full;
    const label   = item.dataset.label;
    if (fullUrl) openLightbox(fullUrl, label);
  });
});
</script>
@endsection
