@extends('layouts.app')
@section('title', 'Detail User')
@section('content')
<div class="max-w-md bg-white p-6 rounded-lg shadow-md">
    <div class="text-center mb-4">
        <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-2 flex items-center justify-center text-2xl font-bold text-gray-500">
            {{ strtoupper(substr($user->nama_lengkap, 0, 1)) }}
        </div>
        <h2 class="text-xl font-bold">{{ $user->nama_lengkap }}</h2>
        <p class="text-gray-500">@ {{ $user->username }}</p>
    </div>
    <div class="border-t pt-4">
        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
        <p><strong>Bergabung sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
    </div>
    <a href="{{ route('user.index') }}" class="block text-center mt-6 text-blue-600">Kembali</a>
</div>
@endsection