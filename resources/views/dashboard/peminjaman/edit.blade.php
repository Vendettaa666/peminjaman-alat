@extends('layouts.app')
@section('title', 'Edit Peminjaman')
@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Peminjam</label>
                <select name="user_id" class="w-full p-2 border rounded">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $peminjaman->user_id == $user->id ? 'selected' : '' }}>
                            {{ $user->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Alat</label>
                <select name="alat_id" class="w-full p-2 border rounded">
                    @foreach($alats as $alat)
                        <option value="{{ $alat->id }}" {{ $peminjaman->alat_id == $alat->id ? 'selected' : '' }}>
                            {{ $alat->nama_alat }} (Stok: {{ $alat->stok }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="w-full p-2 border rounded" value="{{ $peminjaman->tanggal_pinjam }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" class="w-full p-2 border rounded" value="{{ $peminjaman->tanggal_kembali }}">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Jumlah</label>
                <input type="number" name="jumlah" min="1" class="w-full p-2 border rounded" value="{{ $peminjaman->jumlah }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" class="w-full p-2 border rounded">
                    <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Petugas</label>
            <select name="id_petugas" class="w-full p-2 border rounded">
                @foreach($petugas as $p)
                    <option value="{{ $p->id }}" {{ $peminjaman->id_petugas == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_lengkap }} ({{ ucfirst($p->role) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end mt-4 border-t pt-4">
            <a href="{{ route('peminjaman.index') }}" class="mr-2 px-4 py-2 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition shadow-sm">
                Perbarui Peminjaman
            </button>
        </div>
    </form>
</div>
@endsection