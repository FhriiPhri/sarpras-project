@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Kategori</h1>

    <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori *</label>
            <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('nama_kategori')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="3"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('kategoris.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md mr-2">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                Update
            </button>
        </div>
    </form>
</div>
@endsection