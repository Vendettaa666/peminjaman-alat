@extends('layouts.app')
@section('title', auth()->user()->role == 'peminjam' ? 'Peminjaman Saya' : 'Manajemen Peminjaman')

@section('content')

{{-- ── HEADER ROW ────────────────────────────────────────────── --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-lg font-extrabold text-slate-100">
            @if(auth()->user()->role == 'peminjam') Peminjaman Saya @else Daftar Peminjaman @endif
        </h2>
        <p class="text-xs text-slate-500 mt-0.5">
            Total {{ $peminjamans->count() }} data peminjaman
        </p>
    </div>

    @if(auth()->user()->role == 'peminjam')
        <a href="{{ route('peminjaman.ajukan') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-sm text-white
                  bg-gradient-to-r from-indigo-500 to-violet-600
                  shadow-[0_4px_16px_rgba(99,102,241,0.35)]
                  hover:shadow-[0_6px_24px_rgba(99,102,241,0.5)]
                  hover:-translate-y-px active:translate-y-0 transition-all duration-200">
            <i class="fas fa-plus text-xs"></i>
            Ajukan Peminjaman
        </a>
    @else
        <a href="{{ route('peminjaman.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl font-bold text-sm text-white
                  bg-gradient-to-r from-indigo-500 to-violet-600
                  shadow-[0_4px_16px_rgba(99,102,241,0.35)]
                  hover:shadow-[0_6px_24px_rgba(99,102,241,0.5)]
                  hover:-translate-y-px active:translate-y-0 transition-all duration-200">
            <i class="fas fa-plus text-xs"></i>
            Tambah Peminjaman
        </a>
    @endif
</div>

{{-- ── TABLE CARD ────────────────────────────────────────────── --}}
<div class="rounded-2xl bg-[#1c1d35] border border-white/[0.06] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/[0.06]">
                    @foreach(['Peminjam','Alat','Tgl Pinjam','Tgl Kembali','Jumlah','Status','Aksi'] as $h)
                    <th class="px-5 py-3.5 text-left text-[10px] font-bold text-slate-600 uppercase tracking-widest
                               @if($h=='Aksi') text-center @endif">
                        {{ $h }}
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-white/[0.03]">
                @forelse($peminjamans as $p)
                @php
                    $statusClass = match($p->status) {
                        'menunggu'    => 'bg-amber-500/15 text-amber-400 border-amber-500/20',
                        'disetujui'   => 'bg-emerald-500/15 text-emerald-400 border-emerald-500/20',
                        'ditolak'     => 'bg-rose-500/15 text-rose-400 border-rose-500/20',
                        'dikembalikan'=> 'bg-sky-500/15 text-sky-400 border-sky-500/20',
                        'dipinjam'    => 'bg-indigo-500/15 text-indigo-400 border-indigo-500/20',
                        default       => 'bg-slate-500/15 text-slate-400 border-slate-500/20',
                    };
                @endphp
                <tr class="hover:bg-white/[0.02] transition-colors group">
                    {{-- Peminjam --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600
                                        flex items-center justify-center text-white text-xs font-bold shrink-0">
                                {{ strtoupper(substr($p->peminjam->nama_lengkap ?? '?', 0, 1)) }}
                            </div>
                            <span class="text-slate-300 font-medium text-xs leading-tight">
                                {{ $p->peminjam->nama_lengkap ?? '—' }}
                            </span>
                        </div>
                    </td>
                    {{-- Alat --}}
                    <td class="px-5 py-4">
                        <span class="text-slate-300 text-xs font-medium">{{ $p->alat->nama_alat ?? '—' }}</span>
                    </td>
                    {{-- Tanggal Pinjam --}}
                    <td class="px-5 py-4 text-slate-500 text-xs">
                        {{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}
                    </td>
                    {{-- Tanggal Kembali --}}
                    <td class="px-5 py-4 text-slate-500 text-xs">
                        {{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}
                    </td>
                    {{-- Jumlah --}}
                    <td class="px-5 py-4">
                        <span class="text-slate-300 text-xs font-semibold">{{ $p->jumlah }}</span>
                    </td>
                    {{-- Status --}}
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg border
                                     text-[10px] font-bold uppercase tracking-wider {{ $statusClass }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    {{-- Aksi --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-center gap-1.5">
                            {{-- Detail --}}
                            <a href="{{ route('peminjaman.show', $p->id) }}"
                               title="Detail"
                               class="w-8 h-8 flex items-center justify-center rounded-lg
                                      bg-sky-500/10 hover:bg-sky-500/25 border border-sky-500/20
                                      text-sky-400 hover:text-sky-300 transition-all">
                                <i class="fas fa-eye text-xs"></i>
                            </a>

                            @if(auth()->user()->role == 'peminjam')
                                @if($p->status == 'dipinjam' || $p->status == 'menunggu')
                                    <a href="{{ route('peminjaman.edit', $p->id) }}"
                                       title="Edit"
                                       class="w-8 h-8 flex items-center justify-center rounded-lg
                                              bg-amber-500/10 hover:bg-amber-500/25 border border-amber-500/20
                                              text-amber-400 hover:text-amber-300 transition-all">
                                        <i class="fas fa-pen text-xs"></i>
                                    </a>
                                    <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus peminjaman ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" title="Hapus"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg
                                                       bg-rose-500/10 hover:bg-rose-500/25 border border-rose-500/20
                                                       text-rose-400 hover:text-rose-300 transition-all">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                @endif
                            @else
                                @if($p->status == 'dipinjam' || $p->status == 'menunggu')
                                    <form action="{{ route('peminjaman.reject', $p->id) }}" method="POST"
                                          onsubmit="return confirm('Batalkan peminjaman ini?')">
                                        @csrf
                                        <button type="submit" title="Batalkan"
                                                class="w-8 h-8 flex items-center justify-center rounded-lg
                                                       bg-rose-500/10 hover:bg-rose-500/25 border border-rose-500/20
                                                       text-rose-400 hover:text-rose-300 transition-all">
                                            <i class="fas fa-ban text-xs"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('peminjaman.edit', $p->id) }}"
                                   title="Edit"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg
                                          bg-amber-500/10 hover:bg-amber-500/25 border border-amber-500/20
                                          text-amber-400 hover:text-amber-300 transition-all">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                                <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus peminjaman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Hapus"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg
                                                   bg-rose-500/10 hover:bg-rose-500/25 border border-rose-500/20
                                                   text-rose-400 hover:text-rose-300 transition-all">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 border border-indigo-500/20
                                        flex items-center justify-center">
                                <i class="fas fa-inbox text-xl text-indigo-400/50"></i>
                            </div>
                            <p class="text-slate-500 text-sm font-medium">Belum ada data peminjaman</p>
                            @if(auth()->user()->role == 'peminjam')
                            <a href="{{ route('peminjaman.ajukan') }}"
                               class="text-xs text-indigo-400 hover:text-indigo-300 font-semibold transition-colors">
                                + Ajukan peminjaman pertama Anda
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination (hanya tampil jika controller menggunakan paginate()) --}}
    @if($peminjamans instanceof \Illuminate\Pagination\AbstractPaginator && $peminjamans->hasPages())
    <div class="px-5 py-4 border-t border-white/[0.06]">
        {{ $peminjamans->links() }}
    </div>
    @endif
</div>

@endsection
