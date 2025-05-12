@extends('layouts.app')

@section('title', 'My Profile')
@section('content')

<div class="max-w-4xl mx-auto p-4 sm:p-6 bg-white rounded-lg shadow-md">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="transition duration-300 ease-in-out hover:bg-gray-300 text-gray-700 p-2 sm:p-3 rounded-full inline-flex items-center transition">
                <i class="fas fa-arrow-left text-sm sm:text-base"></i>
            </a>
            <h1 class="text-xl sm:text-2xl font-semibold text-gray-800">Detail Profil Admin</h1>
        </div>
    
        <a href="{{ route('profile.edit') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-5 py-2 rounded-lg shadow transition text-center">
            Edit Profil Admin
        </a>
    </div>
    

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 p-3 sm:p-4 bg-green-100 text-green-800 rounded-lg text-sm sm:text-base">
            {{ session('success') }}
        </div>
    @endif

    <!-- Profile Content -->
    <div class="space-y-6 sm:space-y-10">
        <!-- Profile Header -->
        <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 text-center sm:text-left">
            <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl sm:text-2xl font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg sm:text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                <p class="text-gray-500 text-sm sm:text-base">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <!-- Account Information -->
        <div class="bg-gray-50 p-4 sm:p-6 rounded-lg shadow transition duration-300 ease-in-out hover:shadow-lg">
            <h3 class="text-base sm:text-lg font-semibold text-blue-700 mb-4 sm:mb-5">Informasi Admin</h3>
            <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2">
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Nama</p>
                    <p class="font-medium text-gray-800 text-sm sm:text-base">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Email</p>
                    <p class="font-medium text-gray-800 text-sm sm:text-base">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Dibuat Pada</p>
                    <p class="font-medium text-gray-800 text-sm sm:text-base">{{ Auth::user()->created_at->format('j F Y - H.i') }} WIB</p>
                </div>
                <div>
                    <p class="text-xs sm:text-sm text-gray-500">Terakhir Di Update</p>
                    <p class="font-medium text-gray-800 text-sm sm:text-base">{{ Auth::user()->updated_at->format('j F Y - H.i') }} WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection