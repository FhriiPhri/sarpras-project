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
        .sidebar {
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }
        .sidebar-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        .sidebar-item:hover {
            background-color: rgba(59, 130, 246, 0.1);
            border-left-color: #3b82f6;
        }
        .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.1);
            border-left-color: #3b82f6;
            font-weight: 500;
        }
        .sidebar-content {
            flex: 1;
            overflow-y: auto;
        }
        .sidebar-profile {
            border-top: 1px solid #e5e7eb;
            padding: 1rem;
            background-color: white;
        }
        .content-area {
            transition: all 0.3s ease;
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
<body class="bg-gray-100 text-gray-800 flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="sidebar bg-white shadow-md w-64 flex-shrink-0 hidden md:flex">
        <div class="sidebar-content">
            <div class="p-4 border-b border-gray-200">
                <a href="/" class="text-xl font-bold text-blue-600 flex items-center">
                    <i class="fas fa-boxes mr-2"></i>
                    <span>SarprasTBSystem</span>
                </a>
            </div>
            
            <nav class="p-4">
                <ul class="space-y-2">
                    @auth
                    <li>
                        <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-700">
                            <i class="fas fa-tachometer-alt mr-3 text-gray-500"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-700">
                            <i class="fas fa-users mr-3 text-gray-500"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kategoris.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-700">
                            <i class="fas fa-tags mr-3 text-gray-500"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('barangs.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-700">
                            <i class="fas fa-box-open mr-3 text-gray-500"></i>
                            <span>Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('peminjaman-sarana.index') }}" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-700">
                            <i class="fas fa-exchange-alt mr-3 text-gray-500"></i>
                            <span>Peminjaman</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </nav>
        </div>
        
        @auth
        <div class="sidebar-profile">
            <div class="flex items-center justify-between">
                <a href="{{ route('profile') }}" class="flex items-center flex-1">
                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm mr-3">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="truncate">
                        <p class="font-medium text-gray-800 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                    </div>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-500 transition ml-2" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
        @endauth
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Mobile Header -->
        <header class="bg-white shadow sticky top-0 z-40 md:hidden">
            <div class="px-4 py-3 flex justify-between items-center">
                <a href="/" class="text-xl font-bold text-blue-600">
                    SarprasTBSystem
                </a>
                
                <button id="mobile-menu-button" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="mobile-menu bg-white">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    @auth
                        <div class="flex items-center px-4 py-3 border-b border-gray-200 mb-2">
                            <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold text-sm mr-3">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-md">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                        <a href="{{ route('users.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-md">
                            <i class="fas fa-users mr-3"></i> Users
                        </a>
                        <a href="{{ route('kategoris.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-md">
                            <i class="fas fa-tags mr-3"></i> Kategori
                        </a>
                        <a href="{{ route('barangs.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-md">
                            <i class="fas fa-box-open mr-3"></i> Barang
                        </a>
                        <a href="{{ route('peminjaman-sarana.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-md">
                            <i class="fas fa-exchange-alt mr-3"></i> Peminjaman
                        </a>
                        <div class="border-t border-gray-200 mt-2 pt-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center px-4 py-2 text-red-600 hover:bg-red-50 rounded-md">
                                    <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area flex-1 overflow-y-auto p-4 sm:p-6 bg-gray-50">
            @yield('content')
        </main>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');
        });

        // Set active menu item based on current URL
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.sidebar-item');
            
            menuItems.forEach(item => {
                const href = item.getAttribute('href');
                if (currentPath.startsWith(href)) {
                    item.classList.add('active');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>