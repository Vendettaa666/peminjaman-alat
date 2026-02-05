@extends('layouts.app')

@section('title', 'Tambah Alat Baru')

@section('content')
    <div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
        @if ( $errors->any() )
            <div>
                <h1>Eror</h1>
                @foreach ( $errors->all() as $error )
                    <p>{{ $error }}</p>
                @endforeach
            </div>

            @endif
        <form action="{{ route('alat.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Alat</label>
                    <input type="text" name="nama_alat"
                        class="w-full p-2 border rounded @error('nama_alat') border-red-500 @enderror"
                        value="{{ old('nama_alat') }}">
                    @error('nama_alat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                    <select name="kategori_id"
                        class="w-full p-2 border rounded @error('kategori_id') border-red-500 @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Stok Awal</label>
                <input type="number" name="stok"
                    class="w-full p-2 border rounded @error('stok') border-red-500 @enderror" value="{{ old('stok', 0) }}">
                @error('stok')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi Alat</label>
                <textarea name="deskripsi" rows="3" class="w-full p-2 border rounded">{{ old('deskripsi') }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('alat.index') }}" class="mr-2 px-4 py-2 text-gray-600">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan
                    Data</button>
            </div>
        </form>
    </div>
@endsection
