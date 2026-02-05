@extends('layouts.app')
@section('title', 'Edit Log Aktivitas')
@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('log_aktivitas.update', $logAktivitas->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">User</label>
            <select name="user_id" class="w-full p-2 border rounded">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $logAktivitas->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->nama_lengkap }} ({{ ucfirst($user->role) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Aktivitas</label>
            <textarea name="aktivitas" rows="4" class="w-full p-2 border rounded" placeholder="Deskripsi aktivitas...">{{ old('aktivitas', $logAktivitas->aktivitas) }}</textarea>
        </div>

        <div class="flex justify-end mt-4 border-t pt-4">
            <a href="{{ route('log_aktivitas.index') }}" class="mr-2 px-4 py-2 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition shadow-sm">
                Perbarui Log
            </button>
        </div>
    </form>
</div>
@endsection