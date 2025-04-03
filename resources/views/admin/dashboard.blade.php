@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard-cards">
    <div class="card">
        <div class="card-icon bg-green">
            <i class="fas fa-seedling"></i>
        </div>
        <div class="card-info">
            <h3>{{ $stats['plants'] }}</h3>
            <p>Total Plants</p>
        </div>
    </div>
    
    <div class="card">
        <div class="card-icon bg-blue">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <div class="card-info">
            <h3>{{ $stats['orders'] }}</h3>
            <p>Completed Orders</p>
        </div>
    </div>
    
    <div class="card">
        <div class="card-icon bg-orange">
            <i class="fas fa-users"></i>
        </div>
        <div class="card-info">
            <h3>{{ $stats['users'] }}</h3>
            <p>Registered Users</p>
        </div>
    </div>
    
    <div class="card">
        <div class="card-icon bg-purple">
            <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-info">
            <h3>${{ number_format($stats['revenue'], 2) }}</h3>
            <p>Total Revenue</p>
        </div>
    </div>
</div>

<div class="recent-orders mt-4">
    <h2>Recent Orders</h2>
    <!-- Order table would go here -->
</div>
@endsection