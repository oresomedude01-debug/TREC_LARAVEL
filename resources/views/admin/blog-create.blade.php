@extends('layouts.app')
@section('title', 'Create Insight - TREC Admin')
@section('content')
<script src="https://unpkg.com/lucide@latest"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<div style="background:#f8fafc;color:#1e293b;min-height:100vh;padding:3rem 2rem">
  <div class="wrap" style="max-width:900px">
    <a href="{{ route('admin.blog') }}" style="color:#64748b;text-decoration:none;font-size:14px;margin-bottom:1rem;display:inline-flex;align-items:center;gap:.5rem;transition:color .2s;hover:color:#1e293b">
      <svg class="lucide lucide-arrow-left" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
      Back to Insights
    </a>
    
    <h1 style="font-family:var(--font-h);font-size:2rem;font-weight:900;margin-bottom:2rem;color:#1e293b;display:flex;align-items:center;gap:.75rem">
      <svg class="lucide lucide-plus-circle" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
      Create New Insight
    </h1>
    
    <form method="POST" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:2rem;box-shadow:0 1px 3px rgba(0,0,0,.05)\">
      @csrf

      <div style="margin-bottom:2rem">
        <label style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;font-weight:600;font-size:14px;color:#1e293b">
          <svg class="lucide lucide-type" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 7h16M4 7l2.293-2.293a1 1 0 0 1 1.414 0l2.586 2.586a1 1 0 0 0 1.414 0l2.586-2.586a1 1 0 0 1 1.414 0L20 7M4 7v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7"></polyline></svg>
          Insight Title *
        </label>
        <input type="text" name="title" required style="width:100%;padding:1rem;background:#f8fafc;border:1px solid #cbd5e1;border-radius:8px;color:#1e293b;font-family:inherit;font-size:1rem;transition:all .2s" placeholder="Enter insight title" value="{{ old('title') }}">
        @error('title')<span style="color:#dc2626;font-size:12px">{{ $message }}</span>@enderror
      </div>

      <div style="margin-bottom:2rem">
        <label style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;font-weight:600;font-size:14px;color:#1e293b">
          <svg class="lucide lucide-link" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
          URL Slug *
        </label>
        <input type="text" name="slug" required style="width:100%;padding:1rem;background:#f8fafc;border:1px solid #cbd5e1;border-radius:8px;color:#1e293b;font-family:inherit;font-size:1rem;transition:all .2s" placeholder="url-slug-format" value="{{ old('slug') }}">
        @error('slug')<span style="color:#dc2626;font-size:12px">{{ $message }}</span>@enderror
      </div>

      <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:2rem\">
        <div>
          <label style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;font-weight:600;font-size:14px;color:#1e293b">
            <svg class="lucide lucide-tags" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H2v7h7V5zM22 5h-7v7h7V5zM9 17H2v2h7v-2zM22 19h-7v2h7v-2z"></path></svg>
            Category *
          </label>
          <input type="text" name="category" required style="width:100%;padding:1rem;background:#f8fafc;border:1px solid #cbd5e1;border-radius:8px;color:#1e293b;font-family:inherit;font-size:1rem;transition:all .2s\" placeholder="e.g., Mental Health" value="{{ old('category') }}\">
          @error('category')<span style="color:#dc2626;font-size:12px\">{{ $message }}</span>@enderror
        </div>
        <div>
          <label style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;font-weight:600;font-size:14px;color:#1e293b">
            <svg class="lucide lucide-clock" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            Read Time (minutes)
          </label>
          <input type="number" name="read_time" min="1" style="width:100%;padding:1rem;background:#f8fafc;border:1px solid #cbd5e1;border-radius:8px;color:#1e293b;font-family:inherit;font-size:1rem;transition:all .2s\" placeholder="5" value="{{ old('read_time') }}\">
          @error('read_time')<span style="color:#dc2626;font-size:12px\">{{ $message }}</span>@enderror
        </div>
      </div>

      <div style="margin-bottom:2rem">
        <label style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;font-weight:600;font-size:14px;color:#1e293b">
          <svg class="lucide lucide-image" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
          Featured Image
        </label>
        <input type="file" name="image" accept="image/*" style="width:100%;padding:1rem;background:#f8fafc;border:1px solid #cbd5e1;border-radius:8px;color:#1e293b;font-family:inherit;font-size:1rem;transition:all .2s\">
        <p style="font-size:12px;color:#94a3b8;margin-top:.5rem\">Recommended: 1200x600px</p>
        @error('image')<span style="color:#dc2626;font-size:12px\">{{ $message }}</span>@enderror
      </div>

      <div style="margin-bottom:2rem">
        <label style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;font-weight:600;font-size:14px;color:#1e293b">
          <svg class="lucide lucide-text" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="4 7h16M4 12h16M4 17h16"></polyline></svg>
          Excerpt (Summary)
        </label>
        <textarea name="excerpt" style="width:100%;padding:1rem;background:#f8fafc;border:1px solid #cbd5e1;border-radius:8px;color:#1e293b;font-family:inherit;font-size:1rem;resize:vertical;min-height:100px;transition:all .2s\" placeholder="Brief summary of the insight\">{{ old('excerpt') }}</textarea>
        @error('excerpt')<span style="color:#dc2626;font-size:12px\">{{ $message }}</span>@enderror
      </div>

      <div style="margin-bottom:2rem">
        <label style="display:flex;align-items:center;gap:.5rem;margin-bottom:.75rem;font-weight:600;font-size:14px;color:#1e293b">
          <svg class="lucide lucide-file-text" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="13" x2="12" y2="17"></line><polyline points="9 16 12 13 15 16"></polyline></svg>
          Content *
        </label>
        <div id="contentEditor" style="background:#fff;border:1px solid #cbd5e1;border-radius:8px;min-height:400px;margin-bottom:.5rem"></div>
        <input type="hidden" id="contentHidden" name="content" value="">
        @error('content')<span style="color:#dc2626;font-size:12px;display:block">{{ $message }}</span>@enderror
      </div>

      <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
      <script>
        const quill = new Quill('#contentEditor', {
          theme: 'snow',
          placeholder: 'Write your insight content here...',
          modules: {
            toolbar: [
              ['bold', 'italic', 'underline', 'strike'],
              ['blockquote', 'code-block'],
              [{ 'header': 1 }, { 'header': 2 }],
              [{ 'list': 'ordered'}, { 'list': 'bullet' }],
              [{ 'script': 'sub'}, { 'script': 'super' }],
              [{ 'indent': '-1'}, { 'indent': '+1' }],
              [{ 'size': ['small', false, 'large', 'huge'] }],
              [{ 'header': [false, 1, 2, 3, 4, 5, 6] }],
              [{ 'color': [] }, { 'background': [] }],
              [{ 'align': [] }],
              ['link'],
              ['clean']
            ]
          }
        });

        document.querySelector('form').addEventListener('submit', function() {
          document.getElementById('contentHidden').value = JSON.stringify(quill.getContents());
        });
      </script>

      <div style="margin-bottom:2rem">
        <label style="display:flex;align-items:center;gap:.5rem;font-weight:600;font-size:14px;color:#1e293b">
          <svg class="lucide lucide-calendar" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
          <span>Publish Date & Time (leave empty to save as draft)</span>
        </label>
        <input type="datetime-local" name="published_at" style="margin-top:.75rem;padding:.75rem;background:#f8fafc;border:1px solid #cbd5e1;border-radius:8px;color:#1e293b;font-family:inherit;transition:all .2s;width:100%" value="{{ old('published_at') }}">
        @error('published_at')<span style="color:#dc2626;font-size:12px">{{ $message }}</span>@enderror
      </div>

      <div style="display:flex;gap:1rem">
        <button type="submit" style="background:#dc2626;color:#fff;padding:1rem 2rem;border:none;border-radius:8px;font-weight:600;cursor:pointer;font-size:1rem;transition:all .2s;box-shadow:0 2px 4px rgba(220,38,38,.15);display:flex;align-items:center;gap:.5rem">
          <svg class="lucide lucide-check" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
          Create Insight
        </button>
        <a href="{{ route('admin.blog') }}" style="background:#f1f5f9;color:#475569;padding:1rem 2rem;border-radius:8px;text-decoration:none;font-weight:600;transition:all .2s;border:1px solid #cbd5e1;display:flex;align-items:center;gap:.5rem">
          <svg class="lucide lucide-x" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
          Cancel
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
