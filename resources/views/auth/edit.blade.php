@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="p-6">
        <!-- Premium Header Section -->
        <div class="glass-card bg-white/80 backdrop-blur-sm rounded-xl p-5 mb-6 border border-gray-200 shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ route('profile') }}"
                        class="transition duration-300 ease-in-out hover:bg-gray-100 text-gray-700 p-2 rounded-full inline-flex items-center">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Edit Profil Admin</h1>
                        <p class="text-sm text-gray-600 mt-1">Perbarui informasi akun Anda</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Notification -->
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg shadow-inner">
                <div class="flex items-center">
                    <div class="flex-shrink-0 text-red-500">
                        <i class="fas fa-exclamation-circle fa-lg"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800 mb-2">Terdapat {{ $errors->count() }} kesalahan yang
                            perlu diperbaiki</h3>
                        <ul class="list-disc pl-5 text-sm text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Edit Profile Card -->
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-lg">
            <div class="p-6">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Profile Picture Section -->
                    <div class="flex flex-col items-center sm:flex-row gap-6 mb-6">
                        <div class="relative">
                            <!-- Image Preview -->
                            <img id="previewImage"
                                src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : '' }}"
                                class="w-20 h-20 rounded-full object-cover shadow-md {{ Auth::user()->profile_picture ? '' : 'hidden' }}"
                                alt="Profile Picture Preview">

                            <!-- Default Initial -->
                            <div id="defaultAvatar"
                                class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-600 to-indigo-600 text-white flex items-center justify-center text-3xl font-bold shadow-md {{ Auth::user()->profile_picture ? 'hidden' : '' }}">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <!-- Label Kamera -->
                            <label for="profile_picture"
                                class="absolute -bottom-2 -right-2 bg-white border-2 border-gray-200 rounded-full p-1.5 shadow-sm hover:bg-gray-100 transition-colors duration-200 cursor-pointer">
                                <i class="fas fa-camera text-blue-600 text-sm"></i>
                            </label>

                            <!-- Input File -->
                            <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                                class="hidden">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-800">Foto Profil</h3>
                            <p class="text-sm text-gray-500 mt-1">Format JPG, GIF atau PNG. Maksimal 2MB</p>
                        </div>
                    </div>

                    <!-- Form Fields -->
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="name"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-1">
                                <span>Nama Lengkap</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-user"></i>
                                </div>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', Auth::user()->name) }}"
                                    class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="{{ Auth::user()->name }}" required>
                            </div>
                        </div>

                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-1">
                                <span>Alamat Email</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}"
                                    class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="{{ Auth::user()->email }}" required>
                            </div>
                        </div>
                        <div>
                            <label for="password"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-1">
                                <span>Password Baru</span>
                                <span class="text-sm text-gray-500">( Opsional )</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-key"></i>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="Isi Password Baru">
                            </div>
                        </div>
                        <div>
                            <label for="password"
                                class="block text-sm font-medium text-gray-700 mb-2 flex items-center gap-1">
                                <span>Konfirmasi Password</span>
                                <span class="text-sm text-gray-500">( Opsional )</span>
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                    <i class="fas fa-key"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="pl-10 pr-4 py-3 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                    placeholder="Konfirmasi Password">
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-6 border-t border-gray-200 flex flex-col sm:flex-row justify-between gap-4">
                        <div class="text-sm text-gray-500">
                            <span class="text-red-500">*</span> Menandakan field wajib diisi
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('profile') }}"
                                class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
                                <i class="fas fa-save"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .glass-card {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
        }
    </style>

    @push('scripts')
        <script>
            document.getElementById('profile_picture').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const previewImage = document.getElementById('previewImage');
                const defaultAvatar = document.getElementById('defaultAvatar');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        defaultAvatar.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endpush
@endsection