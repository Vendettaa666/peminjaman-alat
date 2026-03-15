<aside id="app-sidebar"
       class="w-64 shrink-0 h-screen flex flex-col
              bg-[#1c1d35] border-r border-white/[0.06]
              fixed md:static z-30
              -translate-x-full md:translate-x-0
              transition-transform duration-300 ease-in-out">

    {{-- ── BRAND ────────────────────────────────────────── --}}
    <div class="flex items-center gap-3 px-5 py-5 border-b border-white/[0.06]">
        <div class="w-9 h-9 rounded-xl bg-indigo-500/20 border border-indigo-500/30
                    flex items-center justify-center shrink-0">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="#818cf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                <polyline points="9 22 9 12 15 12 15 22"/>
            </svg>
        </div>
        <div>
            <p class="text-white font-bold text-sm tracking-widest leading-none">SARPRAS</p>
            <p class="text-slate-500 text-[10px] font-medium leading-none mt-0.5">Peminjaman Sekolah</p>
        </div>
    </div>

    {{-- ── USER CARD ───────────────────────────────────────── --}}
    <div class="mx-4 mt-4 rounded-xl bg-white/[0.04] border border-white/[0.06] p-3.5">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600
                        flex items-center justify-center text-white text-sm font-bold shrink-0">
                {{ strtoupper(substr(Auth::user()->nama_lengkap ?? 'G', 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-slate-200 truncate leading-none">
                    {{ Auth::user()->nama_lengkap ?? 'Guest' }}
                </p>
                <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider
                    {{ Auth::user()->role == 'admin'   ? 'bg-rose-500/15 text-rose-400 border border-rose-500/20' :
                       (Auth::user()->role == 'petugas' ? 'bg-emerald-500/15 text-emerald-400 border border-emerald-500/20' :
                                                          'bg-indigo-500/15 text-indigo-400 border border-indigo-500/20') }}">
                    {{ ucfirst(Auth::user()->role ?? 'user') }}
                </span>
            </div>
        </div>
    </div>

    {{-- ── NAV ─────────────────────────────────────────────── --}}
    <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">

        {{-- Helper macro: nav link --}}
        @php
            function navLink(string $route, string $icon, string $label, bool $highlight = false): string {
                $active = request()->routeIs($route) || request()->routeIs($route.'.*');
                $base   = 'flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group';
                if ($active)
                    return "<a href=\"".route($route)."\" class=\"$base bg-indigo-500/20 text-indigo-300 border border-indigo-500/20\"><i class=\"$icon w-4 text-center text-indigo-400\"></i>$label</a>";
                if ($highlight)
                    return "<a href=\"".route($route)."\" class=\"$base bg-indigo-600/80 hover:bg-indigo-600 text-white\"><i class=\"$icon w-4 text-center\"></i>$label</a>";
                return "<a href=\"".route($route)."\" class=\"$base text-slate-400 hover:text-white hover:bg-white/[0.06]\"><i class=\"$icon w-4 text-center group-hover:text-indigo-400 transition-colors\"></i>$label</a>";
            }
        @endphp

        {{-- Semua role: Dashboard --}}
        {!! navLink('dashboard', 'fas fa-house', 'Dashboard') !!}

        {{-- ── ADMIN ── --}}
        @if(Auth::user()->role == 'admin')

            <div class="pt-4 pb-1.5 px-3.5">
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Manajemen Data</p>
            </div>

            {!! navLink('user.index',     'fas fa-users',          'Kelola User') !!}
            {!! navLink('kategori.index', 'fas fa-tags',           'Kelola Kategori') !!}
            {!! navLink('alat.index',     'fas fa-screwdriver-wrench', 'Kelola Alat') !!}

            <div class="pt-4 pb-1.5 px-3.5">
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Transaksi</p>
            </div>

            {!! navLink('peminjaman.index',    'fas fa-handshake',      'Data Peminjaman') !!}
            {!! navLink('pengembalian.index',  'fas fa-rotate-left',    'Data Pengembalian') !!}
            {!! navLink('log_aktivitas.index', 'fas fa-clipboard-list', 'Log Aktivitas') !!}

        {{-- ── PETUGAS ── --}}
        @elseif(Auth::user()->role == 'petugas')

            <div class="pt-4 pb-1.5 px-3.5">
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Tugas Petugas</p>
            </div>

            {!! navLink('peminjaman.index',   'fas fa-handshake',   'Setujui Peminjaman') !!}
            {!! navLink('pengembalian.index', 'fas fa-rotate-left', 'Pantau Pengembalian') !!}
            {!! navLink('alat.index',         'fas fa-eye',         'Lihat Daftar Alat') !!}

        {{-- ── PEMINJAM ── --}}
        @else

            <div class="pt-4 pb-1.5 px-3.5">
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Menu Peminjam</p>
            </div>

            {!! navLink('alat.index',       'fas fa-magnifying-glass', 'Lihat Daftar Alat') !!}
            {!! navLink('peminjaman.ajukan','fas fa-plus',              'Ajukan Peminjaman', true) !!}
            {!! navLink('peminjaman.index', 'fas fa-list',              'Peminjaman Saya') !!}
            {!! navLink('pengembalian.index','fas fa-clock-rotate-left','Riwayat Pengembalian') !!}

        @endif
    </nav>

    {{-- ── LOGOUT ───────────────────────────────────────────── --}}
    <div class="px-3 py-4 border-t border-white/[0.06]">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2.5 px-4 py-2.5
                           rounded-xl text-sm font-semibold
                           bg-red-500/10 hover:bg-red-500/20
                           border border-red-500/20 hover:border-red-500/40
                           text-red-400 hover:text-red-300
                           transition-all duration-200">
                <i class="fas fa-arrow-right-from-bracket text-sm"></i>
                Keluar
            </button>
        </form>
    </div>
</aside>
