@extends('layouts.admin')

@section('title', 'Manage Insights - TREC Admin')
@section('page-title', 'Insights Management')
@section('page-subtitle', 'Create, edit, and publish insights for your audience')

@section('action-button')
    <a href="{{ route('admin.blog.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-medium hover:shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        New Insight
    </a>
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-md border border-slate-200 overflow-hidden">
        @if($posts->count())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Title</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Category</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Published</th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($posts as $post)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-medium text-slate-900">{{ $post->title }}</p>
                                        <p class="text-xs text-slate-500 mt-1">{{ Str::limit($post->content, 50) }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        {{ $post->category }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($post->published_at)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-700">
                                            <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $post->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <a href="{{ route('admin.blog.edit', $post) }}" class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.blog.delete', $post) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this insight? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                    <div class="text-sm text-slate-600">
                        Showing <span class="font-medium">{{ $posts->from() }}</span> to <span class="font-medium">{{ $posts->to() }}</span> of <span class="font-medium">{{ $posts->total() }}</span> insights
                    </div>
                    <div class="flex items-center gap-2">
                        @if($posts->onFirstPage())
                            <button disabled class="px-4 py-2 text-sm font-medium text-slate-400 bg-slate-100 rounded-lg cursor-not-allowed">← Previous</button>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">← Previous</a>
                        @endif

                        @if($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">Next →</a>
                        @else
                            <button disabled class="px-4 py-2 text-sm font-medium text-slate-400 bg-slate-100 rounded-lg cursor-not-allowed">Next →</button>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="px-6 py-12 text-center">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">No insights yet</h3>
                <p class="text-slate-600 mb-6">Start creating your first insight to share with your audience.</p>
                <a href="{{ route('admin.blog.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Your First Insight
                </a>
            </div>
        @endif
    </div>
@endsection
