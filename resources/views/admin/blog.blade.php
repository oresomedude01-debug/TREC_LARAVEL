@extends('layouts.app')
@section('title', 'Manage Blog - TREC Admin')
@section('content')
<div style="background:var(--black);color:#fff;padding:4rem 2rem">
  <div class="wrap">
    <h1 style="font-family:var(--font-h);font-size:2rem;font-weight:900;margin-bottom:2rem">Blog Posts Management</h1>
    <p style="color:rgba(255,255,255,.6);margin-bottom:2rem">Create and manage blog posts from here. Posts published will appear on the blog page.</p>
    
    <div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:8px;overflow:hidden">
      <table style="width:100%;border-collapse:collapse">
        <thead>
          <tr style="background:rgba(255,255,255,.08)">
            <th style="padding:1rem;text-align:left;font-weight:600;border-right:1px solid rgba(255,255,255,.1)">Title</th>
            <th style="padding:1rem;text-align:left;font-weight:600;border-right:1px solid rgba(255,255,255,.1)">Category</th>
            <th style="padding:1rem;text-align:left;font-weight:600">Published</th>
          </tr>
        </thead>
        <tbody>
          @forelse($posts as $post)
            <tr style="border-bottom:1px solid rgba(255,255,255,.05)">
              <td style="padding:1rem;border-right:1px solid rgba(255,255,255,.05)"><strong>{{ $post->title }}</strong></td>
              <td style="padding:1rem;border-right:1px solid rgba(255,255,255,.05);font-size:13px">{{ $post->category }}</td>
              <td style="padding:1rem;font-size:13px;color:rgba(255,255,255,.7)">{{ $post->published_at ? $post->published_at->format('M d, Y') : 'Draft' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" style="padding:2rem;text-align:center;color:rgba(255,255,255,.5)">No blog posts yet. Create your first post!</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($posts->hasPages())
      <div style="margin-top:2rem;display:flex;gap:1rem">
        @if($posts->onFirstPage())
          <button disabled style="padding:.5rem 1rem;background:rgba(255,255,255,.05);color:rgba(255,255,255,.3);border-radius:4px;cursor:not-allowed">← Previous</button>
        @else
          <a href="{{ $posts->previousPageUrl() }}" style="padding:.5rem 1rem;background:var(--red);color:#fff;text-decoration:none;border-radius:4px">← Previous</a>
        @endif

        @if($posts->hasMorePages())
          <a href="{{ $posts->nextPageUrl() }}" style="padding:.5rem 1rem;background:var(--red);color:#fff;text-decoration:none;border-radius:4px">Next →</a>
        @else
          <button disabled style="padding:.5rem 1rem;background:rgba(255,255,255,.05);color:rgba(255,255,255,.3);border-radius:4px;cursor:not-allowed">Next →</button>
        @endif
      </div>
    @endif

    <p style="color:rgba(255,255,255,.5);margin-top:2rem;font-size:13px">💡 Tip: Use the Laravel admin panel or database to create and manage blog posts, gallery images, and other content.</p>
  </div>
</div>
@endsection
