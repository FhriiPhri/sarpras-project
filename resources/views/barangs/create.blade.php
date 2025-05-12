@extends('layouts.app')

@section('title', 'Tambah Barang Baru')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">
        {{ isset($barang) ? 'Edit Barang' : 'Tambah Barang Baru' }}
    </h1>

    <form action="{{ isset($barang) ? route('barangs.update', $barang->id) : route('barangs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($barang))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2">
                <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang *</label>
                <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                <select id="kategori_id" name="kategori_id" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" 
                            {{ old('kategori_id', $barang->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok *</label>
                <input type="number" id="stok" name="stok" min="0" value="{{ old('stok', $barang->stok ?? 0) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi *</label>
                <select id="kondisi" name="kondisi" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="baik" {{ old('kondisi', $barang->kondisi ?? '') == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak_ringan" {{ old('kondisi', $barang->kondisi ?? '') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak_berat" {{ old('kondisi', $barang->kondisi ?? '') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                <select id="status" name="status" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="tersedia" {{ old('status', $barang->status ?? '') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="dipinjam" {{ old('status', $barang->status ?? '') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="perbaikan" {{ old('status', $barang->status ?? '') == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                </select>
            </div>

            <div class="col-span-2">
                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                <input type="file" id="gambar" name="gambar" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                
                @if(isset($barang) && $barang->gambar))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang" class="h-32 object-cover">
                        <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                    </div>
                @endif
            </div>

            <div class="col-span-2">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi', $barang->deskripsi ?? '') }}</textarea>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('barangs.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md mr-2">
                Batal
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                {{ isset($barang) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection