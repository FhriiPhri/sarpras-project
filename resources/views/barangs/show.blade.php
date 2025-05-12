@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <a href="{{ route('barangs.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Daftar Barang</a>
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Detail Barang</h1>

    <div class="flex flex-col sm:flex-row gap-6">
        @if($barang->gambar)
        <a href="{{ asset('storage/' . $barang->gambar) }}" target="_blank">
            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}" 
                 class="w-full sm:w-64 h-64 object-cover rounded shadow">
        </a>
        @else
            <div class="w-full sm:w-64 h-64 bg-gray-100 flex items-center justify-center rounded text-gray-400">
                Tidak ada gambar
            </div>
        @endif

        <div class="flex-1 space-y-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Nama Barang</h2>
                <p class="text-gray-900">{{ $barang->nama_barang }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Kategori</h2>
                <p class="text-gray-900">{{ $barang->kategori->nama_kategori }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Stok</h2>
                <p class="text-gray-900">{{ $barang->stok }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Kondisi</h2>
                <span class="px-3 py-1 rounded-full text-sm 
                    @if($barang->kondisi == 'baik') bg-green-100 text-green-800
                    @elseif($barang->kondisi == 'rusak_ringan') bg-yellow-100 text-yellow-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}
                </span>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-700">Status</h2>
                <span class="px-3 py-1 rounded-full text-sm 
                    @if($barang->status == 'tersedia') bg-blue-100 text-blue-800
                    @elseif($barang->status == 'dipinjam') bg-purple-100 text-purple-800
                    @else bg-orange-100 text-orange-800 @endif">
                    {{ ucfirst($barang->status) }}
                </span>
            </div>
        </div>
    </div>

    <div class="mt-8 flex justify-between">

        <div class="flex gap-2">
            <a href="{{ route('barangs.edit', $barang->id) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded text-sm">
                Edit
            </a>
            <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection