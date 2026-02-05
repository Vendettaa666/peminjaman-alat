@extends('layouts.app')
@section('title', 'Manajemen Pengembalian')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between mb-4">
        <h3 class="text-lg font-bold">Daftar Pengembalian</h3>
        <a href="{{ route('pengembalian.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Pengembalian</a>
    </div>
    <table class="w-full text-left">
        <thead>
            <tr class="bg-gray-50 border-b">
                <th class="p-3">Peminjam</th>
                <th class="p-3">Alat</th>
                <th class="p-3">Tanggal Kembali</th>
                <th class="p-3">Kondisi</th>
                {{-- <th class="p-3">Denda</th> --}}
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengembalians as $p)
            <tr class="border-b">
                <td class="p-3">{{ $p->peminjaman->peminjam->nama_lengkap }}</td>
                <td class="p-3">{{ $p->peminjaman->alat->nama_alat }}</td>
                <td class="p-3">{{ \Carbon\Carbon::parse($p->tanggal_kembali)->format('d M Y') }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded text-xs {{ $p->kondisi_alat == 'baik' ? 'bg-green-100 text-green-700' : ($p->kondisi_alat == 'rusak ringan' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                        {{ ucfirst($p->kondisi_alat) }}
                    </span>
                </td>
                {{-- <td class="p-3">Rp {{ number_format($p->denda ?? 0, 0, ',', '.') }}</td> --}}
                <td class="p-3 flex justify-center space-x-2">
                    <a href="{{ route('pengembalian.show', $p->id) }}" class="text-blue-600">Detail</a>
                    <a href="{{ route('pengembalian.edit', $p->id) }}" class="text-yellow-600">Edit</a>
                    <form action="{{ route('pengembalian.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pengembalian?')">
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