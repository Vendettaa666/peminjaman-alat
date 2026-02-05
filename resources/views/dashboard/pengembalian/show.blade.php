@extends('layouts.app')
@section('title', 'Detail Pengembalian')
@section('content')
<div class="max-w-md bg-white p-6 rounded-lg shadow-md">
    <div class="text-center mb-4">
        <div class="w-20 h-20 bg-purple-200 rounded-full mx-auto mb-2 flex items-center justify-center text-2xl font-bold text-purple-600">
            <i class="fas fa-undo"></i>
        </div>
        <h2 class="text-xl font-bold">Detail Pengembalian</h2>
        <p class="text-gray-500">#{{ $pengembalian->id }}</p>
    </div>
    <div class="border-t pt-4 space-y-2">
        <p><strong>Peminjam:</strong> {{ $pengembalian->peminjaman->peminjam->nama_lengkap }}</p>
        <p><strong>Alat:</strong> {{ $pengembalian->peminjaman->alat->nama_alat }}</p>
        <p><strong>Jumlah:</strong> {{ $pengembalian->peminjaman->jumlah }}</p>
        <p><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($pengembalian->peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
        <p><strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('d M Y') }}</p>
        <p><strong>Kondisi Alat:</strong> 
            <span class="px-2 py-1 rounded text-xs {{ $pengembalian->kondisi_alat == 'baik' ? 'bg-green-100 text-green-700' : ($pengembalian->kondisi_alat == 'rusak ringan' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                {{ ucfirst($pengembalian->kondisi_alat) }}
            </span>
        </p>
        <p><strong>Denda:</strong> Rp {{ number_format($pengembalian->denda ?? 0, 0, ',', '.') }}</p>
        <p><strong>Petugas:</strong> {{ $pengembalian->peminjaman->petugas->nama_lengkap }}</p>
        <p><strong>Dibuat:</strong> {{ $pengembalian->created_at->format('d M Y H:i') }}</p>
    </div>
    <div class="flex justify-center space-x-2 mt-6">
        <a href="{{ route('pengembalian.edit', $pengembalian->id) }}" class="text-yellow-600 hover:underline">Edit</a>
        <a href="{{ route('pengembalian.index') }}" class="text-blue-600 hover:underline">Kembali</a>
    </div>
</div>
@endsection