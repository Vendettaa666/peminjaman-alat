@extends('layouts.app')
@section('title', 'Manajemen User')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between mb-4">
        <h3 class="text-lg font-bold">Daftar Pengguna</h3>
        <a href="{{ route('user.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah User</a>
    </div>
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-3">Nama Lengkap</th>
                <th class="p-3">Username</th>
                <th class="p-3">Role</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr class="border-b">
                <td class="p-3">{{ $u->nama_lengkap }}</td>
                <td class="p-3">{{ $u->username }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded text-xs {{ $u->role == 'admin' ? 'bg-red-100 text-red-700' : ($u->role == 'petugas' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700') }}">
                        {{ ucfirst($u->role) }}
                    </span>
                </td>
                <td class="p-3 flex justify-center space-x-2">
                    <a href="{{ route('user.edit', $u->id) }}" class="text-yellow-600">Edit</a>
                    <form action="{{ route('user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus user?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection