@extends('layouts.app')

@section('title', 'Detail Alat')

@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-6 border-b pb-4">
        <div>
            <span class="text-blue-600 font-semibold uppercase tracking-wide text-xs">{{ $alat->kategori->nama_kategori }}</span>
            <h3 class="text-3xl font-bold text-gray-800">{{ $alat->nama_alat }}</h3>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Stok Tersedia</p>
            <p class="text-2xl font-bold {{ $alat->stok > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $alat->stok }} Unit</p>
        </div>
    </div>

    <div class="mb-6">
        <h4 class="font-bold text-gray-700 mb-2">Deskripsi:</h4>
        <p class="text-gray-600 leading-relaxed">{{ $alat->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
    </div>

    <div class="flex justify-between items-center pt-4 border-t">
        <a href="{{ route('alat.index') }}" class="text-blue-600 hover:underline">← Kembali</a>
        <span class="text-xs text-gray-400">Terakhir diperbarui: {{ $alat->updated_at->diffForHumans() }}</span>
    </div>
</div>
@endsection