@extends('layouts.app')
@section('title', 'Detail Log Aktivitas')
@section('content')
<div class="max-w-md bg-white p-6 rounded-lg shadow-md">
    <div class="text-center mb-4">
        <div class="w-20 h-20 bg-green-200 rounded-full mx-auto mb-2 flex items-center justify-center text-2xl font-bold text-green-600">
            <i class="fas fa-clipboard-list"></i>
        </div>
        <h2 class="text-xl font-bold">Detail Log Aktivitas</h2>
        <p class="text-gray-500">#{{ $logAktivitas->id }}</p>
    </div>
    <div class="border-t pt-4 space-y-2">
        <p><strong>User:</strong> {{ $logAktivitas->user->nama_lengkap }}</p>
        <p><strong>Role:</strong> {{ ucfirst($logAktivitas->user->role) }}</p>
        <p><strong>Aktivitas:</strong></p>
        <div class="bg-gray-50 p-3 rounded text-sm">
            {{ $logAktivitas->aktivitas }}
        </div>
        <p><strong>Waktu:</strong> {{ $logAktivitas->created_at->format('d M Y H:i:s') }}</p>
    </div>
    <div class="flex justify-center space-x-2 mt-6">
        <a href="{{ route('log_aktivitas.edit', $logAktivitas->id) }}" class="text-yellow-600 hover:underline">Edit</a>
        <a href="{{ route('log_aktivitas.index') }}" class="text-blue-600 hover:underline">Kembali</a>
    </div>
</div>
@endsection