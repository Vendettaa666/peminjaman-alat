@extends('layouts.app')
@section('title', 'Detail Peminjaman')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- ── CARD ─────────────────────────────────────────────── --}}
    <div class="rounded-2xl bg-[#1c1d35] border border-white/[0.06] overflow-hidden">

        {{-- Header --}}
        <div class="relative overflow-hidden px-6 py-6
                    bg-gradient-to-br from-indigo-600/40 via-violet-700/30 to-transparent
                    border-b border-white/[0.06]">
            {{-- Decorative blob --}}
            <div class="pointer-events-none absolute -top-8 -right-8 w-40 h-40 rounded-full
                        bg-violet-500/20 blur-3xl"></div>

            <div class="relative z-10 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-indigo-500/20 border border-indigo-500/30
                            flex items-center justify-center shrink-0">
                    <i class="fas fa-handshake text-xl text-indigo-400"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-0.5">
                        Peminjaman #{{ $peminjaman->id }}
                    </p>
                    <h2 class="text-xl font-extrabold text-slate-100">Detail Peminjaman</h2>
                    <div class="mt-1.5">
                        @php
                            $sc = match($peminjaman->status) {
                                'menunggu'    => 'bg-amber-500/15 text-amber-400 border-amber-500/20',
                                'disetujui'   => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/20',
                                'ditolak'     => 'bg-rose-500/15 text-rose-400 border-rose-500/20',
                                'dikembalikan'=> 'bg-sky-500/15 text-sky-400 border-sky-500/20',
                                'dipinjam'    => 'bg-indigo-500/15 text-indigo-400 border-indigo-500/20',
                                default       => 'bg-slate-500/15 text-slate-400 border-slate-500/20',
                            };
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg border
                                     text-[10px] font-bold uppercase tracking-wider {{ $sc }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-6 space-y-1">

            @php
            $rows = [
                ['fas fa-user',          'indigo',  'Peminjam',       $peminjaman->peminjam->nama_lengkap ?? '—'],
                ['fas fa-screwdriver-wrench','violet','Alat yang Dipinjam', $peminjaman->alat->nama_alat ?? '—'],
                ['fas fa-layer-group',   'sky',     'Jumlah',         $peminjaman->jumlah . ' unit'],
                ['fas fa-calendar-day',  'amber',   'Tanggal Pinjam', \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->isoFormat('D MMMM YYYY')],
                ['fas fa-calendar-check','emerald', 'Tanggal Kembali',\Carbon\Carbon::parse($peminjaman->tanggal_kembali)->isoFormat('D MMMM YYYY')],
                ['fas fa-user-tie',      'rose',    'Petugas',        $peminjaman->petugas->nama_lengkap ?? '—'],
                ['fas fa-clock',         'slate',   'Dibuat Pada',    $peminjaman->created_at->isoFormat('D MMM YYYY, HH:mm')],
            ];
            $dotMap = [
                'indigo'=>'bg-indigo-400','violet'=>'bg-violet-400','sky'=>'bg-sky-400',
                'amber'=>'bg-amber-400','emerald'=>'bg-emerald-400','rose'=>'bg-rose-400','slate'=>'bg-slate-500'
            ];
            $iconMap = [
                'indigo'=>'text-indigo-400','violet'=>'text-violet-400','sky'=>'text-sky-400',
                'amber'=>'text-amber-400','emerald'=>'text-emerald-400','rose'=>'text-rose-400','slate'=>'text-slate-500'
            ];
            @endphp

            @foreach($rows as [$icon, $color, $label, $value])
            <div class="flex items-center gap-4 px-4 py-3.5 rounded-xl hover:bg-white/[0.03] transition-colors">
                <div class="w-8 h-8 rounded-lg bg-white/[0.05] flex items-center justify-center shrink-0">
                    <i class="{{ $icon }} text-xs {{ $iconMap[$color] }}"></i>
                </div>
                <div class="flex-1 flex items-center justify-between gap-4 min-w-0">
                    <span class="text-xs font-semibold text-slate-500 shrink-0">{{ $label }}</span>
                    <span class="text-sm font-semibold text-slate-200 text-right truncate">{{ $value }}</span>
                </div>
            </div>
            @endforeach

        </div>

        {{-- Footer actions --}}
        <div class="px-6 py-4 border-t border-white/[0.06] flex items-center justify-between gap-3">
            <a href="{{ route('peminjaman.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold
                      bg-white/[0.05] hover:bg-white/[0.09] border border-white/[0.07]
                      text-slate-300 hover:text-white transition-all duration-200">
                <i class="fas fa-arrow-left text-xs"></i>
                Kembali
            </a>

            <div class="flex items-center gap-2">
                @if(auth()->user()->role != 'peminjam' || in_array($peminjaman->status, ['dipinjam','menunggu']))
                <a href="{{ route('peminjaman.edit', $peminjaman->id) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold
                          bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/20
                          text-amber-400 hover:text-amber-300 transition-all duration-200">
                    <i class="fas fa-pen text-xs"></i>
                    Edit
                </a>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
