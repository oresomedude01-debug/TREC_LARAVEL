@extends('layouts.app')
@section('title', 'Blog - TREC')
@section('styles')
<style>
.blog-hero{background:var(--cream);padding:6rem 2rem 5rem}
.blog-hero h1{font-family:var(--font-h);font-size:clamp(2.5rem,5vw,3.8rem);font-weight:900;color:var(--black);line-height:1.05;margin-bottom:1rem}
.blog-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(330px,1fr));gap:2rem}
.bcard{border:1px solid var(--mid);overflow:hidden;cursor:pointer;transition:border-color .2s,transform .2s}
.bcard:hover{border-color:var(--red);transform:translateY(-3px)}
.bthumb{height:190px;display:flex;align-items:flex-end;padding:1.25rem;position:relative;overflow:hidden;background:linear-gradient(135deg,#8a1520,#D82D37)}
.bcat{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;background:rgba(255,255,255,.15);color:#fff;padding:4px 12px;backdrop-filter:blur(4px);position:relative}
.bbody{padding:1.75rem}
.bbody h3{font-family:var(--font-h);font-size:1.1rem;font-weight:700;color:var(--black);line-height:1.35;margin-bottom:.65rem}
.bbody p{font-size:.88rem;font-weight:300;color:var(--charcoal);line-height:1.75}
.bmeta{display:flex;justify-content:space-between;align-items:center;margin-top:1rem;padding-top:1rem;border-top:1px solid var(--light);font-size:12px;color:var(--charcoal);opacity:.55}
.bread{color:var(--red);font-weight:600;opacity:1}
</style>
@endsection
@section('content')
<div class="blog-hero">
  <div class="wrap">
    <div class="eyebrow">Insights & Resources</div>
    <h1>Blog & Resources</h1>
    <p class="slead">Practical insights, expert perspectives, and evidence-based resources for counsellors, educators, parents, and advocates.</p>
  </div>
</div>
<section class="sec" style="padding-top:3rem">
  <div class="wrap">
    <div class="blog-grid">
      @forelse($posts as $post)
        <div class="bcard">
          <div class="bthumb">
            <span class="bcat">{{ $post->category }}</span>
          </div>
          <div class="bbody">
            <h3>{{ $post->title }}</h3>
            <p>{{ substr($post->excerpt, 0, 100) }}...</p>
            <div class="bmeta">
              <span>{{ $post->published_at->format('F Y') }}</span>
              <span class="bread">{{ $post->read_time }} min read →</span>
            </div>
          </div>
        </div>
      @empty
        <div style="grid-column:1/-1;text-align:center;padding:3rem">
          <p style="color:var(--charcoal);font-weight:300">Blog articles coming soon!</p>
        </div>
      @endforelse
    </div>
  </div>
</section>
@endsection
