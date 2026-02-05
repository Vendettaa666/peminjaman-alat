@extends('layouts.app')
@section('title', 'Tambah Log Aktivitas Baru')
@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('log_aktivitas.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">User</label>
            <select name="user_id" class="w-full p-2 border rounded @error('user_id') border-red-500 @enderror">
                <option value="">Pilih User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->nama_lengkap }} ({{ ucfirst($user->role) }})
                    </option>
                @endforeach
            </select>
            @error('user_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Aktivitas</label>
            <textarea name="aktivitas" rows="4" class="w-full p-2 border rounded @error('aktivitas') border-red-500 @enderror" placeholder="Deskripsi aktivitas...">{{ old('aktivitas') }}</textarea>
            @error('aktivitas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('log_aktivitas.index') }}" class="mr-2 px-4 py-2 text-gray-600 border rounded hover:bg-gray-100">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Log</button>
        </div>
    </form>
</div>
@endsection