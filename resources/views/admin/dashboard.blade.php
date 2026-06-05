@extends('layouts.app')
@section('title', 'Admin Dashboard - TREC')
@section('content')
<div style="background:#f8fafc;color:#1e293b;min-height:100vh">
  <!-- Top Navigation Bar -->
  <div style="background:#fff;border-bottom:1px solid #e2e8f0;padding:1rem 2rem;position:sticky;top:0;z-index:100;box-shadow:0 1px 3px rgba(0,0,0,.05)">
    <div class="wrap" style="display:flex;justify-content:space-between;align-items:center">
      <h2 style="font-family:var(--font-h);font-size:1.3rem;font-weight:700;margin:0;color:#1e293b">Dashboard</h2>
      <form method="POST" action="{{ route('logout') }}" style="margin:0">
        @csrf
        <button type="submit" style="background:#f1f5f9;border:1px solid #cbd5e1;color:#475569;padding:.5rem 1.2rem;border-radius:6px;cursor:pointer;font-size:14px;font-weight:500;transition:all .2s">Logout</button>
      </form>
    </div>
  </div>

  <div class="wrap" style="padding:3rem 2rem">
    <h1 style="font-family:var(--font-h);font-size:2.5rem;font-weight:900;margin-bottom:2rem;color:#1e293b">Welcome to TREC Admin</h1>
    
    <!-- Quick Stats -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1.5rem;margin-bottom:3rem">
      <div style="background:#fff;border:2px solid #86efac;padding:2rem;border-radius:12px;transition:all .3s;box-shadow:0 1px 3px rgba(0,0,0,.05)">
        <div style="font-size:2.5rem;font-weight:900;color:#16a34a">{{ $blogCount }}</div>
        <div style="color:#64748b;font-size:14px;margin-top:.5rem;font-weight:500">Insights Published</div>
      </div>
      <div style="background:#fff;border:2px solid #fca5a5;padding:2rem;border-radius:12px;transition:all .3s;box-shadow:0 1px 3px rgba(0,0,0,.05)">
        <div style="font-size:2.5rem;font-weight:900;color:#dc2626">{{ $contactCount }}</div>
        <div style="color:#64748b;font-size:14px;margin-top:.5rem;font-weight:500">Contact Submissions</div>
      </div>
      <div style="background:#fff;border:2px solid #fbbf24;padding:2rem;border-radius:12px;transition:all .3s;box-shadow:0 1px 3px rgba(0,0,0,.05)">
        <div style="font-size:2.5rem;font-weight:900;color:#d97706">{{ $unreadCount }}</div>
        <div style="color:#64748b;font-size:14px;margin-top:.5rem;font-weight:500">Unread Messages</div>
      </div>
    </div>

    <!-- Main Navigation -->
    <div style="margin-bottom:2rem">
      <h3 style="font-size:14px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#94a3b8;margin-bottom:1rem">Management</h3>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem">
        <a href="{{ route('admin.blog') }}" style="background:linear-gradient(135deg,#dc2626,#991b1b);color:#fff;padding:1.5rem;border-radius:10px;text-decoration:none;text-align:center;font-weight:600;transition:all .2s;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(220,38,38,.15)">
          <div style="font-size:1.2rem;margin-bottom:.5rem">📝</div>
          Manage Insights
        </a>
        <a href="{{ route('admin.contacts') }}" style="background:linear-gradient(135deg,#16a34a,#15803d);color:#fff;padding:1.5rem;border-radius:10px;text-decoration:none;text-align:center;font-weight:600;transition:all .2s;border:none;cursor:pointer;box-shadow:0 2px 8px rgba(22,163,74,.15)">
          <div style="font-size:1.2rem;margin-bottom:.5rem">📧</div>
          View Messages
        </a>
      </div>
    </div>

    <!-- Quick Actions -->
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:1.5rem;box-shadow:0 1px 3px rgba(0,0,0,.05)">
      <h3 style="font-size:14px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#94a3b8;margin-bottom:1rem;margin-top:0">Quick Actions</h3>
      <div style="display:flex;gap:1rem;flex-wrap:wrap">
        <a href="{{ route('admin.blog.create') }}" style="background:#dc2626;color:#fff;padding:.75rem 1.5rem;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;transition:all .2s;box-shadow:0 2px 4px rgba(220,38,38,.15)">+ New Insight</a>
        <a href="{{ route('home') }}" style="background:#f1f5f9;border:1px solid #cbd5e1;color:#475569;padding:.75rem 1.5rem;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px;transition:all .2s">View Website</a>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
