@extends('layouts.app')

@section('title', 'Daftar Users')

@section('content')
<div class="max-w-6xl mx-auto p-4 sm:p-6 bg-white rounded-lg shadow-md">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-xl sm:text-2xl font-semibold text-gray-800">Daftar Users</h1>
        <a href="{{ url('users/create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto text-center">
            + Tambah User
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
                    <th class="px-2 sm:px-4 py-2 border-b text-left">Nama</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-left hidden sm:table-cell">Email</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-left">Role</th>
                    <th class="px-2 sm:px-4 py-2 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach($users as $index => $user)
                    @if ($user->role === 'user')
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 sm:px-4 py-2 border-b text-sm">{{ $number++ }}</td>
                            <td class="px-2 sm:px-4 py-2 border-b font-medium text-sm">{{ $user->name }}</td>
                            <td class="px-2 sm:px-4 py-2 border-b hidden sm:table-cell text-sm">{{ $user->email }}</td>
                            <td class="px-2 sm:px-4 py-2 border-b">
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded 
                                    bg-green-100 text-green-800">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-2 sm:px-4 py-2 border-b">
                                <div class="flex flex-col sm:flex-row justify-center sm:justify-start gap-2">
                                    <a href="{{ route('users.edit', $user->id) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-center text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded w-full text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>            
        </table>
    </div>
</div>
@endsection