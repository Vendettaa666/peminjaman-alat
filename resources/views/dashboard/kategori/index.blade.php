@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold">Data Kategori</h3>
        <a href="{{ route('kategori.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b bg-gray-50">
                <th class="p-3">No</th>
                <th class="p-3">Nama Kategori</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategori as $key => $item)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $kategori->firstItem() + $key }}</td>
                <td class="p-3">{{ $item->nama_kategori }}</td>
                <td class="p-3 flex justify-center space-x-2">
                    <a href="{{ route('kategori.show', $item->id) }}" class="text-blue-500 hover:underline">Detail</a>
                    <a href="{{ route('kategori.edit', $item->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $kategori->links() }}
    </div>
</div>
@endsection