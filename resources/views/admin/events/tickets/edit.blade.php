@extends('layouts.admin')

@section('title', 'Edit Ticket - TREC')
@section('page-title', 'Edit Ticket: ' . $ticket->name)
@section('page-subtitle', 'For event: ' . $event->name)

@section('action-button')
<a href="{{ route('admin.events.tickets.index', $event) }}" class="inline-flex items-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-4 py-2 rounded-xl font-medium transition-colors shadow-sm">
    <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Tickets
</a>
@endsection

@section('content')
<div class="max-w-5xl mx-auto pb-24">
    <form action="{{ route('admin.events.tickets.update', [$event, $ticket]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="space-y-8 md:space-y-12">
            
            {{-- Section 1: Basic Information --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 xl:gap-10">
                <div class="xl:col-span-1">
                    <div class="sticky top-24">
                        <h3 class="text-lg font-bold text-slate-900">Basic Details</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">Name your ticket and set its primary type. The description helps attendees understand what's included.</p>
                    </div>
                </div>
                <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="name" class="form-label">Ticket Name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $ticket->name) }}" required class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 transition-colors">
                        </div>

                        <div>
                            <label for="type" class="form-label">Ticket Type</label>
                            <select name="type" id="type" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 transition-colors">
                                <option value="early_bird" {{ old('type', $ticket->type) == 'early_bird' ? 'selected' : '' }}>Early Bird</option>
                                <option value="standard" {{ old('type', $ticket->type) == 'standard' ? 'selected' : '' }}>Standard</option>
                                <option value="vip" {{ old('type', $ticket->type) == 'vip' ? 'selected' : '' }}>VIP</option>
                                <option value="student" {{ old('type', $ticket->type) == 'student' ? 'selected' : '' }}>Student</option>
                                <option value="virtual" {{ old('type', $ticket->type) == 'virtual' ? 'selected' : '' }}>Virtual</option>
                                <option value="team" {{ old('type', $ticket->type) == 'team' ? 'selected' : '' }}>Team Registration</option>
                            </select>
                        </div>

                        <div id="team_size_container" style="{{ old('type', $ticket->type) == 'team' ? '' : 'display: none;' }}">
                            <label for="team_size" class="form-label text-slate-900">Team Size <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="users" class="w-4 h-4 text-slate-400"></i>
                                </div>
                                <input type="number" name="team_size" id="team_size" value="{{ old('team_size', $ticket->team_size) }}" min="2" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 pl-10 transition-colors">
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Minimum 2 members per team.</p>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="form-label">Description & Benefits</label>
                        <textarea name="description" id="description" rows="3" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 transition-colors">{{ old('description', $ticket->description) }}</textarea>
                    </div>
                </div>
            </div>
            
            <hr class="border-slate-100">

            {{-- Section 2: Pricing & Capacity --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 xl:gap-10">
                <div class="xl:col-span-1">
                    <div class="sticky top-24">
                        <h3 class="text-lg font-bold text-slate-900">Pricing & Capacity</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">Determine the cost of this ticket and limit how many can be sold.</p>
                    </div>
                </div>
                <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price" class="form-label">Price</label>
                            <div class="relative flex items-center">
                                <span class="absolute left-4 text-slate-500 font-semibold">₦</span>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $ticket->price) }}" required class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 pl-9 transition-colors text-lg font-semibold text-slate-900">
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Leave at 0.00 for free tickets.</p>
                        </div>

                        <div>
                            <label for="quantity_available" class="form-label">Quantity Available</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="hash" class="w-4 h-4 text-slate-400"></i>
                                </div>
                                <input type="number" name="quantity_available" id="quantity_available" value="{{ old('quantity_available', $ticket->quantity_available) }}" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 pl-10 transition-colors">
                            </div>
                            <p class="text-xs text-slate-400 mt-1.5">Leave empty for unlimited. Currently sold: <strong>{{ $ticket->quantity_sold }}</strong>.</p>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-slate-100">

            {{-- Section 3: Sales Rules --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 xl:gap-10">
                <div class="xl:col-span-1">
                    <div class="sticky top-24">
                        <h3 class="text-lg font-bold text-slate-900">Sales Rules</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">Control exactly when this ticket goes on sale, who can see it, and its display order.</p>
                    </div>
                </div>
                <div class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="sales_start" class="form-label">Sales Start (Optional)</label>
                            <input type="datetime-local" name="sales_start" id="sales_start" value="{{ old('sales_start', $ticket->sales_start ? $ticket->sales_start->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 transition-colors">
                        </div>
                        <div>
                            <label for="sales_end" class="form-label">Sales End (Optional)</label>
                            <input type="datetime-local" name="sales_end" id="sales_end" value="{{ old('sales_end', $ticket->sales_end ? $ticket->sales_end->format('Y-m-d\TH:i') : '') }}" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 transition-colors">
                        </div>

                        <div>
                            <label for="access_type" class="form-label">Access Visibility</label>
                            <select name="access_type" id="access_type" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 transition-colors">
                                <option value="public" {{ old('access_type', $ticket->access_type) == 'public' ? 'selected' : '' }}>Public (Visible to everyone)</option>
                                <option value="invite_only" {{ old('access_type', $ticket->access_type) == 'invite_only' ? 'selected' : '' }}>Invite Only (Hidden)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="display_order" class="form-label">Display Order</label>
                            <input type="number" name="display_order" id="display_order" value="{{ old('display_order', $ticket->display_order) }}" class="w-full rounded-xl border-slate-200 focus:border-red-500 focus:ring-red-500 transition-colors">
                            <p class="text-xs text-slate-400 mt-1.5">Lower numbers appear first.</p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="form-label">Ticket Status</label>
                            <label class="relative inline-flex items-center cursor-pointer mt-1">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $ticket->is_active) ? 'checked' : '' }} class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                                <span class="ml-3 text-sm font-medium text-slate-700">Active (Available for purchase)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Sticky Bottom Bar --}}
        <div class="fixed bottom-0 left-0 right-0 md:left-64 bg-white/90 backdrop-blur-md border-t border-slate-200 p-4 z-40">
            <div class="max-w-5xl mx-auto flex items-center justify-between">
                <div>
                    @if($errors->any())
                        <span class="text-sm font-semibold text-red-600 flex items-center gap-1.5">
                            <i data-lucide="alert-circle" class="w-4 h-4"></i> Form contains errors
                        </span>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.events.tickets.index', $event) }}" class="px-5 py-2.5 text-sm font-semibold text-slate-600 hover:text-slate-900 transition-colors">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-red-600/30 transition-all flex items-center gap-2 hover:-translate-y-0.5">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const teamSizeContainer = document.getElementById('team_size_container');
            const teamSizeInput = document.getElementById('team_size');

            function toggleTeamSize() {
                if (typeSelect.value === 'team') {
                    teamSizeContainer.style.display = 'block';
                    teamSizeInput.required = true;
                } else {
                    teamSizeContainer.style.display = 'none';
                    teamSizeInput.required = false;
                    teamSizeInput.value = '';
                }
            }

            typeSelect.addEventListener('change', toggleTeamSize);
            toggleTeamSize();
        });
    </script>
@endpush
