@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Selamat Datang</h2>
            <p class="text-gray-600">Web Sarpras <strong>SMK Taruna Bhakti</strong></p>
        </div>

        @if($errors->any())
            <div class="mb-4 bg-red-100 text-red-800 p-4 rounded-md">
                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-800 p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="px-5 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required autofocus>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password"
                    class="px-5 py-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    Remember me
                </label>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md shadow transition">
                Login
            </button>
        </form>
    </div>
</div>
@endsection