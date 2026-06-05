@extends('layouts.app')
@section('title', 'Manage Insights - TREC Admin')
@section('content')
<script src="https://unpkg.com/lucide@latest"></script>
<div style="background:#f8fafc;color:#1e293b;min-height:100vh;padding:3rem 2rem">
  <div class="wrap">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem">
      <div>
        <h1 style="font-family:var(--font-h);font-size:2rem;font-weight:900;margin:0;margin-bottom:.5rem;color:#1e293b;display:flex;align-items:center;gap:.75rem"><svg class="lucide lucide-book-open" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>Manage Insights</h1>
        <p style="color:#64748b;margin:0;font-size:14px">Create, edit, and publish insights for your audience</p>
      </div>
      <a href="{{ route('admin.blog.create') }}" style="background:#dc2626;color:#fff;padding:1rem 1.5rem;border-radius:8px;text-decoration:none;font-weight:600;box-shadow:0 2px 4px rgba(220,38,38,.15);display:flex;align-items:center;gap:.5rem"><svg class="lucide lucide-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>New Insight</a>
    </div>

    @if(session('success'))
      <div style="background:#d1fae5;border:1px solid #6ee7b7;color:#065f46;padding:1rem;border-radius:8px;margin-bottom:2rem;font-weight:500\">{{ session('success') }}</div>
    @endif
    
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.05)\">
      @if($posts->count())
        <table style="width:100%;border-collapse:collapse\">
          <thead>
            <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0\">
              <th style="padding:1rem;text-align:left;font-weight:600;color:#475569\">Title</th>
              <th style="padding:1rem;text-align:left;font-weight:600;color:#475569\">Category</th>
              <th style="padding:1rem;text-align:left;font-weight:600;color:#475569\">Status</th>
              <th style="padding:1rem;text-align:left;font-weight:600;color:#475569\">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $post)
              <tr style="border-bottom:1px solid #e2e8f0;transition:background .2s\">
                <td style="padding:1rem;color:#1e293b\"><strong>{{ $post->title }}</strong></td>
                <td style="padding:1rem;font-size:13px;color:#64748b\">{{ $post->category }}</td>
                <td style="padding:1rem;font-size:13px\">
                  @if($post->published_at)
                    <span style="background:#d1fae5;color:#065f46;padding:4px 10px;border-radius:4px;font-size:11px;font-weight:600\">Published</span>
                  @else
                    <span style=\"background:#f3f4f6;color:#4b5563;padding:4px 10px;border-radius:4px;font-size:11px;font-weight:600\">Draft</span>
                  @endif
                </td>
                <td style="padding:1rem;display:flex;gap:.75rem">
                  <a href="{{ route('admin.blog.edit', $post) }}" style="color:#dc2626;text-decoration:none;font-weight:500;display:flex;align-items:center;gap:.25rem;padding:.5rem;border-radius:4px;transition:background .2s;hover:background:#fee2e2" title="Edit">
                    <svg class="lucide lucide-edit" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    Edit
                  </a>
                  <form method="POST" action="{{ route('admin.blog.delete', $post) }}" style="display:inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;color:#ef4444;cursor:pointer;text-decoration:none;font-weight:500;display:flex;align-items:center;gap:.25rem;padding:.5rem;border-radius:4px;transition:background .2s" title="Delete">
                      <svg class="lucide lucide-trash" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                      Delete
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div style=\"padding:3rem;text-align:center;color:#94a3b8\">
          <p style=\"font-size:1.1rem;margin-bottom:1rem\">No insights published yet</p>
          <a href=\"{{ route('admin.blog.create') }}\" style=\"background:#dc2626;color:#fff;padding:.75rem 1.5rem;border-radius:8px;text-decoration:none;font-weight:600;display:inline-block\">Create Your First Insight</a>
        </div>
      @endif
    </div>

    @if($posts->hasPages())
      <div style=\"margin-top:2rem;display:flex;gap:1rem\">
        @if($posts->onFirstPage())
          <button disabled style=\"padding:.5rem 1rem;background:#f3f4f6;color:#9ca3af;border:1px solid #d1d5db;border-radius:4px;cursor:not-allowed\">← Previous</button>
        @else
          <a href=\"{{ $posts->previousPageUrl() }}\" style=\"padding:.5rem 1rem;background:#dc2626;color:#fff;text-decoration:none;border-radius:4px\">← Previous</a>
        @endif

        @if($posts->hasMorePages())
          <a href=\"{{ $posts->nextPageUrl() }}\" style=\"padding:.5rem 1rem;background:#dc2626;color:#fff;text-decoration:none;border-radius:4px\">Next →</a>
        @else
          <button disabled style=\"padding:.5rem 1rem;background:#f3f4f6;color:#9ca3af;border:1px solid #d1d5db;border-radius:4px;cursor:not-allowed\">Next →</button>
        @endif
      </div>
    @endif
  </div>
</div>
@endsection
