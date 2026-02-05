@extends('layouts.app')
@section('title', 'Tambah Peminjaman Baru')
@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Peminjam</label>
                <select name="user_id" class="w-full p-2 border rounded @error('user_id') border-red-500 @enderror">
                    <option value="">Pilih Peminjam</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
                @error('user_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Alat</label>
                <select name="alat_id" class="w-full p-2 border rounded @error('alat_id') border-red-500 @enderror">
                    <option value="">Pilih Alat</option>
                    @foreach($alats as $alat)
                        <option value="{{ $alat->id }}" {{ old('alat_id') == $alat->id ? 'selected' : '' }}>
                            {{ $alat->nama_alat }} (Stok: {{ $alat->stok }})
                        </option>
                    @endforeach
                </select>
                @error('alat_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="w-full p-2 border rounded @error('tanggal_pinjam') border-red-500 @enderror" value="{{ old('tanggal_pinjam') }}">
                @error('tanggal_pinjam') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="w-full p-2 border rounded @error('tanggal_kembali') border-red-500 @enderror" value="{{ old('tanggal_kembali') }}">
                @error('tanggal_kembali') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jumlah</label>
                <input type="number" name="jumlah" min="1" class="w-full p-2 border rounded @error('jumlah') border-red-500 @enderror" value="{{ old('jumlah') }}">
                @error('jumlah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Petugas</label>
                <select name="id_petugas" class="w-full p-2 border rounded @error('id_petugas') border-red-500 @enderror">
                    <option value="">Pilih Petugas</option>
                    @foreach($petugas as $p)
                        <option value="{{ $p->id }}" {{ old('id_petugas') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_lengkap }} ({{ ucfirst($p->role) }})
                        </option>
                    @endforeach
                </select>
                @error('id_petugas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('peminjaman.index') }}" class="mr-2 px-4 py-2 text-gray-600 border rounded hover:bg-gray-100">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Peminjaman</button>
        </div>
    </form>
</div>
@endsection