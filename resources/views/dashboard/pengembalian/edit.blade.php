@extends('layouts.app')
@section('title', 'Edit Pengembalian')
@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('pengembalian.update', $pengembalian->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Peminjaman</label>
            <select name="peminjaman_id" class="w-full p-2 border rounded">
                @foreach($peminjamans as $peminjaman)
                    <option value="{{ $peminjaman->id }}" {{ $pengembalian->peminjaman_id == $peminjaman->id ? 'selected' : '' }}>
                        {{ $peminjaman->peminjam->nama_lengkap }} - {{ $peminjaman->alat->nama_alat }} ({{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="w-full p-2 border rounded" value="{{ $pengembalian->tanggal_kembali }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Denda (Rp)</label>
                <input type="number" name="denda" min="0" step="1000" class="w-full p-2 border rounded" value="{{ $pengembalian->denda ?? 0 }}">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Kondisi Alat</label>
            <select name="kondisi_alat" class="w-full p-2 border rounded">
                <option value="baik" {{ $pengembalian->kondisi_alat == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak ringan" {{ $pengembalian->kondisi_alat == 'rusak ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="rusak berat" {{ $pengembalian->kondisi_alat == 'rusak berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
        </div>

        <div class="flex justify-end mt-4 border-t pt-4">
            <a href="{{ route('pengembalian.index') }}" class="mr-2 px-4 py-2 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition shadow-sm">
                Perbarui Pengembalian
            </button>
        </div>
    </form>
</div>
@endsection