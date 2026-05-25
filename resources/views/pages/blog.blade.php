@extends('layouts.app')
@section('title', 'Blog & Resources')
@section('meta_desc', 'Practical insights, expert perspectives, and evidence-based resources on mental health, counselling, and wellbeing from The Ripple Effect Consult.')

@section('styles')
<style>
/* ── HERO ── */
.blog-hero{
  background:var(--cream);padding:7rem 2rem 5.5rem;
  position:relative;overflow:hidden;
}
.blog-hero::after{content:'';position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--red),var(--orange),var(--green))}
.blog-hero-blob{
  position:absolute;right:-100px;top:50%;transform:translateY(-50%);
  width:500px;height:500px;border-radius:50%;
  background:radial-gradient(rgba(216,45,55,.07),transparent 70%);
  pointer-events:none;
}
.blog-hero-inner{max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;position:relative;z-index:2}
.blog-hero h1{font-family:var(--font-h);font-size:clamp(2.8rem,5vw,4rem);font-weight:900;color:var(--black);line-height:1.0;letter-spacing:-2px;margin-bottom:1rem}
.blog-hero p{font-size:1.05rem;font-weight:300;max-width:480px;line-height:1.9;color:var(--charcoal)}

/* Featured badge */
.blog-featured-tag{
  display:inline-flex;align-items:center;gap:8px;
  background:var(--red);color:#fff;
  font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;
  padding:6px 14px;border-radius:6px;margin-bottom:1.5rem;
}
.blog-featured-card{
  background:var(--black);border-radius:14px;padding:2rem;position:relative;overflow:hidden;
}
.blog-featured-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--red),var(--orange))}
.blog-featured-card h3{font-family:var(--font-h);font-size:1.3rem;font-weight:700;color:#fff;line-height:1.3;margin-bottom:.75rem}
.blog-featured-card p{font-size:.88rem;font-weight:300;color:rgba(255,255,255,.5);line-height:1.75;margin-bottom:1.25rem}
.blog-featured-meta{display:flex;gap:1rem;align-items:center;flex-wrap:wrap}
.bfm-tag{font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--orange);background:rgba(229,105,24,.15);padding:4px 10px;border-radius:4px}
.bfm-time{font-size:12px;color:rgba(255,255,255,.3)}

/* ── FILTER BAR ── */
.blog-filters{
  background:var(--white);border-bottom:1px solid var(--mid);
  padding:1rem 2rem;position:sticky;top:70px;z-index:100;
}
.blog-filter-inner{max-width:1200px;margin:0 auto;display:flex;gap:.6rem;flex-wrap:wrap;align-items:center}
.bf-btn{
  font-size:12px;font-weight:600;letter-spacing:.3px;
  padding:7px 16px;border-radius:100px;
  border:1.5px solid var(--mid);background:transparent;
  color:var(--charcoal);cursor:pointer;transition:all .2s;
}
.bf-btn:hover{border-color:var(--charcoal);color:var(--black)}
.bf-btn.act{background:var(--red);border-color:var(--red);color:#fff}

/* ── GRID ── */
.blog-body{max-width:1200px;margin:0 auto;padding:3.5rem 2rem 5rem}
.blog-grid{
  display:grid;
  grid-template-columns:repeat(3,1fr);
  gap:1.5rem;
}

/* Card */
.bcard{
  border:1px solid var(--mid);border-radius:12px;
  overflow:hidden;cursor:pointer;
  transition:border-color .3s,transform .3s var(--ease),box-shadow .3s;
  background:var(--white);
  display:flex;flex-direction:column;
}
.bcard:hover{border-color:var(--red);transform:translateY(-6px);box-shadow:0 16px 48px rgba(0,0,0,.1)}

/* Thumb */
.bthumb{
  height:180px;position:relative;overflow:hidden;
  display:flex;align-items:flex-end;padding:1rem;
}
.bthumb-bg{
  position:absolute;inset:0;
  transition:transform .5s var(--ease);
}
.bcard:hover .bthumb-bg{transform:scale(1.06)}
.bcat-badge{
  position:relative;z-index:1;
  font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;
  background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);
  color:#fff;padding:4px 12px;border-radius:100px;
  backdrop-filter:blur(8px);
}

