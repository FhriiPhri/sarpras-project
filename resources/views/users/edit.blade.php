@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit User</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="mt-1 block w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex justify-end">
            <a href="{{ route('users.index') }}"
               class="mr-4 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded">
                Batal
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>
    </form>
</div>
@endsection