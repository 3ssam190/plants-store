{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app') {{-- Use regular app layout --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Your Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="ri-plant-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Your Plants</p>
                    <h3 class="text-2xl font-bold">{{ $plantCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <i class="ri-shopping-cart-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Your Orders</p>
                    <h3 class="text-2xl font-bold">{{ $orderCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('plants.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-lg text-center transition">
                <i class="ri-plant-line"></i> Browse Plants
            </a>
            <a href="#" class="bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg text-center transition">
                <i class="ri-history-line"></i> Order History
            </a>
        </div>
    </div>
</div>
@endsection