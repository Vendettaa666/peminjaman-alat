@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-md bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="w-full p-2 border rounded @error('nama_kategori') border-red-500 @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}">
            @error('nama_kategori')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex justify-end">
            <a href="{{ route('kategori.index') }}" class="mr-2 px-4 py-2 text-gray-600">Batal</a>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Perbarui</button>
        </div>
    </form>
</div>
@endsection