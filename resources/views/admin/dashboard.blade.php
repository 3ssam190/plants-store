@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Stats Cards -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                    <i class="ri-plant-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Total Plants</p>
                    <h3 class="text-2xl font-bold">{{ $plantCount }}</h3>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                    <i class="ri-user-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Total Users</p>
                    <h3 class="text-2xl font-bold">{{ $userCount }}</h3>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                    <i class="ri-shopping-cart-line text-2xl"></i>
                </div>
                <div>
                    <p class="text-gray-500">Total Orders</p>
                    <h3 class="text-2xl font-bold">{{ $orderCount }}</h3>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Recent Activity</h2>
        <div class="space-y-4">
            @foreach($recentActivities as $activity)
            <div class="border-b pb-4 last:border-0 last:pb-0">
                <p class="text-gray-600">{{ $activity->description }}</p>
                <p class="text-sm text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.plants.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-3 px-4 rounded-lg text-center transition">
                <i class="ri-add-line"></i> Add Plant
            </a>
            <a href="{{ route('admin.users.index') }}" class="bg-green-500 hover:bg-green-600 text-white py-3 px-4 rounded-lg text-center transition">
                <i class="ri-user-line"></i> Manage Users
            </a>
            <a href="#" class="bg-purple-500 hover:bg-purple-600 text-white py-3 px-4 rounded-lg text-center transition">
                <i class="ri-settings-line"></i> Settings
            </a>
            <a href="#" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-4 rounded-lg text-center transition">
                <i class="ri-line-chart-line"></i> Reports
            </a>
        </div>
    </div>
</div>
@endsection