/* Body */
.bbody{padding:1.5rem;flex:1;display:flex;flex-direction:column}
.bbody h3{
  font-family:var(--font-h);font-size:1.05rem;font-weight:700;
  color:var(--black);line-height:1.4;margin-bottom:.6rem;
  flex:1;
}
.bbody p{font-size:.87rem;font-weight:300;color:var(--charcoal);line-height:1.75;margin-bottom:1rem}
.bmeta{
  display:flex;justify-content:space-between;align-items:center;
  margin-top:auto;padding-top:1rem;border-top:1px solid var(--light);
  font-size:12px;color:var(--charcoal);opacity:.6;
}
.bread{color:var(--red);font-weight:700;opacity:1;transition:gap .2s;display:flex;align-items:center;gap:4px}
.bcard:hover .bread{gap:8px}

/* Empty / coming soon */
.blog-empty{
  grid-column:1/-1;text-align:center;padding:5rem 2rem;
}
.blog-empty-icon{font-size:3rem;margin-bottom:1rem}
.blog-empty h3{font-family:var(--font-h);font-size:1.5rem;font-weight:700;color:var(--black);margin-bottom:.75rem}
.blog-empty p{font-size:.93rem;font-weight:300;color:var(--charcoal);max-width:380px;margin:0 auto 2rem;line-height:1.85}

