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
.gal-hero h1{font-family:var(--font-h);font-size:clamp(2.8rem,5vw,4.2rem);font-weight:900;color:#fff;line-height:1.0;letter-spacing:-2px;margin-bottom:1rem}
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

/* Masonry-style with CSS Grid spanning */
.gal-grid{
  display:grid;
  grid-template-columns:repeat(4,1fr);
  grid-auto-rows:200px;
  gap:1rem;
}
.gal-item{
  position:relative;overflow:hidden;border-radius:10px;cursor:pointer;
  background:var(--light);
  transition:transform .35s var(--ease);
}
.gal-item:hover{transform:scale(1.02);z-index:2}
.gal-item.tall{grid-row:span 2}
.gal-item.wide{grid-column:span 2}
.gal-item.big{grid-column:span 2;grid-row:span 2}

.gal-thumb{
  width:100%;height:100%;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-h);font-size:3.5rem;font-weight:900;
  letter-spacing:-2px;color:rgba(255,255,255,.18);
  transition:transform .45s var(--ease);
}
.gal-item:hover .gal-thumb{transform:scale(1.08)}

.gal-overlay{
  position:absolute;inset:0;
  background:linear-gradient(to top,rgba(13,13,13,.75) 0%,transparent 55%);
  opacity:0;transition:opacity .3s;
  display:flex;align-items:flex-end;
  padding:1.25rem;
}
.gal-item:hover .gal-overlay{opacity:1}
.gal-label{
  color:#fff;font-size:13px;font-weight:500;
  display:flex;align-items:center;gap:.5rem;
}
.gal-cat-dot{width:6px;height:6px;border-radius:50%;background:var(--orange);flex-shrink:0}

/* Empty state */
.gal-empty{text-align:center;padding:5rem 2rem;grid-column:1/-1}
.gal-empty p{font-size:1rem;color:var(--charcoal);font-weight:300;margin-bottom:1.5rem}

/* ── LIGHTBOX ── */
.lightbox{
  position:fixed;inset:0;z-index:9000;
  background:rgba(13,13,13,.95);
  display:flex;align-items:center;justify-content:center;
  opacity:0;pointer-events:none;transition:opacity .3s;
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
.lb-content{
  max-width:800px;width:90%;max-height:80vh;
  border-radius:12px;overflow:hidden;
  background:var(--charcoal);
  display:flex;align-items:center;justify-content:center;
}
.lb-thumb{
  width:100%;min-height:400px;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-h);font-size:6rem;font-weight:900;
  color:rgba(255,255,255,.15);
}

