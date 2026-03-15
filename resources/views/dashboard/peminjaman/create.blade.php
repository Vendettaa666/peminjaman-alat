@extends('layouts.app')
@section('title', 'Tambah Peminjaman')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- ── PAGE TITLE ──────────────────────────────────────────── --}}
    <div class="mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-500/20 border border-indigo-500/30
                        flex items-center justify-center">
                <i class="fas fa-handshake text-sm text-indigo-400"></i>
            </div>
            <div>
                <h2 class="text-lg font-extrabold text-slate-100">Tambah Peminjaman Baru</h2>
                <p class="text-xs text-slate-500 mt-0.5">Input data peminjaman secara manual</p>
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

        <form action="{{ route('peminjaman.store') }}" method="POST" class="p-6 space-y-5">
            @csrf

            {{-- Section: Data Utama --}}
            <div>
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-3">
                    Data Utama
                </p>
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
                                       transition-all duration-200 cursor-pointer
                                       @error('user_id') !border-rose-500 @enderror">
                            <option value="">— Pilih peminjam —</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-rose-400 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-circle-exclamation text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
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
                                       transition-all duration-200 cursor-pointer
                                       @error('alat_id') !border-rose-500 @enderror">
                            <option value="">— Pilih alat —</option>
                            @foreach($alats as $alat)
                                <option value="{{ $alat->id }}" {{ old('alat_id') == $alat->id ? 'selected' : '' }}>
                                    {{ $alat->nama_alat }} (Stok: {{ $alat->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('alat_id')
                            <p class="text-rose-400 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-circle-exclamation text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="border-t border-white/[0.04]"></div>

            {{-- Section: Waktu & Kuantitas --}}
            <div>
                <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest mb-3">
                    Waktu & Kuantitas
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- Tgl Pinjam --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Tanggal Pinjam
                        </label>
                        <input type="date" name="tanggal_pinjam"
                               value="{{ old('tanggal_pinjam') }}"
                               class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                      text-sm text-slate-300 font-medium
                                      focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                      transition-all duration-200
                                      @error('tanggal_pinjam') !border-rose-500 @enderror">
                        @error('tanggal_pinjam')
                            <p class="text-rose-400 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-circle-exclamation text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tgl Kembali --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Tanggal Kembali
                        </label>
                        <input type="date" name="tanggal_kembali"
                               value="{{ old('tanggal_kembali') }}"
                               class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                      text-sm text-slate-300 font-medium
                                      focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                      transition-all duration-200
                                      @error('tanggal_kembali') !border-rose-500 @enderror">
                        @error('tanggal_kembali')
                            <p class="text-rose-400 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-circle-exclamation text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Jumlah --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-widest mb-2">
                            Jumlah
                        </label>
                        <input type="number" name="jumlah" min="1"
                               value="{{ old('jumlah') }}"
                               placeholder="Masukkan jumlah unit"
                               class="w-full h-11 bg-[#252740] border border-[#363a5e] rounded-xl px-4
                                      text-sm text-slate-300 font-medium placeholder-slate-600
                                      focus:outline-none focus:border-indigo-500 focus:ring-[3px] focus:ring-indigo-500/20
                                      transition-all duration-200
                                      @error('jumlah') !border-rose-500 @enderror">
                        @error('jumlah')
                            <p class="text-rose-400 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-circle-exclamation text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
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
                                       transition-all duration-200 cursor-pointer
                                       @error('id_petugas') !border-rose-500 @enderror">
                            <option value="">— Pilih petugas —</option>
                            @foreach($petugas as $p)
                                <option value="{{ $p->id }}" {{ old('id_petugas') == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama_lengkap }} ({{ ucfirst($p->role) }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_petugas')
                            <p class="text-rose-400 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fas fa-circle-exclamation text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="border-t border-white/[0.06]"></div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-1">
                <a href="{{ route('peminjaman.index') }}"
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold
                          bg-white/[0.05] hover:bg-white/[0.09] border border-white/[0.07]
                          text-slate-400 hover:text-white transition-all duration-200">
                    Batal
                </a>
                <button type="submit"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold text-white
                               bg-gradient-to-r from-indigo-500 to-violet-600
                               shadow-[0_4px_16px_rgba(99,102,241,0.35)]
                               hover:shadow-[0_6px_24px_rgba(99,102,241,0.5)]
                               hover:-translate-y-px active:translate-y-0 transition-all duration-200">
                    <i class="fas fa-floppy-disk text-xs mr-2"></i>
                    Simpan Peminjaman
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
