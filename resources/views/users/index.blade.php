@extends('layouts.app')

@section('title', 'Daftar Users')

@section('content')
<div class="p-6">
    <!-- Header Section with Glassmorphism Effect -->
    <div class="glass-card bg-white bg-opacity-80 backdrop-blur-sm rounded-xl p-5 mb-8 border border-gray-200 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Manajemen Pengguna</span>
                </h1>
                <p class="text-sm text-gray-600 mt-2">Kelola data pengguna dengan hak akses yang berbeda</p>
            </div>
            <a href="{{ url('users/create') }}" 
               class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-5 py-2.5 rounded-lg flex items-center gap-2 transition-all duration-300 shadow-md hover:shadow-lg">
                <i class="fas fa-user-plus"></i>
                <span>Tambah Pengguna Baru</span>
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

    <!-- User Table Card -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-lg">
        <!-- Table Header with Stats -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Daftar Pengguna Sistem</h3>
                <p class="text-xs text-gray-500">Total {{ $users->count() }} pengguna terdaftar</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="hidden sm:flex items-center gap-2 text-sm">
                    <span class="w-3 h-3 rounded-full bg-green-400"></span>
                    <span>User</span>
                    <span class="w-3 h-3 rounded-full bg-purple-400 ml-2"></span>
                    <span>Admin</span>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden lg:table-cell">Kontak</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider pr-8">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 rounded-lg bg-gradient-to-br 
                                    {{ $user->role === 'admin' ? 'from-purple-500 to-purple-600' : 'from-green-500 to-green-600' }} 
                                    flex items-center justify-center text-white font-bold shadow-sm">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500 lg:hidden">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden lg:table-cell">
                            <div class="flex flex-col">
                                <span>{{ $user->email }}</span>
                                <span class="text-xs text-gray-400 mt-1">Terdaftar: {{ $user->created_at->format('d M Y') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="relative inline-flex items-center px-3 py-1 rounded-full text-xs font-medium 
                                {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                <span class="absolute -left-1 -top-1 h-2 w-2 rounded-full 
                                    {{ $user->role === 'admin' ? 'bg-purple-500' : 'bg-green-500' }} animate-pulse"></span>
                                <span class="ml-2">{{ ucfirst($user->role) }}</span>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium pr-6">
                            <div class="flex justify-end space-x-3 group-hover:opacity-100 transition-opacity duration-200">
                                <a href="{{ route('users.edit', $user->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 transition-colors duration-200 p-2 rounded-full hover:bg-blue-50"
                                   title="Edit">
                                    <i class="fas fa-pencil-alt fa-sm"></i>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors duration-200 p-2 rounded-full hover:bg-red-50"
                                            title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
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
</div>
@endsection