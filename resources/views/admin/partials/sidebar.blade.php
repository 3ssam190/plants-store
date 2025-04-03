<div class="w-64 bg-gray-800 text-white">
    <div class="p-4 border-b border-gray-700">
        <h2 class="text-xl font-bold">PlantsStore Admin</h2>
    </div>
    <nav class="p-4 space-y-2">
        <x-admin-nav-link href="{{ route('admin.dashboard') }}" icon="ri-dashboard-line">
            Dashboard
        </x-admin-nav-link>
        
        <x-admin-nav-link href="{{ route('admin.plants.index') }}" icon="ri-plant-line">
            Plants
        </x-admin-nav-link>
        
        <x-admin-nav-link href="{{ route('admin.users.index') }}" icon="ri-user-line">
            Users
        </x-admin-nav-link>
        
        <x-admin-nav-link href="#" icon="ri-shopping-cart-line">
            Orders
        </x-admin-nav-link>
        
        <div class="pt-4 border-t border-gray-700 mt-4">
            <x-admin-nav-link href="#" icon="ri-settings-line">
                Settings
            </x-admin-nav-link>
        </div>
    </nav>
</div>