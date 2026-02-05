@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('content')
<div class="max-w-md bg-white p-6 rounded-lg shadow-md">
    <div class="text-center mb-4">
        <div class="w-20 h-20 bg-blue-200 rounded-full mx-auto mb-2 flex items-center justify-center text-2xl font-bold text-blue-600">
            <i class="fas fa-handshake"></i>
        </div>
        <h2 class="text-xl font-bold">Detail Peminjaman</h2>
        <p class="text-gray-500">#{{ $peminjaman->id }}</p>
    </div>
    <div class="border-t pt-4 space-y-2">
        <p><strong>Peminjam:</strong> {{ $peminjaman->peminjam->nama_lengkap }}</p>
        <p><strong>Alat:</strong> {{ $peminjaman->alat->nama_alat }}</p>
        <p><strong>Jumlah:</strong> {{ $peminjaman->jumlah }}</p>
        <p><strong>Tanggal Pinjam:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d M Y') }}</p>
        <p><strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}</p>
        <p><strong>Status:</strong> 
            <span class="px-2 py-1 rounded text-xs {{ $peminjaman->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                {{ ucfirst($peminjaman->status) }}
            </span>
        </p>
        <p><strong>Petugas:</strong> {{ $peminjaman->petugas->nama_lengkap }}</p>
        <p><strong>Dibuat:</strong> {{ $peminjaman->created_at->format('d M Y H:i') }}</p>
    </div>
    <div class="flex justify-center space-x-2 mt-6">
        <a href="{{ route('peminjaman.edit', $peminjaman->id) }}" class="text-yellow-600 hover:underline">Edit</a>
        <a href="{{ route('peminjaman.index') }}" class="text-blue-600 hover:underline">Kembali</a>
    </div>
</div>
@endsection