@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="max-w-md bg-white p-6 rounded-lg shadow-md">
    <div class="mb-4 border-b pb-2">
        <span class="text-gray-500 text-sm">ID Kategori: #{{ $kategori->id }}</span>
        <h3 class="text-2xl font-bold text-gray-800">{{ $kategori->nama_kategori }}</h3>
    </div>
    <div class="flex justify-between items-center">
        <a href="{{ route('kategori.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar</a>
        <div class="text-xs text-gray-400 italic">Dibuat pada: {{ $kategori->created_at->format('d M Y') }}</div>
    </div>
</div>
@endsection