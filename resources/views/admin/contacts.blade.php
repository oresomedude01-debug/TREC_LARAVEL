@extends('layouts.admin')

@section('title', 'Manage Messages - TREC Admin')
@section('page-title', 'Messages')
@section('page-subtitle', 'View and manage contact form submissions')

@section('content')
    <div class="bg-white rounded-lg shadow-md border border-slate-200 overflow-hidden">
        @if($submissions->count())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Email</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Service Interest</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Phone</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($submissions as $submission)
                            <tr class="hover:bg-slate-50 transition-colors cursor-pointer" onclick="toggleDetails(this)">
                                <td class="px-6 py-4">
                                    <p class="font-medium text-slate-900">{{ $submission->first_name }} {{ $submission->last_name }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="mailto:{{ $submission->email }}" class="text-blue-600 hover:text-blue-800 text-sm">{{ $submission->email }}</a>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        {{ $submission->service_interest }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $submission->phone ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $submission->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if(!$submission->read)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                                            <span class="w-2 h-2 bg-amber-600 rounded-full"></span>
                                            Unread
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-700">
                                            <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                                            Read
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="details-row hidden border-b border-slate-100">
                                <td colspan="6" class="px-6 py-4">
                                    <div class="bg-slate-50 rounded-lg p-4">
                                        <h4 class="font-semibold text-slate-900 mb-3">Message Details</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Name</p>
                                                <p class="text-slate-900">{{ $submission->first_name }} {{ $submission->last_name }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Email</p>
                                                <p class="text-slate-900"><a href="mailto:{{ $submission->email }}" class="text-blue-600 hover:text-blue-800">{{ $submission->email }}</a></p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Phone</p>
                                                <p class="text-slate-900">{{ $submission->phone ?? 'Not provided' }}</p>
                                            </div>
                                            <div>
                                                <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Organisation</p>
                                                <p class="text-slate-900">{{ $submission->organisation ?? 'Not provided' }}</p>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-xs text-slate-500 uppercase font-semibold mb-1">Message</p>
                                            <p class="text-slate-700 text-sm leading-relaxed">{{ $submission->message ?? 'No message provided' }}</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($submissions->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                    <div class="text-sm text-slate-600">
                        Showing <span class="font-medium">{{ $submissions->from() }}</span> to <span class="font-medium">{{ $submissions->to() }}</span> of <span class="font-medium">{{ $submissions->total() }}</span> messages
                    </div>
                    <div class="flex items-center gap-2">
                        @if($submissions->onFirstPage())
                            <button disabled class="px-4 py-2 text-sm font-medium text-slate-400 bg-slate-100 rounded-lg cursor-not-allowed">← Previous</button>
                        @else
                            <a href="{{ $submissions->previousPageUrl() }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">← Previous</a>
                        @endif

                        @if($submissions->hasMorePages())
                            <a href="{{ $submissions->nextPageUrl() }}" class="px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100 rounded-lg transition-colors">Next →</a>
                        @else
                            <button disabled class="px-4 py-2 text-sm font-medium text-slate-400 bg-slate-100 rounded-lg cursor-not-allowed">Next →</button>
                        @endif
                    </div>
                </div>
            @endif
        @else
            <div class="px-6 py-12 text-center">
                <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8a6 6 0 016-6h.01a6 6 0 016 6v.01a6 6 0 01-6 6H9a6 6 0 01-6-6V8zm15 6h.01a6 6 0 110-12H24a6 6 0 110 12z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">No messages yet</h3>
                <p class="text-slate-600">Contact form submissions will appear here.</p>
            </div>
        @endif
    </div>

    <script>
        function toggleDetails(row) {
            const nextRow = row.nextElementSibling;
            if (nextRow && nextRow.classList.contains('details-row')) {
                nextRow.classList.toggle('hidden');
            }
        }
    </script>
@endsection
