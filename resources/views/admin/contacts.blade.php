@extends('layouts.app')
@section('title', 'Manage Contacts - TREC Admin')
@section('content')
<div style="background:#f8fafc;color:#1e293b;min-height:100vh;padding:3rem 2rem">
  <div class="wrap">
    <h1 style="font-family:var(--font-h);font-size:2rem;font-weight:900;margin-bottom:2rem;color:#1e293b">Contact Submissions</h1>
    
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.05)">
      <table style="width:100%;border-collapse:collapse">
        <thead>
          <tr style="background:#f8fafc;border-bottom:1px solid #e2e8f0">
            <th style="padding:1rem;text-align:left;font-weight:600;color:#475569">Name</th>
            <th style="padding:1rem;text-align:left;font-weight:600;color:#475569">Email</th>
            <th style="padding:1rem;text-align:left;font-weight:600;color:#475569">Service Interest</th>
            <th style="padding:1rem;text-align:left;font-weight:600;color:#475569">Date</th>
          </tr>
        </thead>
        <tbody>
          @forelse($submissions as $submission)
            <tr style="border-bottom:1px solid #e2e8f0;transition:background .2s\">
              <td style="padding:1rem;color:#1e293b\"><strong>{{ $submission->first_name }} {{ $submission->last_name }}</strong></td>
              <td style="padding:1rem;font-size:14px;color:#64748b\">{{ $submission->email }}</td>
              <td style="padding:1rem;font-size:13px;color:#475569\">{{ $submission->service_interest }}</td>
              <td style="padding:1rem;font-size:13px;color:#94a3b8\">{{ $submission->created_at->format('M d, Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" style="padding:2rem;text-align:center;color:#94a3b8\">No contact submissions yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($submissions->hasPages())
      <div style="margin-top:2rem;display:flex;gap:1rem\">
        @if($submissions->onFirstPage())
          <button disabled style="padding:.5rem 1rem;background:#f1f5f9;color:#9ca3af;border:1px solid #d1d5db;border-radius:4px;cursor:not-allowed\">← Previous</button>
        @else
          <a href="{{ $submissions->previousPageUrl() }}\" style="padding:.5rem 1rem;background:#dc2626;color:#fff;text-decoration:none;border-radius:4px;cursor:pointer\">← Previous</a>
        @endif

        @if($submissions->hasMorePages())
          <a href="{{ $submissions->nextPageUrl() }}\" style="padding:.5rem 1rem;background:#dc2626;color:#fff;text-decoration:none;border-radius:4px;cursor:pointer\">Next →</a>
        @else
          <button disabled style="padding:.5rem 1rem;background:#f1f5f9;color:#9ca3af;border:1px solid #d1d5db;border-radius:4px;cursor:not-allowed\">Next →</button>
        @endif
      </div>
    @endif
  </div>
</div>
@endsection
