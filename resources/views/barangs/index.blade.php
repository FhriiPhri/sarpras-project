@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
<div class="max-w-6xl mx-auto p-4 sm:p-6 bg-white rounded-lg shadow-md">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-xl sm:text-2xl font-semibold text-gray-800">Daftar Barang</h1>
        <a href="{{ route('barangs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto text-center">
            + Tambah Barang
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-2 sm:px-4 py-2 border-b text-left">No</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-left hidden sm:table-cell">Gambar</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-left">Barang</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-left hidden md:table-cell">Kategori</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-center">Stok</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-center hidden sm:table-cell">Kondisi</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-center">Status</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangs as $index => $barang)
                <tr class="hover:bg-gray-50 cursor-pointer"
                    onclick="window.location='{{ route(name: 'barangs.show', parameters: $barang->id) }}'">
                    <td class="px-2 sm:px-4 py-2 border-b">{{ $index + 1 }}</td>
                    <td class="px-2 sm:px-4 py-2 border-b hidden sm:table-cell text-center">
                        @if($barang->gambar)
                        <a href="{{ asset('storage/' . $barang->gambar) }}" target="_blank">
                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}" 
                                 class="w-12 h-12 sm:w-16 sm:h-16 object-cover mx-auto rounded hover:opacity-80 transition">
                        </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-2 sm:px-4 py-2 border-b font-medium">
                        {{ $barang->nama_barang }}
                        <div class="sm:hidden text-sm text-gray-500 mt-1">
                            Kategori: {{ $barang->kategori->nama_kategori }}
                        </div>
                        @if($barang->gambar)
                        <div class="sm:hidden mt-2">
                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}" 
                                 class="w-12 h-12 object-cover rounded">
                        </div>
                        @endif
                    </td>
                    <td class="px-2 sm:px-4 py-2 border-b hidden md:table-cell">
                        {{ $barang->kategori->nama_kategori }}
                    </td>
                    <td class="px-2 sm:px-4 py-2 border-b text-center">
                        {{ $barang->stok }}
                    </td>
                    <td class="px-2 sm:px-4 py-2 border-b text-center hidden sm:table-cell">
                        <span class="px-2 py-1 rounded-full text-xs 
                            @if($barang->kondisi == 'baik') bg-green-100 text-green-800
                            @elseif($barang->kondisi == 'rusak_ringan') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst(str_replace('_', ' ', $barang->kondisi)) }}
                        </span>
                    </td>
                    <td class="px-2 sm:px-4 py-2 border-b text-center">
                        <span class="px-2 py-1 rounded-full text-xs 
                            @if($barang->status == 'tersedia') bg-blue-100 text-blue-800
                            @elseif($barang->status == 'dipinjam') bg-purple-100 text-purple-800
                            @else bg-orange-100 text-orange-800 @endif">
                            {{ ucfirst($barang->status) }}
                        </span>
                    </td>
                    <td class="px-2 sm:px-4 py-2 border-b">
                        <div class="flex flex-col sm:flex-row justify-center gap-2">
                            <a href="{{ route(name: 'barangs.edit', parameters: $barang->id) }}" 
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-center text-sm">
                                Edit
                            </a>
                            <form action="{{ route('barangs.destroy', $barang->id) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-center text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection