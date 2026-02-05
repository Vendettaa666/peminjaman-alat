@extends('layouts.app')
@section('title', 'Manajemen Log Aktivitas')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between mb-4">
        <h3 class="text-lg font-bold">Daftar Log Aktivitas</h3>
        <a href="{{ route('log_aktivitas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Log</a>
    </div>
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-3">User</th>
                <th class="p-3">Aktivitas</th>
                <th class="p-3">Waktu</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logAktivitas as $log)
            <tr class="border-b">
                <td class="p-3">{{ $log->user->nama_lengkap }}</td>
                <td class="p-3">{{ $log->aktivitas }}</td>
                <td class="p-3">{{ $log->created_at->format('d M Y H:i') }}</td>
                <td class="p-3 flex justify-center space-x-2">
                    <a href="{{ route('log_aktivitas.show', $log->id) }}" class="text-blue-600">Detail</a>
                    <a href="{{ route('log_aktivitas.edit', $log->id) }}" class="text-yellow-600">Edit</a>
                    <form action="{{ route('log_aktivitas.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus log aktivitas?')">
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