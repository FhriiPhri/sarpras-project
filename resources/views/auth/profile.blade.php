@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="p-6">
        <!-- Premium Header Section -->
        <div class="glass-card bg-white/80 backdrop-blur-sm rounded-xl p-5 mb-6 border border-gray-200 shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('dashboard') }}"
                        class="transition duration-300 ease-in-out hover:bg-gray-100 text-gray-700 p-2 rounded-full inline-flex items-center">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Profil Admin</h1>
                        <p class="text-sm text-gray-600 mt-1">Kelola informasi akun Anda</p>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}"
                    class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all duration-300 shadow-md hover:shadow-lg">
                    <i class="fas fa-user-edit"></i>
                    <span>Edit Profil</span>
                </a>
            </div>
        </div>

        <!-- Success Notification -->
        @if (session('success'))
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

        <!-- Profile Card -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-lg">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 flex flex-col sm:flex-row items-center gap-6">
                <div class="relative">
                    @if (Auth::user()->profile_picture)
                        <img src="{{ asset('storage/profile_pictures/' . Auth::user()->profile_picture) }}"
                            alt="Profile Picture" class="w-20 h-20 sm:w-24 sm:h-24 rounded-full object-cover shadow-md">
                    @else
                        <div
                            class="w-20 h-20 sm:w-24 sm:h-24 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 text-white flex items-center justify-center text-3xl sm:text-4xl font-bold shadow-md">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="text-center sm:text-left">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-blue-600 font-medium">{{ Auth::user()->email }}</p>
                    <p class="text-sm text-gray-500 mt-1">Bergabung {{ Auth::user()->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Account Information -->
                    <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-user-circle text-blue-500"></i>
                            <span>Informasi Akun</span>
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</p>
                                <p class="mt-1 text-gray-800">{{ Auth::user()->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat Email</p>
                                <p class="mt-1 text-gray-800">{{ Auth::user()->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Role</p>
                                <p class="mt-1 text-gray-800">{{ Auth::user()->role ?? 'Admin' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Account Activity -->
                    <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-history text-blue-500"></i>
                            <span>Aktivitas Akun</span>
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Terdaftar Pada</p>
                                <p class="mt-1 text-gray-800">{{ Auth::user()->created_at->format('d F Y - H:i') }} WIB</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Terakhir Diperbarui
                                </p>
                                <p class="mt-1 text-gray-800">{{ Auth::user()->updated_at->format('d F Y - H:i') }} WIB</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Status Akun</p>
                                <div class="mt-1">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <span class="w-2 h-2 rounded-full bg-green-500 mr-1.5"></span>
                                        Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Section -->
                <div class="mt-6 bg-gray-50 p-5 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-shield-alt text-blue-500"></i>
                        <span>Keamanan Akun</span>
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-800">Kata Sandi</p>
                                <p class="text-xs text-gray-500">Terakhir diubah
                                    {{ Auth::user()->password_changed_at ? Auth::user()->password_changed_at->diffForHumans() : '( Belum pernah diganti )' }}</p>
                            </div>
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

        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }
    </style>
@endsection
