@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="p-6">
    <!-- Header Section -->
    <div class="glass-card bg-white/80 backdrop-blur-sm rounded-xl p-5 mb-6 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span>Manajemen Inventaris Barang</span>
                </h1>
                <p class="text-sm text-gray-600 mt-2">Kelola data barang sarana dan prasarana</p>
            </div>
            <a href="{{ route('barangs.create') }}" 
               class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Tambah Barang Baru</span>
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-6 rounded-lg shadow-inner">
        <div class="flex items-center">
            <div class="flex-shrink-0 text-emerald-500 animate-pulse">
                <i class="fas fa-check-circle fa-lg"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Barang Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-lg">
        <!-- Table Header with Stats -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Daftar Inventaris Barang</h3>
                <p class="text-xs text-gray-500">{{ $barangs->count() }} barang terdaftar</p>
            </div>
            <div class="relative">
                <input type="text" placeholder="Cari barang..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Kategori</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">Kondisi</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider pr-8">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($barangs as $index => $barang)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 rounded-lg bg-gray-100 overflow-hidden mr-4">
                                    @if($barang->gambar)
                                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}" 
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                    @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                        <i class="fas fa-box-open text-xl"></i>
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-1">
                                    <div class="text-sm font-semibold text-gray-900">{{ $barang->nama_barang }}</div>
                                    <div class="text-xs text-gray-500 lg:hidden">{{ $barang->kategori->nama_kategori }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $barang->kategori->nama_kategori }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-500">
                            {{ $barang->stok }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center hidden sm:table-cell">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($barang->kondisi == 'baik') bg-green-100 text-green-800
                                @elseif($barang->kondisi == 'rusak_ringan') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                <span class="w-2 h-2 rounded-full mr-1.5 
                                    @if($barang->kondisi == 'baik') bg-green-500
                                    @elseif($barang->kondisi == 'rusak_ringan') bg-yellow-500
                                    @else bg-red-500 @endif"></span>
                                {{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($barang->status == 'tersedia') bg-blue-100 text-blue-800
                                @elseif($barang->status == 'dipinjam') bg-purple-100 text-purple-800
                                @else bg-orange-100 text-orange-800 @endif">
                                <span class="w-2 h-2 rounded-full mr-1.5 
                                    @if($barang->status == 'tersedia') bg-blue-500
                                    @elseif($barang->status == 'dipinjam') bg-purple-500
                                    @else bg-orange-500 @endif"></span>
                                {{ ucfirst($barang->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium pr-6">
                            <div class="flex justify-end space-x-3 group-hover:opacity-100 transition-opacity duration-200">
                                <a href="{{ route('barangs.show', $barang->id) }}" 
                                   class="text-gray-600 hover:text-gray-900 transition-colors duration-200 p-2 rounded-full hover:bg-gray-100"
                                   title="Detail">
                                    <i class="fas fa-eye fa-sm"></i>
                                </a>
                                <a href="{{ route('barangs.edit', $barang->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200 p-2 rounded-full hover:bg-blue-50"
                                   title="Edit">
                                    <i class="fas fa-pencil-alt fa-sm"></i>
                                </a>
                                <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200 p-2 rounded-full hover:bg-red-50"
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                        <i class="fas fa-trash-alt fa-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
    </div>

    <!-- Empty State -->
    @if($barangs->isEmpty())
    <div class="bg-white rounded-xl border border-gray-200 p-8 text-center shadow-lg">
        <div class="mx-auto h-24 w-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-boxes text-3xl text-blue-300"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada barang terdaftar</h3>
        <p class="text-sm text-gray-500 mb-4">Mulai dengan menambahkan barang baru ke inventaris</p>
        <a href="{{ route('barangs.create') }}" 
           class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all duration-300 shadow-md hover:shadow-lg">
            <i class="fas fa-plus-circle mr-2"></i>
            Tambah Barang
        </a>
    </div>
    @endif
</div>
@endsection