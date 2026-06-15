<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="author" content="The Ripple Effect Consult (TREC)">
    <title>@yield('title', 'Admin Portal - TREC') – The Ripple Effect Consult</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* ── Global Typography ── */
        * {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
                'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue', sans-serif;
        }

        /* ── Scrollbar Hide Utility ── */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* ── Base Form Inputs (text, number, url, email, date, time, datetime-local) ── */
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="url"],
        input[type="password"],
        input[type="date"],
        input[type="time"],
        input[type="datetime-local"],
        input[type="search"],
        textarea {
            display: block;
            width: 100%;
            padding: 0.5625rem 0.875rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #0f172a;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.04);
            transition: border-color 180ms ease, box-shadow 180ms ease, background-color 180ms ease;
            outline: none;
            appearance: none;
        }

        input[type="text"]:hover:not(:disabled),
        input[type="number"]:hover:not(:disabled),
        input[type="email"]:hover:not(:disabled),
        input[type="url"]:hover:not(:disabled),
        input[type="password"]:hover:not(:disabled),
        input[type="date"]:hover:not(:disabled),
        input[type="time"]:hover:not(:disabled),
        input[type="datetime-local"]:hover:not(:disabled),
        input[type="search"]:hover:not(:disabled),
        textarea:hover:not(:disabled) {
            border-color: #94a3b8;
            background-color: #f8fafc;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="url"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="datetime-local"]:focus,
        input[type="search"]:focus,
        textarea:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12), 0 1px 2px 0 rgba(0,0,0,0.04);
            background-color: #ffffff;
        }

        input:disabled, textarea:disabled, select:disabled {
            background-color: #f1f5f9;
            color: #94a3b8;
            cursor: not-allowed;
            border-color: #e2e8f0;
        }

        /* Placeholder styling */
        input::placeholder, textarea::placeholder { color: #94a3b8; font-weight: 400; }

        /* ── Selects ── */
        select {
            display: block;
            width: 100%;
            padding: 0.5625rem 2.25rem 0.5625rem 0.875rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #0f172a;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.6rem center;
            background-size: 1.2em 1.2em;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.04);
            appearance: none;
            cursor: pointer;
            transition: border-color 180ms ease, box-shadow 180ms ease, background-color 180ms ease;
            outline: none;
        }

        select:hover:not(:disabled) {
            border-color: #94a3b8;
            background-color: #f8fafc;
        }

        select:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12), 0 1px 2px 0 rgba(0,0,0,0.04);
            background-color: #ffffff;
        }

        /* ── Checkboxes & Radios ── */
        input[type="checkbox"],
        input[type="radio"] {
            width: 1rem;
            height: 1rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 0.25rem;
            cursor: pointer;
            accent-color: #ef4444;
            transition: border-color 150ms ease, box-shadow 150ms ease;
            outline: none;
        }

        input[type="checkbox"]:hover,
        input[type="radio"]:hover {
            border-color: #ef4444;
        }

        input[type="checkbox"]:focus,
        input[type="radio"]:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
        }

        /* ── Input Groups (prefix/suffix) ── */
        .input-group {
            display: flex;
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.04);
        }

        .input-group-prefix,
        .input-group-suffix {
            display: inline-flex;
            align-items: center;
            padding: 0 0.875rem;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            white-space: nowrap;
            transition: border-color 180ms ease, background-color 180ms ease;
            flex-shrink: 0;
        }

        .input-group-prefix { border-right: none; border-radius: 0.5rem 0 0 0.5rem; }
        .input-group-suffix { border-left: none; border-radius: 0 0.5rem 0.5rem 0; }

        .input-group:focus-within .input-group-prefix,
        .input-group:focus-within .input-group-suffix {
            border-color: #ef4444;
            background-color: #fff5f5;
            color: #ef4444;
        }

        .input-group input {
            border-radius: 0;
            flex: 1;
            min-width: 0;
            box-shadow: none;
        }

        .input-group input:first-child { border-radius: 0.5rem 0 0 0.5rem; }
        .input-group input:last-child  { border-radius: 0 0 0.5rem 0.5rem; }

        /* ── File Upload Drop Zone ── */
        .file-drop-zone {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            border: 2px dashed #cbd5e1;
            border-radius: 0.75rem;
            background-color: #f8fafc;
            cursor: pointer;
            transition: border-color 200ms ease, background-color 200ms ease;
            text-align: center;
            gap: 0.5rem;
        }

        .file-drop-zone:hover,
        .file-drop-zone.dragover {
            border-color: #ef4444;
            background-color: #fff5f5;
        }

        .file-drop-zone.dragover .drop-icon { color: #ef4444; }

        .file-drop-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            border: none;
            box-shadow: none;
            padding: 0;
            border-radius: 0.75rem;
        }

        .file-drop-zone input[type="file"]:focus { box-shadow: 0 0 0 3px rgba(239,68,68,0.15); }

        /* ── Labels ── */
        label.form-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.375rem;
            letter-spacing: 0.01em;
        }

        /* ── Helper Text ── */
        .form-hint {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 0.375rem;
            line-height: 1.4;
        }

        /* ── Error State ── */
        .field-error input,
        .field-error textarea,
        .field-error select {
            border-color: #f87171 !important;
            background-color: #fff5f5 !important;
        }

        .field-error input:focus,
        .field-error textarea:focus,
        .field-error select:focus {
            box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.18) !important;
        }

        .field-error .field-error-msg {
            display: block;
            font-size: 0.75rem;
            color: #ef4444;
            margin-top: 0.375rem;
            font-weight: 500;
        }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5625rem 1.25rem;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: background-color 150ms ease, box-shadow 150ms ease, transform 100ms ease;
            text-decoration: none;
            outline: none;
            white-space: nowrap;
        }

        .btn:active { transform: translateY(1px); }
        .btn:focus-visible { box-shadow: 0 0 0 3px rgba(239,68,68,0.25); }

        .btn-primary { background-color: #dc2626; color: #fff; box-shadow: 0 1px 3px rgba(220,38,38,0.35); }
        .btn-primary:hover { background-color: #b91c1c; box-shadow: 0 4px 12px rgba(220,38,38,0.35); }

        .btn-secondary { background-color: #f1f5f9; color: #374151; }
        .btn-secondary:hover { background-color: #e2e8f0; }

        .btn-danger-ghost { background-color: transparent; color: #ef4444; }
        .btn-danger-ghost:hover { background-color: #fff5f5; }

        /* ── Textarea auto-grow hint ── */
        textarea { resize: vertical; min-height: 90px; }

        /* ── Form Section Headers ── */
        .form-section-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.25rem;
        }

        .form-section-subtitle {
            font-size: 0.8125rem;
            color: #64748b;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <div class="flex h-screen overflow-hidden">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 z-30 hidden md:hidden transition-opacity"></div>

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white shadow-xl flex flex-col transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
            <!-- Logo Section -->
            <div class="p-6 border-b border-slate-700">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center font-bold text-white shadow-lg">
                        T
                    </div>
                    <div class="flex-1">
                        <div class="font-bold text-sm">TREC Admin</div>
                        <div class="text-xs text-slate-400">Control Panel</div>
                    </div>
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 overflow-y-auto px-4 py-6">
                <div class="space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11v-5m0 0V9m0 0H9m4 0h4"></path>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Insights Management -->
                    <div class="pt-4">
                        <div class="px-4 mb-2">
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Content</span>
                        </div>
                        <a href="{{ route('admin.blog') }}" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.blog*') ? 'bg-red-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z"></path>
                            </svg>
                            <span class="font-medium">Insights</span>
                        </a>
                    </div>

                    <!-- Events Management -->
                    <div class="pt-4">
                        <div class="px-4 mb-2">
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Events</span>
                        </div>
                        <a href="{{ route('admin.events.dashboard') }}" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.events.*') ? 'bg-red-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium">Events</span>
                        </a>
                    </div>

                    <!-- Management Section -->
                    <div class="pt-4">
                        <div class="px-4 mb-2">
                            <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Management</span>
                        </div>
                        <a href="{{ route('admin.contacts') }}" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.contacts') ? 'bg-red-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8a6 6 0 016-6h.01a6 6 0 016 6v.01a6 6 0 01-6 6H9a6 6 0 01-6-6V8zm15 6h.01a6 6 0 110-12H24a6 6 0 110 12z"></path>
                            </svg>
                            <span class="font-medium">Messages</span>
                        </a>
                        <a href="{{ route('admin.settings') }}" class="group flex items-center gap-3 px-4 py-3 rounded-lg transition-all duration-200 {{ request()->routeIs('admin.settings*') ? 'bg-red-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="font-medium">Settings</span>
                        </a>
                    </div>
                </div>
            </nav>


            <!-- User Section -->
            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center justify-between p-3 bg-slate-700/50 rounded-lg">
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium truncate">Admin User</div>
                        <div class="text-xs text-slate-400 truncate">{{ auth()->user()->email ?? 'admin@trec.com' }}</div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                        @csrf
                        <button type="submit" class="p-2 hover:bg-slate-600 rounded-lg transition-colors" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation Bar -->
            <header class="bg-white border-b border-slate-200 shadow-sm sticky top-0 z-20">
                <div class="flex items-center justify-between px-4 md:px-8 py-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">@yield('page-title', 'Dashboard')</h1>
                        @hasSection('page-subtitle')
                            <p class="text-sm text-slate-500 mt-1">@yield('page-subtitle')</p>
                        @endif
                    </div>
                    <div class="flex items-center gap-6">
                        <!-- Quick Action Button -->
                        @hasSection('action-button')
                            @yield('action-button')
                        @endif

                        <!-- User Menu (Mobile) -->
                        <button id="mobile-menu-button" class="md:hidden p-2 hover:bg-slate-100 text-slate-600 rounded-lg transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto w-full max-w-full">
                <div class="px-4 md:px-8 py-6 max-w-full overflow-hidden">
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800">
                            <p class="font-semibold mb-2">Please fix the following errors:</p>
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 flex items-center justify-between">
                            <div>
                                <p class="font-semibold">Success!</p>
                                <p class="text-sm">{{ session('success') }}</p>
                            </div>
                            <button type="button" onclick="this.parentElement.style.display='none'" class="text-green-600 hover:text-green-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileBtn = document.getElementById('mobile-menu-button');
            const overlay = document.getElementById('sidebar-overlay');
            let isSidebarOpen = false;

            function toggleSidebar() {
                isSidebarOpen = !isSidebarOpen;
                if (isSidebarOpen) {
                    sidebar.classList.remove('-translate-x-full');
                    overlay.classList.remove('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            }

            if (mobileBtn) {
                mobileBtn.addEventListener('click', toggleSidebar);
            }
            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }
        });
    </script>

    <!-- ── Global Drag & Drop File Zone JS ── -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Init all drop zones
            document.querySelectorAll('.file-drop-zone').forEach(function (zone) {
                const input    = zone.querySelector('input[type="file"]');
                const nameTag  = zone.querySelector('[id$="-file-name"]');

                if (!input) return;

                // Drag enter/leave visual feedback
                zone.addEventListener('dragover', function (e) {
                    e.preventDefault();
                    zone.classList.add('dragover');
                });
                ['dragleave', 'dragend', 'drop'].forEach(function (evt) {
                    zone.addEventListener(evt, function () {
                        zone.classList.remove('dragover');
                    });
                });

                // Handle drop
                zone.addEventListener('drop', function (e) {
                    e.preventDefault();
                    if (e.dataTransfer.files.length) {
                        input.files = e.dataTransfer.files;
                        showFileName(e.dataTransfer.files[0]);
                    }
                });

                // Handle normal click-select
                input.addEventListener('change', function () {
                    if (input.files.length) showFileName(input.files[0]);
                });

                function showFileName(file) {
                    if (!nameTag) return;
                    // Client-side size guard (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        nameTag.textContent = '⚠ File too large (max 2MB)';
                        nameTag.classList.remove('hidden');
                        nameTag.style.color = '#ef4444';
                        return;
                    }
                    nameTag.textContent = '✓ ' + file.name;
                    nameTag.classList.remove('hidden');
                    nameTag.style.color = '#16a34a';
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
