@extends('layouts.app')
@section('title', 'Admin Dashboard - TREC')
@section('content')
<div style="background:var(--black);color:#fff;padding:4rem 2rem">
  <div class="wrap">
    <h1 style="font-family:var(--font-h);font-size:2.5rem;font-weight:900;margin-bottom:3rem">Admin Dashboard</h1>
    
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:2rem;margin-bottom:3rem">
      <div style="background:rgba(119,155,28,.2);border:1px solid var(--green);padding:2rem;border-radius:8px">
        <div style="font-size:2.5rem;font-weight:900;color:var(--green)">{{ $blogCount }}</div>
        <div style="color:rgba(255,255,255,.7);font-size:14px;margin-top:.5rem">Blog Posts</div>
      </div>
      <div style="background:rgba(229,105,24,.2);border:1px solid var(--orange);padding:2rem;border-radius:8px">
        <div style="font-size:2.5rem;font-weight:900;color:var(--orange)">{{ $galleryCount }}</div>
        <div style="color:rgba(255,255,255,.7);font-size:14px;margin-top:.5rem">Gallery Images</div>
      </div>
      <div style="background:rgba(215,45,55,.2);border:1px solid var(--red);padding:2rem;border-radius:8px">
        <div style="font-size:2.5rem;font-weight:900;color:var(--red)">{{ $contactCount }}</div>
        <div style="color:rgba(255,255,255,.7);font-size:14px;margin-top:.5rem">Contact Submissions</div>
      </div>
      <div style="background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);padding:2rem;border-radius:8px">
        <div style="font-size:2.5rem;font-weight:900;color:#fff">{{ $unreadCount }}</div>
        <div style="color:rgba(255,255,255,.7);font-size:14px;margin-top:.5rem">Unread Messages</div>
      </div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem">
      <a href="{{ route('admin.blog') }}" style="background:var(--red);color:#fff;padding:1.5rem;border-radius:8px;text-decoration:none;text-align:center;font-weight:600;transition:background .2s;cursor:pointer">Manage Blog Posts</a>
      <a href="{{ route('admin.gallery') }}" style="background:var(--orange);color:#fff;padding:1.5rem;border-radius:8px;text-decoration:none;text-align:center;font-weight:600;transition:background .2s;cursor:pointer">Manage Gallery</a>
      <a href="{{ route('admin.contacts') }}" style="background:var(--green);color:#fff;padding:1.5rem;border-radius:8px;text-decoration:none;text-align:center;font-weight:600;transition:background .2s;cursor:pointer">View Contacts</a>
    </div>
  </div>
</div>
@endsection
