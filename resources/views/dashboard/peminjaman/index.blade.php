@extends('layouts.app')
@section('title', 'Manajemen Peminjaman')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between mb-4">
        <h3 class="text-lg font-bold">Daftar Peminjaman</h3>
        <a href="{{ route('peminjaman.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Peminjaman</a>
    </div>
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-3">Peminjam</th>
                <th class="p-3">Alat</th>
                <th class="p-3">Tanggal Pinjam</th>
                <th class="p-3">Tanggal Kembali</th>
                <th class="p-3">Jumlah</th>
                <th class="p-3">Status</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $p)
            <tr class="border-b">
                <td class="p-3">{{ $p->peminjam->nama_lengkap }}</td>
                <td class="p-3">{{ $p->alat->nama_alat }}</td>
                <td class="p-3">{{ \Carbon\Carbon::parse($p->tanggal_pinjam)->format('d M Y') }}</td>
                <td class="p-3">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}</td>
                <td class="p-3">{{ $p->jumlah }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded text-xs {{ $p->status == 'dipinjam' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td class="p-3 flex justify-center space-x-2">
                    <a href="{{ route('peminjaman.show', $p->id) }}" class="text-blue-600">Detail</a>
                    <a href="{{ route('peminjaman.edit', $p->id) }}" class="text-yellow-600">Edit</a>
                    <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus peminjaman?')">
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