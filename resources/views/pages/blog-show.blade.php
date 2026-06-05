@extends('layouts.app')
@section('title', $post->title . ' - TREC Mental Health Insights')
@section('meta_desc', $post->excerpt ?? $post->title)
@section('og_title', $post->title . ' - TREC Insights')
@section('og_desc', $post->excerpt ?? $post->title)
@section('og_type', 'article')
@section('breadcrumb_title', $post->title)

@section('styles')
<style>
.blog-read-hero {
  background: var(--black);
  color: #fff;
  padding: 5rem 2rem 3rem;
  position: relative;
  overflow: hidden;
}

.blog-read-hero::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--red), var(--orange), var(--green));
}

.blog-read-header {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

.blog-read-breadcrumb {
  display: flex;
  gap: 0.5rem;
  font-size: 14px;
  margin-bottom: 2rem;
  color: rgba(255, 255, 255, 0.6);
}

.blog-read-breadcrumb a {
  color: var(--orange);
  text-decoration: none;
}

.blog-read-title {
  font-family: var(--font-h);
  font-size: clamp(2rem, 5vw, 3rem);
  font-weight: 900;
  line-height: 1.2;
  margin-bottom: 1.5rem;
  letter-spacing: -1px;
}

.blog-read-meta {
  display: flex;
  gap: 1.5rem;
  flex-wrap: wrap;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.7);
}

.blog-read-meta-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.blog-read-content-area {
  max-width: 900px;
  margin: 0 auto;
  padding: 4rem 2rem;
  background: var(--cream);
  min-height: 100vh;
}

.blog-read-featured-image {
  width: 100%;
  border-radius: 16px;
  object-fit: cover;
  margin-bottom: 3rem;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
}

.blog-read-body {
  background: #fff;
  padding: 3rem;
  border-radius: 16px;
  font-size: 1.05rem;
  line-height: 1.9;
  color: var(--charcoal);
}

.blog-read-body h2 {
  font-family: var(--font-h);
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--black);
  margin: 2rem 0 1rem;
  letter-spacing: -0.5px;
}

.blog-read-body h3 {
  font-family: var(--font-h);
  font-size: 1.4rem;
  font-weight: 700;
  color: var(--black);
  margin: 1.5rem 0 0.75rem;
  letter-spacing: -0.3px;
}

.blog-read-body p {
  margin-bottom: 1.5rem;
}

.blog-read-body ul,
.blog-read-body ol {
  margin: 1.5rem 0;
  padding-left: 2rem;
}

.blog-read-body li {
  margin-bottom: 0.75rem;
}

.blog-read-body blockquote {
  border-left: 4px solid var(--orange);
  padding: 1.5rem;
  margin: 2rem 0;
  background: rgba(229, 105, 24, 0.05);
  font-style: italic;
  color: var(--charcoal);
}

.blog-read-body code {
  background: rgba(0, 0, 0, 0.05);
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  font-family: 'Courier New', monospace;
  color: var(--red);
}

.blog-read-footer {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.blog-read-category {
  display: inline-block;
  background: var(--orange);
  color: #fff;
  padding: 0.5rem 1rem;
  border-radius: 100px;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: uppercase;
}

/* Related Insights */
.related-insights-section {
  max-width: 900px;
  margin: 0 auto;
  padding: 4rem 2rem;
}

.related-insights-title {
  font-family: var(--font-h);
  font-size: 2rem;
  font-weight: 900;
  color: var(--black);
  margin-bottom: 2rem;
  text-align: center;
}

.related-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
}

.related-card {
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.08);
  transition: all 0.3s;
  display: flex;
  flex-direction: column;
}

.related-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 48px rgba(0, 0, 0, 0.1);
}

.related-card-thumb {
  height: 180px;
  background: linear-gradient(135deg, var(--red), var(--orange));
  display: flex;
  align-items: center;
  justify-content: center;
  color: rgba(255, 255, 255, 0.3);
  font-weight: 900;
}

.related-card-body {
  padding: 1.5rem;
  flex: 1;
  display: flex;
  flex-direction: column;
}

.related-card-title {
  font-family: var(--font-h);
  font-size: 1.1rem;
  font-weight: 700;
  color: var(--black);
  margin-bottom: 0.75rem;
  line-height: 1.3;
  flex: 1;
}

.related-card-excerpt {
  font-size: 0.9rem;
  color: var(--charcoal);
  margin-bottom: 1rem;
  line-height: 1.6;
}

.related-card-meta {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 12px;
  color: rgba(0, 0, 0, 0.5);
  border-top: 1px solid rgba(0, 0, 0, 0.05);
  padding-top: 1rem;
}

.related-card a {
  text-decoration: none;
  color: inherit;
  display: block;
}

