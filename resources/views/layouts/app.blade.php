<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — SARPRAS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Scrollbar styling */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(99,102,241,0.3); border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(99,102,241,0.6); }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .page-enter { animation: fadeIn 0.4s ease forwards; }
    </style>
</head>

<body class="bg-[#13132a] min-h-screen">
    <div class="flex h-screen overflow-hidden">

        {{-- ── SIDEBAR ── --}}
        @include('layouts.sidebar')

        {{-- ── MAIN AREA ── --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- ── TOPBAR ── --}}
            <header class="flex items-center justify-between
                           bg-[#1c1d35]/90 backdrop-blur-md
                           border-b border-white/[0.06]
                           px-6 py-3.5 shrink-0">

                {{-- Left: Mobile hamburger + Page title --}}
                <div class="flex items-center gap-4">
                    {{-- Mobile sidebar toggle --}}
                    <button id="sidebar-toggle"
                            class="md:hidden w-9 h-9 flex items-center justify-center
                                   rounded-xl bg-white/5 hover:bg-white/10
                                   text-slate-400 hover:text-white transition-all">
                        <i class="fas fa-bars text-sm"></i>
                    </button>

                    {{-- Breadcrumb / Title --}}
                    <div>
                        <p class="text-[11px] text-slate-500 font-semibold uppercase tracking-widest leading-none mb-0.5">
                            Peminjaman Sarpras
                        </p>
                        <h2 class="text-base font-bold text-slate-100 leading-none">
                            @yield('title', 'Dashboard')
                        </h2>
                    </div>
                </div>

                {{-- Right: Actions --}}
                <div class="flex items-center gap-3">

                    {{-- Notification bell --}}
                    <button class="relative w-9 h-9 flex items-center justify-center
                                   rounded-xl bg-white/5 hover:bg-white/10
                                   text-slate-400 hover:text-white transition-all">
                        <i class="fas fa-bell text-sm"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full
                                     bg-indigo-500 ring-2 ring-[#1c1d35]"></span>
                    </button>

                    {{-- User pill --}}
                    <div class="flex items-center gap-2.5 bg-white/[0.05] hover:bg-white/[0.08]
                                border border-white/[0.07] rounded-xl px-3 py-2
                                cursor-pointer transition-all group">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600
                                    flex items-center justify-center text-white text-xs font-bold shrink-0">
                            {{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'G', 0, 1)) }}
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-xs font-semibold text-slate-200 leading-none">
                                {{ Auth::user()->nama_lengkap ?? 'Guest' }}
                            </p>
                            <p class="text-[10px] text-slate-500 leading-none mt-0.5 capitalize">
                                {{ Auth::user()->role ?? '' }}
                            </p>
                        </div>
                        <i class="fas fa-chevron-down text-[10px] text-slate-500
                                  group-hover:text-slate-300 transition-colors hidden sm:block ml-1"></i>
                    </div>
                </div>
            </header>

            {{-- ── PAGE CONTENT ── --}}
            <main class="flex-1 overflow-y-auto p-6 page-enter">
                {{-- Flash success --}}
                @if(session('success'))
                <div class="mb-5 flex items-center gap-3 bg-emerald-500/10 border border-emerald-500/25
                            rounded-xl px-4 py-3 text-sm text-emerald-300">
                    <i class="fas fa-circle-check text-emerald-400"></i>
                    {{ session('success') }}
                </div>
                @endif

                {{-- Flash error --}}
                @if(session('error'))
                <div class="mb-5 flex items-center gap-3 bg-red-500/10 border border-red-500/25
                            rounded-xl px-4 py-3 text-sm text-red-300">
                    <i class="fas fa-circle-xmark text-red-400"></i>
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Mobile sidebar overlay --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-black/50 backdrop-blur-sm z-20 hidden md:hidden"
         onclick="closeSidebar()"></div>

    <script>
        const toggle   = document.getElementById('sidebar-toggle');
        const overlay  = document.getElementById('sidebar-overlay');
        const sidebar  = document.getElementById('app-sidebar');

        function openSidebar()  { sidebar?.classList.remove('-translate-x-full'); overlay?.classList.remove('hidden'); }
        function closeSidebar() { sidebar?.classList.add('-translate-x-full');    overlay?.classList.add('hidden'); }

        toggle?.addEventListener('click', () => {
            sidebar?.classList.contains('-translate-x-full') ? openSidebar() : closeSidebar();
        });
    </script>
</body>
</html>
