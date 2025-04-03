<header class="bg-white shadow">
    <div class="flex justify-between items-center px-6 py-4">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h1>
        </div>
        
        <div class="flex items-center space-x-4">
            <!-- User dropdown -->
            <div class="relative">
                <button class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                    <i class="ri-arrow-down-s-line"></i>
                </button>
                
                <!-- Dropdown menu -->
                <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                            <i class="ri-logout-box-r-line mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>