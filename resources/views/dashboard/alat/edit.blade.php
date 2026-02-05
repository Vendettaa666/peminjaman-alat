@extends('layouts.app')

@section('title', 'Edit Data Alat')

@section('content')
    <div class="max-w-2xl bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('alat.update', $alat->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Alat</label>
                <input type="text" name="nama_alat"
                    class="w-full p-2 border rounded @error('nama_alat') border-red-500 @enderror"
                    value="{{ old('nama_alat', $alat->nama_alat) }}">
            </div>

            {{-- Di dalam form create/edit --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="kategori_id" class="w-full p-2 border rounded @error('kategori_id') border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->id }}"
                            {{ old('kategori_id', $alat->kategori_id ?? '') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Stok</label>
                <input type="number" name="stok" class="w-full p-2 border rounded"
                    value="{{ old('stok', $alat->stok) }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="3" class="w-full p-2 border rounded">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('alat.index') }}" class="mr-2 px-4 py-2 text-gray-600">Batal</a>
                <button type="submit"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Perbarui</button>
            </div>
        </form>
    </div>
@endsection