/* Newsletter strip */
.newsletter-strip{
  background:var(--black);padding:4rem 2rem;
  position:relative;overflow:hidden;
}
.newsletter-strip::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse 60% 100% at 50% 100%,rgba(229,105,24,.12),transparent 65%);
}
.newsletter-inner{
  max-width:640px;margin:0 auto;text-align:center;
  position:relative;z-index:1;
}
.newsletter-inner h3{font-family:var(--font-h);font-size:1.8rem;font-weight:900;color:#fff;margin-bottom:.75rem;letter-spacing:-.5px}
.newsletter-inner p{font-size:.93rem;font-weight:300;color:rgba(255,255,255,.5);margin-bottom:1.75rem;line-height:1.8}
.newsletter-form{display:flex;gap:.75rem;max-width:420px;margin:0 auto}
.newsletter-form input{
  flex:1;padding:13px 16px;border-radius:8px;border:1.5px solid rgba(255,255,255,.12);
  background:rgba(255,255,255,.07);color:#fff;font-family:var(--font-b);font-size:14px;
  outline:none;transition:border-color .2s;
}
.newsletter-form input::placeholder{color:rgba(255,255,255,.3)}
.newsletter-form input:focus{border-color:var(--orange)}
.newsletter-form button{
  background:var(--orange);color:#fff;border:none;border-radius:8px;
  padding:13px 20px;font-size:13px;font-weight:700;cursor:pointer;
  transition:all .2s;white-space:nowrap;font-family:var(--font-b);
}
.newsletter-form button:hover{background:#c95c15}

/* Thumb gradients */
.bt-r{background:linear-gradient(135deg,#8a1520,#D82D37)}
.bt-o{background:linear-gradient(135deg,#a84a10,#E56918)}
.bt-g{background:linear-gradient(135deg,#3d560f,#6B8F1A)}
.bt-b{background:linear-gradient(135deg,#1a1a2e,#414042)}
.bt-p{background:linear-gradient(135deg,#4a1568,#8b5cf6)}
.bt-t{background:linear-gradient(135deg,#0d4f5c,#0891b2)}

@media(max-width:960px){
  .blog-hero-inner{grid-template-columns:1fr}
  .blog-featured-card{display:none}
  .blog-grid{grid-template-columns:repeat(2,1fr)}
}
@media(max-width:600px){
  .blog-grid{grid-template-columns:1fr}
  .newsletter-form{flex-direction:column}
}
</style>
@endsection

@section('content')

<!-- ── HERO ── -->
<div class="blog-hero">
  <div class="blog-hero-blob"></div>
  <div class="blog-hero-inner">
    <div class="reveal">
      <div class="eyebrow">Insights & Resources</div>
      <h1>Blog &<br>Resources</h1>
      <p>Practical insights, expert perspectives, and evidence-based resources for counsellors, educators, parents, and advocates.</p>
    </div>
    <div class="blog-featured-card reveal-right" style="transition-delay:.15s">
      <div class="blog-featured-tag">📌 Editor's Pick</div>
      <h3>Understanding Emotional Regulation in Children: A Guide for Parents and Educators</h3>
      <p>Practical strategies rooted in neuroscience and attachment theory to help children develop healthy emotional regulation skills from an early age.</p>
      <div class="blog-featured-meta">
        <span class="bfm-tag">Mental Health</span>
        <span class="bfm-time">8 min read</span>
      </div>
    </div>
  </div>
</div>

<!-- ── FILTER BAR ── -->
<div class="blog-filters">
  <div class="blog-filter-inner">
    <button class="bf-btn act" data-cat="all">All Topics</button>
    <button class="bf-btn" data-cat="mental-health">Mental Health</button>
    <button class="bf-btn" data-cat="parenting">Parenting</button>
    <button class="bf-btn" data-cat="schools">Schools</button>
    <button class="bf-btn" data-cat="workplace">Workplace</button>
    <button class="bf-btn" data-cat="counselling">Counselling</button>
  </div>
</div>

<!-- ── BLOG GRID ── -->
<div class="blog-body">
  <div class="blog-grid reveal-stagger" id="blogGrid">
    @forelse($posts as $post)
      @php
        $thumbClasses = ['bt-r','bt-o','bt-g','bt-b','bt-p','bt-t'];
        $tc = $thumbClasses[$loop->index % count($thumbClasses)];
      @endphp
      <div class="bcard" data-cat="{{ strtolower(str_replace(' ','-',$post->category ?? 'general')) }}">
        <div class="bthumb">
          <div class="bthumb-bg {{ $tc }}"></div>
          <span class="bcat-badge">{{ $post->category ?? 'Article' }}</span>
        </div>
        <div class="bbody">
          <h3>{{ $post->title }}</h3>
          <p>{{ substr($post->excerpt, 0, 100) }}…</p>
          <div class="bmeta">
            <span>{{ $post->published_at->format('M Y') }}</span>
            <span class="bread">{{ $post->read_time ?? '5' }} min <span>→</span></span>
          </div>
        </div>
      </div>
    @empty
      {{-- Placeholder cards shown when no posts exist --}}
      @php
        $placeholderPosts = [
          ['title'=>'5 Signs You May Benefit from Individual Counselling','cat'=>'mental-health','tc'=>'bt-r','tag'=>'Mental Health','time'=>'5'],
          ['title'=>'Building Emotional Safety in Your Classroom','cat'=>'schools','tc'=>'bt-g','tag'=>'Schools','time'=>'7'],
          ['title'=>'How to Talk to Your Teenager About Mental Health','cat'=>'parenting','tc'=>'bt-o','tag'=>'Parenting','time'=>'6'],
          ['title'=>'Burnout is Not a Badge of Honour — A Corporate Guide','cat'=>'workplace','tc'=>'bt-b','tag'=>'Workplace','time'=>'8'],
          ['title'=>'What to Expect in Your First Counselling Session','cat'=>'counselling','tc'=>'bt-p','tag'=>'Counselling','time'=>'4'],
          ['title'=>'The Ripple Effect: Why School Wellbeing Matters','cat'=>'schools','tc'=>'bt-t','tag'=>'Schools','time'=>'6'],
        ];
      @endphp
      @foreach($placeholderPosts as $ph)
      <div class="bcard" data-cat="{{ $ph['cat'] }}">
        <div class="bthumb">
          <div class="bthumb-bg {{ $ph['tc'] }}"></div>
          <span class="bcat-badge">{{ $ph['tag'] }}</span>
        </div>
        <div class="bbody">
          <h3>{{ $ph['title'] }}</h3>
          <p>A practical, evidence-based perspective from The Ripple Effect Consult team to support your wellbeing journey.</p>
          <div class="bmeta">
            <span>Coming Soon</span>
            <span class="bread">{{ $ph['time'] }} min <span>→</span></span>
          </div>
        </div>
      </div>
      @endforeach
    @endforelse
  </div>
</div>

<!-- ── NEWSLETTER ── -->
<div class="newsletter-strip">
  <div class="newsletter-inner reveal">
    <h3>Stay in the Loop</h3>
    <p>Get the latest articles, event updates, and mental health resources delivered straight to your inbox — no spam, ever.</p>
    <form class="newsletter-form" onsubmit="return false;">
      <input type="email" placeholder="your@email.com" aria-label="Email address">
      <button type="submit">Subscribe →</button>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
// Blog category filter
const bfBtns = document.querySelectorAll('.bf-btn');
const bCards = document.querySelectorAll('.bcard');
bfBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    bfBtns.forEach(b => b.classList.remove('act'));
    btn.classList.add('act');
    const cat = btn.dataset.cat;
    bCards.forEach(card => {
      card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
    });
  });
});
</script>
@endsection