.read-time {
  background: rgba(229, 105, 24, 0.1);
  color: var(--orange);
  padding: 0.25rem 0.75rem;
  border-radius: 4px;
  font-size: 12px;
  font-weight: 600;
}

@media (max-width: 768px) {
  .blog-read-body {
    padding: 1.5rem;
  }

  .blog-read-title {
    font-size: 1.8rem;
  }

  .blog-read-meta {
    gap: 1rem;
  }

  .related-insights-section {
    padding: 2rem;
  }
}
</style>
@endsection

@section('content')

<!-- Hero Section -->
<div class="blog-read-hero">
  <div class="blog-read-header">
    <div class="blog-read-breadcrumb">
      <a href="{{ route('home') }}">Home</a>
      <span>/</span>
      <a href="{{ route('blog') }}">Insights</a>
      <span>/</span>
      <span>{{ $post->category }}</span>
    </div>
    <h1 class="blog-read-title">{{ $post->title }}</h1>
    <div class="blog-read-meta">
      <div class="blog-read-meta-item">
        <span>📅</span>
        <span>{{ $post->published_at->format('M d, Y') }}</span>
      </div>
      @if($post->read_time)
        <div class="blog-read-meta-item">
          <span>⏱️</span>
          <span>{{ $post->read_time }} min read</span>
        </div>
      @endif
      <div class="blog-read-meta-item">
        <span>📂</span>
        <span>{{ $post->category }}</span>
      </div>
    </div>
  </div>
</div>

<!-- Main Content Area -->
<div class="blog-read-content-area">
  @if($post->image_url)
    <img src="{{ asset($post->image_url) }}" alt="{{ $post->title }}" class="blog-read-featured-image">
  @else
    <div style="width:100%;height:300px;background:linear-gradient(135deg,var(--red),var(--orange));border-radius:16px;margin-bottom:3rem;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-weight:900">
      FEATURED IMAGE
    </div>
  @endif

  <article class="blog-read-body">
    {!! nl2br(e($post->content)) !!}

    <div class="blog-read-footer">
      <div class="blog-read-category">{{ $post->category }}</div>
      <div style="display:flex;gap:1rem">
        <a href="https://www.facebook.com/share.php?u={{ urlencode(url(route('blog.show', $post->slug))) }}" target="_blank" style="display:inline-flex;align-items:center;gap:.5rem;color:var(--orange);text-decoration:none;font-weight:600">
          <span>📘</span> Share
        </a>
        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url(route('blog.show', $post->slug))) }}&text={{ urlencode($post->title) }}" target="_blank" style="display:inline-flex;align-items:center;gap:.5rem;color:var(--orange);text-decoration:none;font-weight:600">
          <span>𝕏</span> Tweet
        </a>
      </div>
    </div>
  </article>
</div>

<!-- Related Insights -->
@if($relatedPosts->count() > 0)
  <div class="related-insights-section">
    <h2 class="related-insights-title">More Insights</h2>
    <div class="related-grid">
      @foreach($relatedPosts as $relatedPost)
        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="related-card" style="text-decoration:none;color:inherit">
          <div class="related-card-thumb">
            @if($relatedPost->image_url)
              <img src="{{ asset($relatedPost->image_url) }}" alt="{{ $relatedPost->title }}" style="width:100%;height:100%;object-fit:cover">
            @endif
          </div>
          <div class="related-card-body">
            <h3 class="related-card-title">{{ $relatedPost->title }}</h3>
            <p class="related-card-excerpt">{{ $relatedPost->excerpt ?? Str::limit($relatedPost->content, 100) }}</p>
            <div class="related-card-meta">
              <span>{{ $relatedPost->published_at->format('M d') }}</span>
              @if($relatedPost->read_time)
                <span class="read-time">{{ $relatedPost->read_time }} min</span>
              @endif
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
@endif

<!-- Back to Insights -->
<div style="max-width:900px;margin:0 auto;padding:2rem;text-align:center;border-top:1px solid rgba(0,0,0,.1)">
  <a href="{{ route('blog') }}" style="display:inline-flex;align-items:center;gap:.5rem;color:var(--orange);text-decoration:none;font-weight:600">
    ← Back to All Insights
  </a>
</div>

<!-- Article Schema Markup for SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "{{ $post->title }}",
  "description": "{{ $post->excerpt ?? $post->title }}",
  "image": "{{ $post->image_url ? asset($post->image_url) : '' }}",
  "author": {
    "@type": "Organization",
    "name": "TREC - The Ripple Effect Consult"
  },
  "publisher": {
    "@type": "Organization",
    "name": "TREC - The Ripple Effect Consult",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('/logo.png') }}"
    }
  },
  "datePublished": "{{ $post->published_at->toIso8601String() }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}",
  "articleSection": "{{ $post->category }}"
}
</script>

@endsection
