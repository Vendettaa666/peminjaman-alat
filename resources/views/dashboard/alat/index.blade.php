@extends('layouts.app')

@section('title', 'Daftar Alat')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold">Data Persediaan Alat</h3>
        @if(Auth::user()->role == 'admin')
            <a href="{{ route('alat.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                + Tambah Alat
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3">No</th>
                    <th class="p-3">Nama Alat</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Stok</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alat as $key => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $alat->firstItem() + $key }}</td>
                    <td class="p-3 font-semibold">{{ $item->nama_alat }}</td>
                    <td class="p-3">
                        <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                            {{ $item->kategori->nama_kategori }}
                        </span>
                    </td>
                    <td class="p-3">
                        <span class="font-semibold {{ $item->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $item->stok }} unit
                        </span>
                    </td>
                    <td class="p-3 flex justify-center space-x-2">
                        <a href="{{ route('alat.show', $item->id) }}" class="text-blue-500 hover:underline">Detail</a>
                        
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('alat.edit', $item->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                            <form action="{{ route('alat.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus alat ini?')" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        @elseif(Auth::user()->role == 'peminjam' && $item->stok > 0)
                            <a href="{{ route('peminjaman.ajukan') }}?alat_id={{ $item->id }}" class="text-green-500 hover:underline">Pinjam</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $alat->links() }}
    </div>
</div>
@endsection