@extends('layouts.app')
@section('title', 'Tambah Pengembalian Baru')
@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('pengembalian.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Peminjaman</label>
            <select name="peminjaman_id" class="w-full p-2 border rounded @error('peminjaman_id') border-red-500 @enderror">
                <option value="">Pilih Peminjaman</option>
                @foreach($peminjamans as $peminjaman)
                    <option value="{{ $peminjaman->id }}" {{ old('peminjaman_id') == $peminjaman->id ? 'selected' : '' }}>
                        {{ $peminjaman->peminjam->nama_lengkap }} - {{ $peminjaman->alat->nama_alat }} ({{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }})
                    </option>
                @endforeach
            </select>
            @error('peminjaman_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="w-full p-2 border rounded @error('tanggal_kembali') border-red-500 @enderror" value="{{ old('tanggal_kembali') }}">
                @error('tanggal_kembali') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Denda (Rp)</label>
                <input type="number" name="denda" min="0" step="1000" class="w-full p-2 border rounded @error('denda') border-red-500 @enderror" value="{{ old('denda', 0) }}">
                @error('denda') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Kondisi Alat</label>
            <select name="kondisi_alat" class="w-full p-2 border rounded @error('kondisi_alat') border-red-500 @enderror">
                <option value="">Pilih Kondisi</option>
                <option value="baik" {{ old('kondisi_alat') == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak ringan" {{ old('kondisi_alat') == 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="rusak berat" {{ old('kondisi_alat') == 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
            @error('kondisi_alat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('pengembalian.index') }}" class="mr-2 px-4 py-2 text-gray-600 border rounded hover:bg-gray-100">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Pengembalian</button>
        </div>
    </form>
</div>
@endsection