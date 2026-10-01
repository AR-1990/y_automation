<!DOCTYPE html>
<html lang="en" class="antialiased">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - AISM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        
        /* Sidebar Collapse Styles */
        #sidebar { transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .sidebar-collapsed #sidebar { width: 4.5rem; } /* Made collapsed state slimmer */
        .sidebar-collapsed .sidebar-text { display: none; }
        .sidebar-collapsed .menu-item { justify-content: center; padding: 0.75rem 0; margin: 0 0.5rem; }
        .sidebar-collapsed .menu-icon { margin: 0; font-size: 1.1rem; }
        .sidebar-collapsed .section-title { opacity: 0; height: 0; margin: 0; padding: 0; }
        .sidebar-collapsed #toggle-icon { transform: rotate(180deg); }
        .sidebar-collapsed .logo-container { justify-content: center; padding: 0; }
        .sidebar-collapsed .logo-text { display: none; }
        .sidebar-collapsed .profile-info { display: none; }
        
        /* Animations & Scrollbars */
        .animate-fade-in-down { animation: fadeInDown 0.4s ease-out; }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Page Loader */
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #f8fafc;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }
        .loader-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid rgba(79, 70, 229, 0.2);
            border-radius: 50%;
            border-top-color: #4f46e5;
            animation: spin 1s ease-in-out infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .loader-hidden {
            opacity: 0;
            visibility: hidden;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        .custom-scrollbar:hover::-webkit-scrollbar-thumb { background: #94a3b8; }
    </style>
    <script>
        // Check localStorage immediately to prevent FOUC (Flash of Unstyled Content)
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            document.documentElement.classList.add('sidebar-collapsed');
        }
    </script>
</head>
<body class="text-slate-800 h-screen flex overflow-hidden selection:bg-indigo-100 selection:text-indigo-900">

    <!-- Page Loader -->
    <div id="page-loader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-white border-r border-slate-200 flex flex-col hidden md:flex relative z-20">
        
        <!-- Logo -->
        <div class="h-16 flex items-center px-6 border-b border-slate-100 logo-container transition-all">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-indigo-600 rounded flex items-center justify-center flex-shrink-0">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 7L12 12L22 7L12 2Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <span class="font-bold text-base tracking-tight text-slate-900 logo-text whitespace-nowrap">AISM Engine</span>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto py-4 px-3 space-y-1 custom-scrollbar">
            <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-2 section-title transition-all overflow-hidden">Main Menu</p>
            
            <a href="{{ route('dashboard') }}" class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-sm transition-all {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fas fa-chart-pie menu-icon w-5 text-center"></i>
                <span class="sidebar-text whitespace-nowrap">Dashboard</span>
            </a>
            
            <a href="#" class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-sm transition-all text-slate-600 hover:bg-slate-50">
                <i class="fas fa-satellite-dish menu-icon w-5 text-center"></i>
                <span class="sidebar-text whitespace-nowrap">Live Events</span>
            </a>
            
            <a href="#" class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-sm transition-all text-slate-600 hover:bg-slate-50">
                <i class="fas fa-video menu-icon w-5 text-center"></i>
                <span class="sidebar-text whitespace-nowrap">Highlight Library</span>
            </a>
            
            <p class="px-3 text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6 section-title transition-all overflow-hidden">Configuration</p>
            
            <a href="{{ route('settings.users.index') }}" class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-sm transition-all {{ request()->routeIs('settings.users.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fas fa-users-cog menu-icon w-5 text-center"></i>
                <span class="sidebar-text whitespace-nowrap">Users & Access</span>
            </a>
            
            <a href="{{ route('settings.apis.index') }}" class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-sm transition-all {{ request()->routeIs('settings.apis.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <i class="fas fa-key menu-icon w-5 text-center"></i>
                <span class="sidebar-text whitespace-nowrap">API Integrations</span>
            </a>
        </div>

        <!-- Footer / Profile -->
        <div class="p-3 border-t border-slate-100">
            <a href="{{ route('profile.edit') }}" class="menu-item flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-sm transition-all {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50' }}">
                <div class="w-7 h-7 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs flex-shrink-0 menu-icon">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="sidebar-text profile-info flex-1 overflow-hidden">
                    <p class="text-sm font-semibold truncate text-slate-900">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-slate-500 truncate -mt-0.5">Admin Profile</p>
                </div>
            </a>
            
            <form action="{{ route('logout') }}" method="POST" class="mt-1">
                @csrf
                <button type="submit" class="menu-item w-full flex items-center gap-3 px-3 py-2 rounded-lg font-medium text-sm transition-all text-slate-600 hover:bg-red-50 hover:text-red-600">
                    <i class="fas fa-sign-out-alt menu-icon w-5 text-center"></i>
                    <span class="sidebar-text whitespace-nowrap">Sign Out</span>
                </button>
            </form>
        </div>

        <!-- Collapse Toggle Button -->
        <button id="sidebarToggle" class="absolute -right-3 top-16 bg-white border border-slate-200 text-slate-400 hover:text-indigo-600 w-6 h-6 rounded-full flex items-center justify-center shadow-sm hover:shadow transition-all z-50 focus:outline-none">
            <i id="toggle-icon" class="fas fa-chevron-left text-[9px] transition-transform duration-300"></i>
        </button>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#FAFAFA]">
        
        <!-- Header -->
        <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-10">
            <h1 class="text-lg font-bold text-slate-800 tracking-tight">@yield('header', 'Overview')</h1>
            
            <div class="flex items-center gap-5">
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 shadow-sm">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-[10px] font-bold text-emerald-700 tracking-wide uppercase">System Active</span>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto p-8 relative custom-scrollbar">
            <div class="max-w-7xl mx-auto">
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl mb-6 flex items-center gap-3 shadow-sm animate-fade-in-down">
                        <i class="fas fa-check-circle text-emerald-500 text-lg"></i>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </main>

    <script>
        // Check localStorage immediately to prevent FOUC
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            document.documentElement.classList.add('sidebar-collapsed');
        }

        // Loader and Sidebar Logic
        window.addEventListener('load', () => {
            // Hide Loader only when everything (images, stylesheets, scripts) is fully loaded
            const loader = document.getElementById('page-loader');
            if(loader) {
                loader.classList.add('loader-hidden');
                // Remove from DOM after transition to avoid blocking clicks
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }
        });

        // Hide loader fallback in case 'load' event was missed (e.g. back/forward cache)
        window.addEventListener('pageshow', (event) => {
            if (event.persisted) { // If page is loaded from cache (like clicking browser back button)
                const loader = document.getElementById('page-loader');
                if(loader) {
                    loader.classList.add('loader-hidden');
                    loader.style.display = 'none';
                }
            }
        });

        document.addEventListener('DOMContentLoaded', () => {
            // Sidebar Toggle
            const toggleBtn = document.getElementById('sidebarToggle');
            const html = document.documentElement;

            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    html.classList.toggle('sidebar-collapsed');
                    localStorage.setItem('sidebarCollapsed', html.classList.contains('sidebar-collapsed'));
                });
            }
            
            // Add loading effect to links
            document.querySelectorAll('a:not([target="_blank"]):not([href="#"])').forEach(link => {
                link.addEventListener('click', function(e) {
                    // Only show loader if we are actually navigating away
                    if(this.href && this.href !== window.location.href && !e.ctrlKey && !e.metaKey) {
                        const loader = document.getElementById('page-loader');
                        if(loader) {
                            loader.style.display = 'flex';
                            // Small delay to allow CSS display:flex to apply before changing opacity
                            setTimeout(() => {
                                loader.classList.remove('loader-hidden');
                            }, 10);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
