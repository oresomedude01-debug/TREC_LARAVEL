@extends('layouts.app')
@section('title', 'Manage Gallery - TREC Admin')
@section('content')
<div style="background:var(--black);color:#fff;padding:4rem 2rem">
  <div class="wrap">
    <h1 style="font-family:var(--font-h);font-size:2rem;font-weight:900;margin-bottom:2rem">Gallery Images Management</h1>
    <p style="color:rgba(255,255,255,.6);margin-bottom:2rem">{{ $images->count() }} images in gallery</p>
    
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem">
      @forelse($images as $image)
        <div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);padding:1rem;border-radius:8px">
          <div style="height:120px;background:linear-gradient(135deg,{{ $image->color1 }},{{ $image->color2 }});border-radius:4px;margin-bottom:1rem;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.2);font-weight:900">
            PHOTO
          </div>
          <p style="font-size:13px;margin-bottom:.5rem"><strong>{{ $image->label }}</strong></p>
          <p style="font-size:12px;color:rgba(255,255,255,.5)">{{ $image->category }}</p>
        </div>
      @empty
        <div style="grid-column:1/-1;padding:2rem;text-align:center;color:rgba(255,255,255,.5)">
          No gallery images yet. Add your first image!
        </div>
      @endforelse
    </div>

    <p style="color:rgba(255,255,255,.5);margin-top:2rem;font-size:13px">💡 You can add gallery images by creating new GalleryImage records in the database or through a custom admin interface.</p>
  </div>
</div>
@endsection
