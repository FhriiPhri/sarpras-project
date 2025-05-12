@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">
        Selamat Datang, {{ Auth::user()->name }}! 👋🏻
    </h1>

    {{-- Ringkasan Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-12">
        <a href="{{ url('users') }}" class="group">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300 flex items-center gap-4">
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 group-hover:text-blue-600 transition">Total Users</p>
                    <h3 class="text-xl font-bold">{{ $totalUsers }} User</h3>
                </div>
            </div>
        </a>

        <a href="{{ route('kategoris.index') }}" class="group">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300 flex items-center gap-4">
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    <i class="fas fa-list text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 group-hover:text-green-600 transition">Total Kategori</p>
                    <h3 class="text-xl font-bold">{{ $totalKategori }} Kategori</h3>
                </div>
            </div>
        </a>

        <a href="{{ route('barangs.index') }}" class="group">
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition duration-300 flex items-center gap-4">
                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                    <i class="fas fa-box text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500 group-hover:text-yellow-600 transition">Total Barang</p>
                    <h3 class="text-xl font-bold">{{ $totalBarang }} Barang</h3>
                </div>
            </div>
        </a>

        <div class="bg-white p-6 rounded-xl shadow flex items-center gap-4">
            <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                <i class="fas fa-warehouse text-xl"></i>
            </div>
            <div>
                <p class="text-sm text-gray-500">Barang Rusak</p>
                <h3 class="text-xl font-bold">{{ $totalBarangRusak ?? 0 }} Barang</h3>
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="border-t border-gray-200 mb-8"></div>

    {{-- Detail Admin --}}
    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">
            Profil <strong>{{ Auth::user()->name }}</strong>
        </h2>
        <ul class="text-gray-600 text-base space-y-2">
            <li><span class="font-medium text-gray-800">Nama:</span> {{ Auth::user()->name }}</li>
            <li><span class="font-medium text-gray-800">Email:</span> {{ Auth::user()->email }}</li>
            <li><span class="font-medium text-gray-800">Role:</span> {{ Auth::user()->role ?? 'admin' }}</li>
            <li><span class="font-medium text-gray-800">Terdaftar Sejak:</span> {{ Auth::user()->created_at->format('d F Y') }}</li>
            <li><span class="font-medium text-gray-800">Pukul:</span> {{ Auth::user()->created_at->format('H.i') }} WIB</li>
        </ul>
    </div>
</div>
@endsection