@media(max-width:960px){
  .gal-grid{grid-template-columns:repeat(3,1fr)}
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

<!-- ── GALLERY GRID ── -->
<div class="gal-body">
  @php
    $placeholders = [
      ['label'=>'TSCC 2024 Opening Ceremony','cat'=>'conference','color1'=>'#D82D37','color2'=>'#E56918','size'=>'big','letter'=>'T'],
      ['label'=>'Group Counselling Session','cat'=>'workshop','color1'=>'#6B8F1A','color2'=>'#8fc430','size'=>'tall','letter'=>'G'],
      ['label'=>'Corporate Training — EQ Workshop','cat'=>'workshop','color1'=>'#E56918','color2'=>'#f59e0b','size'=>'','letter'=>'C'],
      ['label'=>'TSCC 2023 Keynote Address','cat'=>'conference','color1'=>'#0D0D0D','color2'=>'#414042','size'=>'','letter'=>'K'],
      ['label'=>'School Wellbeing Visit — Lagos','cat'=>'community','color1'=>'#6B8F1A','color2'=>'#D82D37','size'=>'wide','letter'=>'S'],
      ['label'=>'Parenting Workshop Graduates','cat'=>'workshop','color1'=>'#E56918','color2'=>'#6B8F1A','size'=>'','letter'=>'P'],
      ['label'=>'TSCC Panel Discussion','cat'=>'conference','color1'=>'#D82D37','color2'=>'#0D0D0D','size'=>'tall','letter'=>'P'],
      ['label'=>'Community Mental Health Day','cat'=>'community','color1'=>'#779B1C','color2'=>'#E56918','size'=>'','letter'=>'M'],
      ['label'=>'TREC Team at Work','cat'=>'team','color1'=>'#414042','color2'=>'#0D0D0D','size'=>'','letter'=>'T'],
      ['label'=>'TSCC 2022 — Virtual Edition','cat'=>'conference','color1'=>'#D82D37','color2'=>'#E56918','size'=>'wide','letter'=>'V'],
      ['label'=>'School Staff Training Day','cat'=>'workshop','color1'=>'#6B8F1A','color2'=>'#779B1C','size'=>'','letter'=>'S'],
      ['label'=>'Counselling Team','cat'=>'team','color1'=>'#0D0D0D','color2'=>'#414042','size'=>'','letter'=>'C'],
    ];
  @endphp

  @if(isset($galleryItems) && $galleryItems->count() > 0)
  <div class="gal-grid" id="galGrid">
    @foreach($galleryItems as $item)
    <div class="gal-item" data-cat="{{ strtolower($item->category ?? 'all') }}" style="background:linear-gradient(135deg,{{ $item->color1 }},{{ $item->color2 }})">
      <div class="gal-thumb">{{ strtoupper(substr($item->label, 0, 1)) }}</div>
      <div class="gal-overlay">
        <div class="gal-label"><span class="gal-cat-dot"></span>{{ $item->label }}</div>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <div class="gal-grid" id="galGrid">
    @foreach($placeholders as $ph)
    <div class="gal-item {{ $ph['size'] }}" data-cat="{{ $ph['cat'] }}"
         style="background:linear-gradient(135deg,{{ $ph['color1'] }},{{ $ph['color2'] }})">
      <div class="gal-thumb">{{ $ph['letter'] }}</div>
      <div class="gal-overlay">
        <div class="gal-label"><span class="gal-cat-dot"></span>{{ $ph['label'] }}</div>
      </div>
    </div>
    @endforeach
  </div>
  @endif

  <p id="galEmpty" style="display:none;text-align:center;padding:3rem;color:var(--charcoal);font-weight:300">No items in this category yet — check back soon.</p>
</div>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox">
  <button class="lb-close" id="lbClose" aria-label="Close">✕</button>
  <div class="lb-content">
    <div class="lb-thumb" id="lbThumb">T</div>
  </div>
</div>

@endsection

@section('scripts')
<script>
// ── GALLERY FILTERS
const filterBtns = document.querySelectorAll('.gal-filter-btn');
const galItems = document.querySelectorAll('.gal-item');
const galCount = document.getElementById('galCount');
const galEmpty = document.getElementById('galEmpty');

function updateCount() {
  const visible = [...galItems].filter(i => i.style.display !== 'none').length;
  galCount.textContent = visible + ' photo' + (visible !== 1 ? 's' : '');
}

filterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    filterBtns.forEach(b => b.classList.remove('act'));
    btn.classList.add('act');
    const cat = btn.dataset.filter;
    let anyVisible = false;
    galItems.forEach(item => {
      const show = cat === 'all' || item.dataset.cat === cat;
      item.style.display = show ? '' : 'none';
      if (show) anyVisible = true;
    });
    galEmpty.style.display = anyVisible ? 'none' : 'block';
    updateCount();
  });
});
updateCount();

// ── LIGHTBOX
const lightbox = document.getElementById('lightbox');
const lbThumb = document.getElementById('lbThumb');
document.getElementById('lbClose').addEventListener('click', () => lightbox.classList.remove('open'));
lightbox.addEventListener('click', e => { if (e.target === lightbox) lightbox.classList.remove('open'); });
galItems.forEach(item => {
  item.addEventListener('click', () => {
    const label = item.querySelector('.gal-label');
    lbThumb.textContent = item.querySelector('.gal-thumb').textContent;
    lbThumb.style.background = item.style.background;
    lightbox.classList.add('open');
  });
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') lightbox.classList.remove('open'); });
</script>
@endsection
