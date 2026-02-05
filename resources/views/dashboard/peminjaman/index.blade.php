@extends('layouts.app')
@section('title', 'Manajemen Peminjaman')
@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between mb-4">
        <h3 class="text-lg font-bold">
            @if(auth()->user()->role == 'peminjam')
                Daftar Peminjaman Saya
            @else
                Daftar Peminjaman
            @endif
        </h3>
        @if(auth()->user()->role == 'peminjam')
            <a href="{{ route('peminjaman.ajukan') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Ajukan Peminjaman</a>
        @else
            <a href="{{ route('peminjaman.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Peminjaman</a>
        @endif
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
                    <span class="px-2 py-1 rounded text-xs 
                        {{ $p->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                           ($p->status == 'dipinjam' ? 'bg-blue-100 text-blue-700' : 
                           ($p->status == 'dikembalikan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700')) }}">
                        {{ ucfirst($p->status) }}
                    </span>
                </td>
                <td class="p-3 flex justify-center space-x-2">
                    <a href="{{ route('peminjaman.show', $p->id) }}" class="text-blue-600">Detail</a>
                    
                    @if(auth()->user()->role == 'peminjam')
                        @if($p->status == 'pending')
                            <a href="{{ route('peminjaman.edit', $p->id) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus pengajuan?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        @endif
                    @else
                        @if($p->status == 'pending')
                            <form action="{{ route('peminjaman.approve', $p->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button class="text-green-600" onclick="return confirm('Setujui peminjaman?')">Setujui</button>
                            </form>
                            <form action="{{ route('peminjaman.reject', $p->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button class="text-red-600" onclick="return confirm('Tolak peminjaman?')">Tolak</button>
                            </form>
                        @else
                            <a href="{{ route('peminjaman.edit', $p->id) }}" class="text-yellow-600">Edit</a>
                            <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus peminjaman?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        @endif
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection