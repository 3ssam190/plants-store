<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Plant Store') }} @yield('title')</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    
    <!-- Styles -->
    @vite(['resources/css/frontend.css', 'resources/js/frontend.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Modern Navbar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-green-600 flex items-center">
                        <i class="ri-leaf-line mr-2"></i>
                        PlantStore
                    </a>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('plants.index') }}" class="hover:text-green-600 transition">Shop</a>
                    <a href="#" class="hover:text-green-600 transition">About</a>
                    <a href="#" class="hover:text-green-600 transition">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-green-700 transition">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm hover:text-green-600 transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-green-700 transition">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Modern Footer -->
    <footer class="bg-gray-900 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Footer sections here -->
        </div>
    </footer>
</body>
</html>