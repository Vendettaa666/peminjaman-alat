@extends('layouts.app')
@section('title', 'Edit Profil User')
@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="w-full p-2 border rounded" value="{{ old('nama_lengkap', $user->nama_lengkap) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded" value="{{ old('username', $user->username) }}">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded @error('email') border-red-500 @enderror" value="{{ old('email', $user->email) }}">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                    Password 
                    <span class="text-xs font-normal text-gray-500 italic">(Kosongkan jika tidak diubah)</span>
                </label>
                <input type="password" name="password" class="w-full p-2 border rounded border-yellow-300 focus:border-yellow-500" placeholder="••••••••">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Role</label>
                <select name="role" class="w-full p-2 border rounded">
                    <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
        </div>

        <div class="flex justify-end mt-4 border-t pt-4">
            <a href="{{ route('user.index') }}" class="mr-2 px-4 py-2 text-gray-600 hover:underline">Batal</a>
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 transition shadow-sm">
                Perbarui Data User
            </button>
        </div>
    </form>
</div>
@endsection