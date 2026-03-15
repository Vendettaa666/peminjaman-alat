@extends('layouts.app')
@section('title', 'Edit Peminjaman')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- ── PAGE TITLE ──────────────────────────────────────────── --}}
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-500/20 border border-amber-500/30
                        flex items-center justify-center">
                <i class="fas fa-pen text-sm text-amber-400"></i>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-100">Edit Peminjaman</h2>
                <p class="text-xs text-slate-500 mt-0.5">
                    Perbarui data peminjaman
                    <span class="text-slate-600 font-semibold">#{{ $peminjaman->id }}</span>
                </p>
            </div>
        </div>
    </div>

    {{-- ── FORM CARD ───────────────────────────────────────────── --}}
    <div class="rounded-2xl bg-[#1c1d35] border border-white/[0.06] overflow-hidden">

        {{-- Error box --}}
        @if($errors->any())
        <div class="mx-6 mt-6 bg-rose-500/10 border border-rose-500/25 rounded-xl px-4 py-3">
            <p class="text-[10px] font-bold text-rose-400 uppercase tracking-widest mb-1.5">Terjadi Kesalahan</p>
            @foreach($errors->all() as $error)
                <p class="text-rose-300 text-xs">• {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Section: Data Utama --}}
            <div>
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-3">Data Utama</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Peminjam --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Peminjam
                        </label>
                        <select name="user_id"
                                class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                       text-sm text-slate-300 font-medium appearance-none
                                       focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                       transition-all duration-200 cursor-pointer">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}"
                                        {{ $peminjaman->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Alat --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Alat
                        </label>
                        <select name="alat_id"
                                class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                       text-sm text-slate-300 font-medium appearance-none
                                       focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                       transition-all duration-200 cursor-pointer">
                            @foreach($alats as $alat)
                                <option value="{{ $alat->id }}"
                                        {{ $peminjaman->alat_id == $alat->id ? 'selected' : '' }}>
                                    {{ $alat->nama_alat }} (Stok: {{ $alat->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/[0.04]"></div>

            {{-- Section: Waktu & Detail --}}
            <div>
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-3">Waktu & Detail</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Tgl Pinjam --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Tanggal Pinjam
                        </label>
                        <input type="date" name="tanggal_pinjam"
                               value="{{ $peminjaman->tanggal_pinjam }}"
                               class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                      text-sm text-slate-300 font-medium
                                      focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                      transition-all duration-200">
                    </div>

                    {{-- Tgl Kembali --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Tanggal Kembali
                        </label>
                        <input type="date" name="tanggal_kembali"
                               value="{{ $peminjaman->tanggal_kembali }}"
                               class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                      text-sm text-slate-300 font-medium
                                      focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                      transition-all duration-200">
                    </div>

                    {{-- Jumlah --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Jumlah
                        </label>
                        <input type="number" name="jumlah" min="1"
                               value="{{ $peminjaman->jumlah }}"
                               class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                      text-sm text-slate-300 font-medium placeholder-slate-600
                                      focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                      transition-all duration-200">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Status
                        </label>
                        <select name="status"
                                class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                       text-sm text-slate-300 font-medium appearance-none
                                       focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                       transition-all duration-200 cursor-pointer">
                            @foreach(['menunggu'=>'Menunggu','dipinjam'=>'Dipinjam','disetujui'=>'Disetujui',
                                      'ditolak'=>'Ditolak','dikembalikan'=>'Dikembalikan'] as $val => $label)
                            <option value="{{ $val }}"
                                    {{ $peminjaman->status == $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Petugas --}}
            <div>
                <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                    Petugas
                </label>
                <select name="id_petugas"
                        class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                               text-sm text-slate-300 font-medium appearance-none
                               focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                               transition-all duration-200 cursor-pointer">
                    @foreach($petugas as $p)
                        <option value="{{ $p->id }}"
                                {{ $peminjaman->id_petugas == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_lengkap }} ({{ ucfirst($p->role) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="border-t border-white/[0.06]"></div>

            {{-- Actions --}}
            <div class="flex items-center justify-between gap-3 pt-1">
                <a href="{{ route('peminjaman.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold
                          bg-white/[0.05] hover:bg-white/[0.09] border border-white/[0.07]
                          text-slate-400 hover:text-white transition-all duration-200">
                    <i class="fas fa-arrow-left text-xs"></i>
                    Kembali
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold text-white
                               bg-gradient-to-r from-amber-500 to-orange-500
                               shadow-[0_4px_16px_rgba(245,158,11,0.3)]
                               hover:shadow-[0_6px_24px_rgba(245,158,11,0.45)]
                               hover:-translate-y-px active:translate-y-0 transition-all duration-200">
                    <i class="fas fa-pen text-xs mr-2"></i>
                    Perbarui Peminjaman
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
