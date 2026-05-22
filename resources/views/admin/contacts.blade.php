@extends('layouts.app')
@section('title', 'Manage Contacts - TREC Admin')
@section('content')
<div style="background:var(--black);color:#fff;padding:4rem 2rem">
  <div class="wrap">
    <h1 style="font-family:var(--font-h);font-size:2rem;font-weight:900;margin-bottom:2rem">Contact Submissions</h1>
    
    <div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:8px;overflow:hidden">
      <table style="width:100%;border-collapse:collapse">
        <thead>
          <tr style="background:rgba(255,255,255,.08)">
            <th style="padding:1rem;text-align:left;font-weight:600;border-right:1px solid rgba(255,255,255,.1)">Name</th>
            <th style="padding:1rem;text-align:left;font-weight:600;border-right:1px solid rgba(255,255,255,.1)">Email</th>
            <th style="padding:1rem;text-align:left;font-weight:600;border-right:1px solid rgba(255,255,255,.1)">Service</th>
            <th style="padding:1rem;text-align:left;font-weight:600">Date</th>
          </tr>
        </thead>
        <tbody>
          @forelse($submissions as $submission)
            <tr style="border-bottom:1px solid rgba(255,255,255,.05)">
              <td style="padding:1rem;border-right:1px solid rgba(255,255,255,.05)">{{ $submission->first_name }} {{ $submission->last_name }}</td>
              <td style="padding:1rem;border-right:1px solid rgba(255,255,255,.05);font-size:14px;color:rgba(255,255,255,.7)">{{ $submission->email }}</td>
              <td style="padding:1rem;border-right:1px solid rgba(255,255,255,.05);font-size:13px">{{ $submission->service_interest }}</td>
              <td style="padding:1rem;font-size:13px;color:rgba(255,255,255,.7)">{{ $submission->created_at->format('M d, Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4" style="padding:2rem;text-align:center;color:rgba(255,255,255,.5)">No contact submissions yet.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($submissions->hasPages())
      <div style="margin-top:2rem;display:flex;gap:1rem">
        @if($submissions->onFirstPage())
          <button disabled style="padding:.5rem 1rem;background:rgba(255,255,255,.05);color:rgba(255,255,255,.3);border:1px solid rgba(255,255,255,.1);border-radius:4px;cursor:not-allowed">← Previous</button>
        @else
          <a href="{{ $submissions->previousPageUrl() }}" style="padding:.5rem 1rem;background:var(--red);color:#fff;text-decoration:none;border-radius:4px;cursor:pointer">← Previous</a>
        @endif

        @if($submissions->hasMorePages())
          <a href="{{ $submissions->nextPageUrl() }}" style="padding:.5rem 1rem;background:var(--red);color:#fff;text-decoration:none;border-radius:4px;cursor:pointer">Next →</a>
        @else
          <button disabled style="padding:.5rem 1rem;background:rgba(255,255,255,.05);color:rgba(255,255,255,.3);border:1px solid rgba(255,255,255,.1);border-radius:4px;cursor:not-allowed">Next →</button>
        @endif
      </div>
    @endif
  </div>
</div>
@endsection
