@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')
<div class="p-6">
    <!-- Premium Header Section -->
    <div class="glass-card bg-white/80 backdrop-blur-sm rounded-xl p-5 mb-6 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <a href="{{ route('barangs.index') }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200 flex items-center gap-2 mb-3">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Daftar Barang</span>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Detail Inventaris Barang</span>
                </h1>
                <p class="text-sm text-gray-600 mt-2">Informasi lengkap tentang barang sarana/prasarana</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-lg">
        <div class="flex flex-col lg:flex-row">
            <!-- Image Section -->
            <div class="lg:w-1/3 p-6 border-b lg:border-b-0 lg:border-r border-gray-200 bg-gray-50">
                @if($barang->gambar)
                <a href="{{ asset('storage/' . $barang->gambar) }}" target="_blank" class="block group">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg shadow-md">
                        <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <p class="text-xs text-gray-500 mt-2 text-center">Klik gambar untuk melihat ukuran penuh</p>
                </a>
                @else
                <div class="aspect-w-1 aspect-h-1 w-full bg-gray-100 rounded-lg shadow-md flex items-center justify-center">
                    <div class="text-center p-4">
                        <i class="fas fa-box-open text-4xl text-gray-300 mb-2"></i>
                        <p class="text-gray-400">Tidak ada gambar tersedia</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Detail Section -->
            <div class="lg:w-2/3 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div class="col-span-2">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Informasi Dasar</h2>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Nama Barang</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $barang->nama_barang }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Kategori</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $barang->kategori->nama_kategori }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Stok Tersedia</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $barang->stok }} unit</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Kode Inventaris</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $barang->kode_inventaris ?? '-' }}</p>
                    </div>

                    <!-- Status Information -->
                    <div class="col-span-2 mt-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Status Barang</h2>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Kondisi</h3>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($barang->kondisi == 'baik') bg-green-100 text-green-800
                                @elseif($barang->kondisi == 'rusak_ringan') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                <span class="w-2 h-2 rounded-full mr-2 
                                    @if($barang->kondisi == 'baik') bg-green-500
                                    @elseif($barang->kondisi == 'rusak_ringan') bg-yellow-500
                                    @else bg-red-500 @endif"></span>
                                {{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Status</h3>
                        <div class="mt-1">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                @if($barang->status == 'tersedia') bg-blue-100 text-blue-800
                                @elseif($barang->status == 'dipinjam') bg-purple-100 text-purple-800
                                @else bg-orange-100 text-orange-800 @endif">
                                <span class="w-2 h-2 rounded-full mr-2 
                                    @if($barang->status == 'tersedia') bg-blue-500
                                    @elseif($barang->status == 'dipinjam') bg-purple-500
                                    @else bg-orange-500 @endif"></span>
                                {{ ucfirst($barang->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    @if($barang->deskripsi)
                    <div class="col-span-2 mt-4">
                        <h3 class="text-sm font-medium text-gray-500">Deskripsi</h3>
                        <p class="mt-1 text-gray-700">{{ $barang->deskripsi }}</p>
                    </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap justify-between items-center gap-4">
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Terakhir diperbarui: {{ $barang->updated_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('barangs.edit', $barang->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200">
                            <i class="fas fa-edit"></i>
                            <span>Edit Barang</span>
                        </a>
                        <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors duration-200"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                <i class="fas fa-trash-alt"></i>
                                <span>Hapus Barang</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    .aspect-w-1 {
        position: relative;
        width: 100%;
    }
    .aspect-h-1 {
        padding-bottom: 100%;
    }
    .aspect-w-1 > * {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
@endsection