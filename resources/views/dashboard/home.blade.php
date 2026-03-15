@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

{{-- ══════════════════════════════════════════════════════
     GREETING BANNER
══════════════════════════════════════════════════════ --}}
<div class="relative overflow-hidden rounded-2xl
            bg-gradient-to-br from-indigo-600/80 via-violet-700/70 to-purple-800/80
            border border-indigo-500/20 p-6 mb-6">

    {{-- Decorative blobs --}}
    <div class="pointer-events-none absolute -top-10 -right-10 w-52 h-52 rounded-full
                bg-violet-500/20 blur-3xl"></div>
    <div class="pointer-events-none absolute bottom-0 left-20 w-40 h-40 rounded-full
                bg-indigo-400/15 blur-2xl"></div>

    {{-- Dot grid --}}
    <div class="pointer-events-none absolute inset-0 rounded-2xl"
         style="background-image:radial-gradient(circle,rgba(255,255,255,0.07) 1px,transparent 1px);background-size:24px 24px;"></div>

    <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-indigo-200 text-sm font-medium mb-1">
                {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
            </p>
            <h1 class="text-2xl font-extrabold text-white leading-tight">
                Selamat datang kembali, <br class="sm:hidden">
                <span class="text-violet-200">{{ Auth::user()->nama_lengkap ?? 'Pengguna' }}</span> 👋
            </h1>
            <p class="text-indigo-200/70 text-sm mt-1">
                Berikut ringkasan aktivitas peminjaman sarana & prasarana hari ini.
            </p>
        </div>

        @if(Auth::user()->role == 'peminjam')
        <a href="{{ route('peminjaman.ajukan') }}"
           class="inline-flex items-center gap-2 bg-white text-indigo-700 font-bold text-sm
                  px-5 py-2.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-px
                  transition-all duration-200 shrink-0 self-start sm:self-auto">
            <i class="fas fa-plus"></i>
            Ajukan Peminjaman
        </a>
        @endif
    </div>
</div>

{{-- ══════════════════════════════════════════════════════
     STAT CARDS
══════════════════════════════════════════════════════ --}}
@php
    $stats = [];
    $role  = Auth::user()->role;

    if ($role == 'admin') {
        $stats = [
            ['icon' => 'fas fa-users',           'color' => 'indigo',  'label' => 'Total User',         'value' => $totalUser        ?? '—', 'sub' => 'terdaftar'],
            ['icon' => 'fas fa-screwdriver-wrench','color'=> 'violet', 'label' => 'Total Alat',         'value' => $totalAlat        ?? '—', 'sub' => 'item tersedia'],
            ['icon' => 'fas fa-handshake',        'color' => 'sky',     'label' => 'Peminjaman Aktif',   'value' => $peminjamanAktif  ?? '—', 'sub' => 'sedang berjalan'],
            ['icon' => 'fas fa-rotate-left',      'color' => 'emerald', 'label' => 'Pengembalian Hari Ini','value'=> $pengembalianHariIni ?? '—', 'sub' => 'item kembali'],
        ];
    } elseif ($role == 'petugas') {
        $stats = [
            ['icon' => 'fas fa-clock',            'color' => 'amber',   'label' => 'Menunggu Persetujuan','value' => $menungguPersetujuan ?? '—', 'sub' => 'permintaan baru'],
            ['icon' => 'fas fa-handshake',        'color' => 'indigo',  'label' => 'Sedang Dipinjam',    'value' => $sedangDipinjam    ?? '—', 'sub' => 'item aktif'],
            ['icon' => 'fas fa-rotate-left',      'color' => 'emerald', 'label' => 'Pengembalian Hari Ini','value'=> $pengembalianHariIni ?? '—', 'sub' => 'item kembali'],
            ['icon' => 'fas fa-screwdriver-wrench','color'=> 'violet',  'label' => 'Total Alat',         'value' => $totalAlat        ?? '—', 'sub' => 'item tersedia'],
        ];
    } else {
        $stats = [
            ['icon' => 'fas fa-list',             'color' => 'indigo',  'label' => 'Peminjaman Saya',    'value' => $peminjamanSaya    ?? '—', 'sub' => 'total pengajuan'],
            ['icon' => 'fas fa-clock',            'color' => 'amber',   'label' => 'Menunggu',           'value' => $menunggu          ?? '—', 'sub' => 'belum diproses'],
            ['icon' => 'fas fa-circle-check',     'color' => 'emerald', 'label' => 'Disetujui',          'value' => $disetujui         ?? '—', 'sub' => 'aktif dipinjam'],
            ['icon' => 'fas fa-rotate-left',      'color' => 'violet',  'label' => 'Dikembalikan',       'value' => $dikembalikan      ?? '—', 'sub' => 'selesai'],
        ];
    }

    $colorMap = [
        'indigo'  => ['bg' => 'bg-indigo-500/15',  'border' => 'border-indigo-500/20',  'icon' => 'text-indigo-400',  'val' => 'text-indigo-300'],
        'violet'  => ['bg' => 'bg-violet-500/15',  'border' => 'border-violet-500/20',  'icon' => 'text-violet-400',  'val' => 'text-violet-300'],
        'sky'     => ['bg' => 'bg-sky-500/15',     'border' => 'border-sky-500/20',     'icon' => 'text-sky-400',     'val' => 'text-sky-300'],
        'emerald' => ['bg' => 'bg-emerald-500/15', 'border' => 'border-emerald-500/20', 'icon' => 'text-emerald-400', 'val' => 'text-emerald-300'],
        'amber'   => ['bg' => 'bg-amber-500/15',   'border' => 'border-amber-500/20',   'icon' => 'text-amber-400',   'val' => 'text-amber-300'],
        'rose'    => ['bg' => 'bg-rose-500/15',    'border' => 'border-rose-500/20',    'icon' => 'text-rose-400',    'val' => 'text-rose-300'],
    ];
@endphp

<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @foreach($stats as $stat)
    @php $c = $colorMap[$stat['color']]; @endphp
    <div class="rounded-2xl bg-[#1c1d35] border border-white/[0.06]
                hover:border-white/[0.10] hover:-translate-y-0.5
                transition-all duration-200 p-5 group">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-xl {{ $c['bg'] }} border {{ $c['border'] }}
                        flex items-center justify-center">
                <i class="{{ $stat['icon'] }} {{ $c['icon'] }} text-sm"></i>
            </div>
        </div>
        <p class="text-2xl font-extrabold {{ $c['val'] }} leading-none">
            {{ $stat['value'] }}
        </p>
        <p class="text-xs font-semibold text-slate-300 mt-1.5 leading-none">
            {{ $stat['label'] }}
        </p>
        <p class="text-[10px] text-slate-600 mt-0.5">{{ $stat['sub'] }}</p>
    </div>
    @endforeach
</div>

{{-- ══════════════════════════════════════════════════════
     RECENT ACTIVITY TABLE  (placeholder – isi sesuai data)
══════════════════════════════════════════════════════ --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- Recent Peminjaman --}}
    <div class="xl:col-span-2 rounded-2xl bg-[#1c1d35] border border-white/[0.06] overflow-hidden">
        <div class="flex items-center justify-between px-5 py-4 border-b border-white/[0.06]">
            <div>
                <h3 class="text-sm font-bold text-slate-100">Peminjaman Terbaru</h3>
                <p class="text-[11px] text-slate-500 mt-0.5">Aktivitas peminjaman terakhir</p>
            </div>
            <a href="{{ route('peminjaman.index') }}"
               class="text-xs font-semibold text-indigo-400 hover:text-indigo-300 transition-colors">
                Lihat semua →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/[0.04]">
                        <th class="px-5 py-3 text-left text-[10px] font-bold text-slate-600 uppercase tracking-widest">Peminjam</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold text-slate-600 uppercase tracking-widest">Alat</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold text-slate-600 uppercase tracking-widest">Tanggal</th>
                        <th class="px-5 py-3 text-left text-[10px] font-bold text-slate-600 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @forelse($recentPeminjaman ?? [] as $item)
                    <tr class="hover:bg-white/[0.02] transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600
                                            flex items-center justify-center text-white text-xs font-bold shrink-0">
                                    {{ strtoupper(substr($item->user->nama_lengkap ?? '?', 0, 1)) }}
                                </div>
                                <span class="text-slate-300 font-medium text-xs">
                                    {{ $item->user->nama_lengkap ?? '—' }}
                                </span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-400 text-xs">{{ $item->alat->nama_alat ?? '—' }}</td>
                        <td class="px-5 py-3.5 text-slate-500 text-xs">
                            {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                        </td>
                        <td class="px-5 py-3.5">
                            @php
                                $st = [
                                    'menunggu'   => 'bg-amber-500/15 text-amber-400 border-amber-500/20',
                                    'disetujui'  => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/20',
                                    'ditolak'    => 'bg-rose-500/15 text-rose-400 border-rose-500/20',
                                    'dikembalikan'=> 'bg-sky-500/15 text-sky-400 border-sky-500/20',
                                ][$item->status] ?? 'bg-slate-500/15 text-slate-400 border-slate-500/20';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg border
                                         text-[10px] font-bold uppercase tracking-wider {{ $st }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-slate-600 text-sm">
                            <i class="fas fa-inbox text-2xl mb-2 block opacity-40"></i>
                            Belum ada data peminjaman
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Info Panel --}}
    <div class="space-y-4">

        {{-- Status guide --}}
        <div class="rounded-2xl bg-[#1c1d35] border border-white/[0.06] p-5">
            <h3 class="text-sm font-bold text-slate-100 mb-4">Panduan Status</h3>
            <div class="space-y-3">
                @foreach([
                    ['amber',   'Menunggu',    'Pengajuan sedang direview petugas'],
                    ['emerald', 'Disetujui',   'Peminjaman aktif berjalan'],
                    ['rose',    'Ditolak',     'Permintaan tidak disetujui'],
                    ['sky',     'Dikembalikan','Alat telah dikembalikan'],
                ] as [$col, $lbl, $desc])
                @php $dot = ['amber'=>'bg-amber-400','emerald'=>'bg-emerald-400','rose'=>'bg-rose-400','sky'=>'bg-sky-400'][$col]; @endphp
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full {{ $dot }} shrink-0 mt-1.5"></div>
                    <div>
                        <p class="text-xs font-semibold text-slate-300">{{ $lbl }}</p>
                        <p class="text-[11px] text-slate-600 leading-snug">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Quick Links --}}
        <div class="rounded-2xl bg-[#1c1d35] border border-white/[0.06] p-5">
            <h3 class="text-sm font-bold text-slate-100 mb-4">Akses Cepat</h3>
            <div class="space-y-2">
                @if(Auth::user()->role != 'peminjam')
                <a href="{{ route('peminjaman.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl
                          text-slate-400 hover:text-white hover:bg-white/[0.06]
                          text-sm font-medium transition-all group">
                    <i class="fas fa-handshake w-4 text-center text-slate-600
                              group-hover:text-indigo-400 transition-colors"></i>
                    Data Peminjaman
                </a>
                <a href="{{ route('pengembalian.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl
                          text-slate-400 hover:text-white hover:bg-white/[0.06]
                          text-sm font-medium transition-all group">
                    <i class="fas fa-rotate-left w-4 text-center text-slate-600
                              group-hover:text-indigo-400 transition-colors"></i>
                    Data Pengembalian
                </a>
                @endif
                <a href="{{ route('alat.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl
                          text-slate-400 hover:text-white hover:bg-white/[0.06]
                          text-sm font-medium transition-all group">
                    <i class="fas fa-screwdriver-wrench w-4 text-center text-slate-600
                              group-hover:text-indigo-400 transition-colors"></i>
                    Daftar Alat
                </a>
                @if(Auth::user()->role == 'peminjam')
                <a href="{{ route('peminjaman.ajukan') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl
                          bg-indigo-600/80 hover:bg-indigo-600
                          text-white text-sm font-semibold transition-all">
                    <i class="fas fa-plus w-4 text-center"></i>
                    Ajukan Peminjaman
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
