@extends('layouts.admin')

@section('title', 'Edit Insight - TREC Admin')
@section('page-title', 'Edit Insight')
@section('page-subtitle', 'Update and manage your insight')

@section('content')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="max-w-4xl mx-auto">
    <!-- Back Link -->
    <a href="{{ route('admin.blog') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-slate-900 font-medium mb-6 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Back to Insights
    </a>

    <!-- Form -->
    <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md border border-slate-200 p-8">
        @csrf
        @method('PUT')

        <!-- Title Field -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-900 mb-2">
                Insight Title <span class="text-red-600">*</span>
            </label>
            <input type="text" name="title" required value="{{ old('title', $post->title) }}"
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-slate-900 placeholder-slate-400"
                placeholder="Enter an engaging title for your insight">
            @error('title')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Slug Field -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-900 mb-2">
                URL Slug <span class="text-red-600">*</span>
            </label>
            <input type="text" name="slug" required value="{{ old('slug', $post->slug) }}"
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-slate-900 placeholder-slate-400"
                placeholder="url-slug-format">
            <p class="text-xs text-slate-500 mt-1">Used in the URL: /insights/your-slug</p>
            @error('slug')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category and Read Time -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">
                    Category <span class="text-red-600">*</span>
                </label>
                <input type="text" name="category" required value="{{ old('category', $post->category) }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-slate-900 placeholder-slate-400"
                    placeholder="e.g., Mental Health, Wellness">
                @error('category')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-900 mb-2">
                    Read Time <span class="text-slate-500 font-normal">(minutes)</span>
                </label>
                <input type="number" name="read_time" min="1" value="{{ old('read_time', $post->read_time) }}"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-slate-900 placeholder-slate-400"
                    placeholder="5">
                @error('read_time')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Featured Image -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-900 mb-2">Featured Image</label>
            @if($post->image_url)
                <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-900">Current image</p>
                        <p class="text-xs text-slate-600">{{ basename($post->image_url) }}</p>
                    </div>
                    <span class="text-xs font-semibold text-blue-700">Upload new to replace</span>
                </div>
            @endif
            <div class="border-2 border-dashed border-slate-300 rounded-lg p-8 text-center hover:border-slate-400 transition-colors">
                <svg class="w-12 h-12 text-slate-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <input type="file" name="image" accept="image/*" class="hidden" id="imageInput">
                <label for="imageInput" class="cursor-pointer">
                    <p class="text-sm font-medium text-slate-900">Click to upload or drag and drop</p>
                    <p class="text-xs text-slate-500 mt-1">Recommended: 1200x600px (PNG, JPG, GIF)</p>
                </label>
            </div>
            @error('image')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Excerpt -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-900 mb-2">Excerpt <span class="text-slate-500 font-normal">(Summary)</span></label>
            <textarea name="excerpt" rows="3"
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-slate-900 placeholder-slate-400 resize-vertical"
                placeholder="Brief summary of your insight (displayed in lists)">{{ old('excerpt', $post->excerpt) }}</textarea>
            @error('excerpt')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Content Editor -->
        <div class="mb-6">
            <label class="block text-sm font-semibold text-slate-900 mb-2">
                Content <span class="text-red-600">*</span>
            </label>
            <div id="contentEditor" class="bg-white border border-slate-200 rounded-lg min-h-96 mb-2"></div>
            <input type="hidden" id="contentHidden" name="content" value="">
            @error('content')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Publish Date -->
        <div class="mb-8">
            <label class="block text-sm font-semibold text-slate-900 mb-2">
                Publish Date & Time <span class="text-slate-500 font-normal">(leave empty to keep as draft)</span>
            </label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500 text-slate-900">
            @error('published_at')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3">
            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-semibold hover:shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Insight
            </button>
            <a href="{{ route('admin.blog') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-100 text-slate-700 rounded-lg font-semibold hover:bg-slate-200 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Cancel
            </a>
        </div>
    </form>
</div>

<!-- Quill Editor Script -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    let quill = new Quill('#contentEditor', {
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

    // Try to load existing content
    try {
        const content = '{{ addslashes($post->content) }}';
        if (content && content.trim()) {
            quill.setContents(JSON.parse(content));
        }
    } catch (e) {
        // If content is not JSON, just set as text
        quill.setText('{{ addslashes($post->content) }}');
    }

    // Handle form submission
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        
        // Update hidden field whenever content changes
        quill.on('text-change', function() {
            const content = quill.getContents();
            document.getElementById('contentHidden').value = JSON.stringify(content);
        });
        
        // When form is about to submit
        form.addEventListener('submit', function(e) {
            // Get the editor content one more time to ensure it's up to date
            const editorText = quill.getText().trim();
            const content = quill.getContents();
            
            // Validate that content is not empty
            if (!editorText || editorText.length === 0) {
                e.preventDefault();
                alert('Please enter some content for your insight.');
                return false;
            }
            
            // Make sure hidden field is populated
            document.getElementById('contentHidden').value = JSON.stringify(content);
            return true;
        });
    });
</script>

@endsection
