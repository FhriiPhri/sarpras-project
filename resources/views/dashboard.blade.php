@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl md:text-3xl font-semibold text-gray-800">
            Selamat Datang, {{ Auth::user()->name }}! 👋🏻
        </h1>
        <div class="text-sm text-gray-500">
            {{ now()->format('l, d F Y') }}
        </div>
    </div>

    {{-- Ringkasan Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        <!-- User Card -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
            <a href="{{ url('users') }}" class="block">
                <div class="p-5 flex items-center">
                    <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Users</p>
                        <h3 class="text-xl font-bold text-gray-800">{{ $totalUsers }} User</h3>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-2 text-sm text-blue-600 font-medium">
                    Lihat detail <i class="fas fa-arrow-right ml-1"></i>
                </div>
            </a>
        </div>

        <!-- Kategori Card -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
            <a href="{{ route('kategoris.index') }}" class="block">
                <div class="p-5 flex items-center">
                    <div class="p-3 rounded-full bg-green-50 text-green-600 mr-4">
                        <i class="fas fa-list text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Kategori</p>
                        <h3 class="text-xl font-bold text-gray-800">{{ $totalKategori }} Kategori</h3>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-2 text-sm text-green-600 font-medium">
                    Lihat detail <i class="fas fa-arrow-right ml-1"></i>
                </div>
            </a>
        </div>

        <!-- Barang Card -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
            <a href="{{ route('barangs.index') }}" class="block">
                <div class="p-5 flex items-center">
                    <div class="p-3 rounded-full bg-amber-50 text-amber-600 mr-4">
                        <i class="fas fa-box text-xl"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Barang</p>
                        <h3 class="text-xl font-bold text-gray-800">{{ $totalBarang }} Barang</h3>
                    </div>
                </div>
                <div class="bg-gray-50 px-5 py-2 text-sm text-amber-600 font-medium">
                    Lihat detail <i class="fas fa-arrow-right ml-1"></i>
                </div>
            </a>
        </div>

        <!-- Barang Rusak Card -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">
            <div class="p-5 flex items-center">
                <div class="p-3 rounded-full bg-purple-50 text-purple-600 mr-4">
                    <i class="fas fa-warehouse text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Barang Rusak</p>
                    <h3 class="text-xl font-bold text-gray-800">{{ $totalBarangRusak ?? 0 }} Barang</h3>
                </div>
            </div>
            <div class="bg-gray-50 px-5 py-2 text-sm text-gray-500 font-medium">
                Tidak ada aksi
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="border-t border-gray-200 my-6"></div>

    {{-- Detail Admin --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profil Card -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden col-span-2">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-user-circle mr-2 text-blue-500"></i> Profil Anda
                </h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="font-medium">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Role</p>
                            <p class="font-medium">{{ Auth::user()->role ?? 'Admin' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Bergabung Pada</p>
                            <p class="font-medium">
                                {{ Auth::user()->created_at->format('d F Y') }} 
                                <span class="text-gray-500"> | {{ Auth::user()->created_at->format('H:i') }} WIB</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-6 py-3 text-right">
                <a href="{{ route('profile') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                    Edit Profil <i class="fas fa-edit ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-bolt mr-2 text-yellow-500"></i> Quick Actions
                </h2>
            </div>
            <div class="p-4">
                <div class="space-y-3">
                    <a href="{{ route('barangs.create') }}" class="flex items-center p-3 rounded-lg hover:bg-blue-50 transition-colors duration-200">
                        <div class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="font-medium">Tambah Barang Baru</span>
                    </a>
                    <a href="{{ route('peminjaman-sarana.index') }}" class="flex items-center p-3 rounded-lg hover:bg-green-50 transition-colors duration-200">
                        <div class="bg-green-100 text-green-600 p-2 rounded-full mr-3">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <span class="font-medium">Kelola Peminjaman</span>
                    </a>
                    <a href="{{ route('users.create') }}" class="flex items-center p-3 rounded-lg hover:bg-purple-50 transition-colors duration-200">
                        <div class="bg-purple-100 text-purple-600 p-2 rounded-full mr-3">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <span class="font-medium">Tambah User Baru</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection