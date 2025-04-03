@extends('admin.layouts.app')

@section('title', 'Manage Plants')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Plants</h3>
        <div class="card-actions">
            <a href="{{ route('admin.plants.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Plant
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plants as $plant)
                <tr>
                    <td>{{ $plant->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" width="50">
                    </td>
                    <td>{{ $plant->name }}</td>
                    <td>${{ number_format($plant->price, 2) }}</td>
                    <td>{{ $plant->stock }}</td>
                    <td>
                        <a href="{{ route('admin.plants.edit', $plant->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a>
                        <!-- Delete form would go here -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection