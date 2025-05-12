<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Sarpras SMK Taruna Bhakti Depok - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
        .mobile-menu.open {
            max-height: 500px;
        }
    </style>
    @stack('styles')
</head>
<body class="overflow-x-hidden bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow sticky top-0 z-50 w-full left-0 right-0">
        <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-blue-600 whitespace-nowrap">
                    SarprasTBSystem
                </a>
        
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ route('users.index') }}" class="hover:text-blue-700 duration-300 text-black font-medium px-3 py-1.5 sm:px-4 sm:py-2 text-sm sm:text-base transition">Users</a>
                        <a href="{{ route('kategoris.index') }}" class="hover:text-blue-700 duration-300 text-black font-medium px-3 py-1.5 sm:px-4 sm:py-2 text-sm sm:text-base transition">Kategori</a>
                        <a href="{{ route('barangs.index') }}" class="hover:text-blue-700 duration-300 text-black font-medium px-3 py-1.5 sm:px-4 sm:py-2 text-sm sm:text-base transition">Barang</a>
                        <a href="{{ route('peminjaman-sarana.index') }}" class="hover:text-blue-700 duration-300 text-black font-medium px-3 py-1.5 sm:px-4 sm:py-2 text-sm sm:text-base transition">Peminjaman</a>
                        <a href="{{ route(name: 'profile') }}" class="ml-8 w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 sm:px-4 sm:py-2 rounded shadow text-sm sm:text-base transition whitespace-nowrap">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="mobile-menu md:hidden bg-white">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    @auth
                        <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-700 hover:bg-gray-50">Users</a>
                        <a href="{{ route('kategoris.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-700 hover:bg-gray-50">Kategori</a>
                        <a href="{{ route('barangs.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-blue-700 hover:bg-gray-50">Barang</a>
                        <div class="flex items-center pt-2">
                            <a href="{{ route(name: 'profile') }}" class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm mr-3">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded shadow text-base transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>    

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        @yield('content')
    </main>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        });
    </script>
    
    @stack('scripts')
</body>
</html>