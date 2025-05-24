@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="p-6">
    <!-- Premium Header Section -->
    <div class="glass-card bg-white/80 backdrop-blur-sm rounded-xl p-6 mb-8 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    <span>Manajemen Kategori</span>
                </h1>
                <p class="text-sm text-gray-600 mt-2">Kelola kategori barang sarana dan prasarana</p>
            </div>
            <a href="{{ route('kategoris.create') }}" 
               class="bg-gradient-to-r from-indigo-600 to-blue-500 hover:from-indigo-700 hover:to-blue-600 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-plus-circle"></i>
                <span>Tambah Kategori Baru</span>
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 mb-8 rounded-lg shadow-inner">
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

    <!-- Categories Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-lg">
        <!-- Table Header with Stats -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Daftar Kategori</h3>
                <p class="text-xs text-gray-500">{{ $kategoris->count() }} kategori terdaftar</p>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Deskripsi</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider pr-8">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($kategoris as $index => $kategori)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white shadow-sm">
                                    <i class="fas fa-tag text-sm"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $kategori->nama_kategori }}</div>
                                    <div class="text-xs text-gray-500 lg:hidden">
                                        {{ Str::limit($kategori->deskripsi ?? '-', 30) }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 hidden lg:table-cell">
                            <div class="line-clamp-2">{{ $kategori->deskripsi ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium pr-6">
                            <div class="flex justify-end space-x-3 group-hover:opacity-100 transition-opacity duration-200">
                                <a href="{{ route('kategoris.edit', $kategori->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200 p-2 rounded-full hover:bg-blue-50"
                                   title="Edit">
                                    <i class="fas fa-pencil-alt fa-sm"></i>
                                </a>
                                <form action="{{ route('kategoris.destroy', $kategori->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200 p-2 rounded-full hover:bg-red-50"
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                        <i class="fas fa-trash-alt fa-sm"></i>
                                    </button>
                                </form>
                                <a href="#" 
                                   class="text-gray-600 hover:text-gray-900 transition-colors duration-200 p-2 rounded-full hover:bg-gray-100"
                                   title="Detail">
                                    <i class="fas fa-ellipsis-h fa-sm"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Empty State -->
    @if($kategoris->isEmpty())
    <div class="bg-white rounded-xl mt-5 border border-gray-200 p-8 text-center shadow-lg">
        <div class="mx-auto h-24 w-24 bg-indigo-50 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-tags text-3xl text-indigo-300"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada kategori</h3>
        <p class="text-sm text-gray-500 mb-4">Mulai dengan menambahkan kategori baru</p>
        <a href="{{ route('kategoris.create') }}" 
           class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-500 text-white rounded-lg hover:from-indigo-700 hover:to-blue-600 transition-all duration-300 shadow-md hover:shadow-lg">
            <i class="fas fa-plus-circle mr-2"></i>
            Tambah Kategori
        </a>
    </div>
    @endif
</div>
@endsection