@extends('layouts.admin')

@section('title', 'Admin Dashboard - TREC')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Welcome back! Here\'s an overview of your content.')

@section('action-button')
    <a href="{{ route('admin.blog.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-red-600 to-red-700 text-white rounded-lg font-medium hover:shadow-lg hover:from-red-700 hover:to-red-800 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        New Insight
    </a>
@endsection

@section('content')
    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Insights Card -->
        <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Insights</p>
                    <p class="text-4xl font-bold text-slate-900 mt-2">{{ $blogCount }}</p>
                    <p class="text-xs text-slate-500 mt-2">Content published</p>
                </div>
                <div class="p-4 bg-red-100 rounded-lg">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Messages Card -->
        <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Total Messages</p>
                    <p class="text-4xl font-bold text-slate-900 mt-2">{{ $contactCount }}</p>
                    <p class="text-xs text-slate-500 mt-2">Contact submissions</p>
                </div>
                <div class="p-4 bg-blue-100 rounded-lg">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8a6 6 0 016-6h.01a6 6 0 016 6v.01a6 6 0 01-6 6H9a6 6 0 01-6-6V8zm15 6h.01a6 6 0 110-12H24a6 6 0 110 12z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Unread Messages Card -->
        <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-600 text-sm font-medium">Unread Messages</p>
                    <p class="text-4xl font-bold text-amber-600 mt-2">{{ $unreadCount }}</p>
                    <p class="text-xs text-slate-500 mt-2">Awaiting your attention</p>
                </div>
                <div class="p-4 bg-amber-100 rounded-lg">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Actions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.blog.create') }}" class="flex items-center gap-3 p-4 bg-gradient-to-br from-red-50 to-red-100 rounded-lg border border-red-200 hover:border-red-300 hover:shadow-md transition-all group">
                        <div class="p-3 bg-red-600 rounded-lg group-hover:bg-red-700 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 text-sm">Create Insight</p>
                            <p class="text-xs text-slate-600">Write new content</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.blog') }}" class="flex items-center gap-3 p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg border border-blue-200 hover:border-blue-300 hover:shadow-md transition-all group">
                        <div class="p-3 bg-blue-600 rounded-lg group-hover:bg-blue-700 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 text-sm">Manage Insights</p>
                            <p class="text-xs text-slate-600">Edit or delete content</p>
                        </div>
                    </a>

                    <a href="{{ route('admin.contacts') }}" class="flex items-center gap-3 p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-lg border border-green-200 hover:border-green-300 hover:shadow-md transition-all group">
                        <div class="p-3 bg-green-600 rounded-lg group-hover:bg-green-700 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8a6 6 0 016-6h.01a6 6 0 016 6v.01a6 6 0 01-6 6H9a6 6 0 01-6-6V8zm15 6h.01a6 6 0 110-12H24a6 6 0 110 12z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 text-sm">View Messages</p>
                            <p class="text-xs text-slate-600">Check contact form</p>
                        </div>
                    </a>

                    <a href="{{ route('home') }}" class="flex items-center gap-3 p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg border border-purple-200 hover:border-purple-300 hover:shadow-md transition-all group">
                        <div class="p-3 bg-purple-600 rounded-lg group-hover:bg-purple-700 transition-colors">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900 text-sm">Visit Website</p>
                            <p class="text-xs text-slate-600">View live site</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">System Status</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Status</span>
                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                        <span class="w-2 h-2 bg-green-600 rounded-full"></span>
                        Active
                    </span>
                </div>
                <div class="border-t border-slate-200 pt-4">
                    <p class="text-xs text-slate-500 mb-2">Last Updated</p>
                    <p class="text-sm font-medium text-slate-900">Just now</p>
                </div>
                <div class="border-t border-slate-200 pt-4">
                    <p class="text-xs text-slate-500 mb-2">Admin Version</p>
                    <p class="text-sm font-medium text-slate-900">1.0.0</p>
                </div>
            </div>
        </div>
    </div>
@endsection
