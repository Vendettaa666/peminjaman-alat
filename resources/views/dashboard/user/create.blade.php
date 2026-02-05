@extends('layouts.app')
@section('title', 'Tambah User Baru')
@section('content')
<div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="w-full p-2 border rounded @error('nama_lengkap') border-red-500 @enderror" value="{{ old('nama_lengkap') }}">
                @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded @error('username') border-red-500 @enderror" value="{{ old('username') }}">
                @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded @error('email') border-red-500 @enderror" value="{{ old('email') }}">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded @error('password') border-red-500 @enderror">
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Role</label>
                <select name="role" class="w-full p-2 border rounded @error('role') border-red-500 @enderror">
                    <option value="peminjam" {{ old('role') == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                    <option value="petugas" {{ old('role') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('user.index') }}" class="mr-2 px-4 py-2 text-gray-600 border rounded hover:bg-gray-100">Batal</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan User</button>
        </div>
    </form>
</div>
@endsection