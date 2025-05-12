@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Barang</h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barangs.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang) }}"
                   class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Kategori</label>
            <select name="kategori_id" class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Stok</label>
            <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}"
            class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring"
            step="1" min="0" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Kondisi</label>
            <select name="kondisi" class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring" required>
                <option value="baik" {{ $barang->kondisi == 'baik' ? 'selected' : '' }}>Baik</option>
                <option value="rusak_ringan" {{ $barang->kondisi == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                <option value="rusak_berat" {{ $barang->kondisi == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select name="status" class="w-full mt-1 px-4 py-2 border rounded focus:outline-none focus:ring" required>
                <option value="tersedia" {{ $barang->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="dipinjam" {{ $barang->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                <option value="rusak" {{ $barang->status == 'rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Gambar Barang</label>
            @if ($barang->gambar)
                <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" class="w-24 h-24 object-cover mb-2">
            @endif
            <input type="file" name="gambar" class="w-full mt-1">
            <small class="text-gray-500 text-sm">Kosongkan jika tidak ingin mengubah gambar</small>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('barangs.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded mr-2">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection