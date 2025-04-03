@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Plants Collection</h1>
        <a href="{{ route('plants.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add New Plant
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('plants.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" 
                           name="search" 
                           class="form-control" 
                           placeholder="Search plants by name..." 
                           value="{{ request('search') }}"
                           aria-label="Search plants">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('plants.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Clear
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Environment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plants as $plant)
                <tr>
                    <td style="width: 100px">
                        @if($plant->image_path)
                            <img src="{{ asset('storage/' . $plant->image_path) }}" 
                                 alt="{{ $plant->name }}" 
                                 class="img-thumbnail"
                                 style="width: 80px; height: 80px; object-fit: cover">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" 
                                 style="width: 80px; height: 80px">
                                <i class="bi bi-image text-muted" style="font-size: 1.5rem"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $plant->name }}</td>
                    <td>
                        <span class="badge 
                            @if($plant->type === 'flower') bg-success
                            @elseif($plant->type === 'succulent') bg-warning text-dark
                            @else bg-info
                            @endif">
                            {{ ucfirst($plant->type) }}
                        </span>
                    </td>
                    <td>${{ number_format($plant->price, 2) }}</td>
                    <td>
                        <i class="bi 
                            @if($plant->environment === 'indoor') bi-house-door
                            @else bi-sun
                            @endif">
                        </i>
                        {{ ucfirst($plant->environment) }}
                    </td>
                    <td style="width: 150px">
                        <div class="d-flex gap-2">
                            <a href="{{ route('plants.show', $plant) }}" 
                               class="btn btn-sm btn-outline-primary"
                               title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('plants.edit', $plant) }}" 
                               class="btn btn-sm btn-outline-secondary"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('plants.destroy', $plant) }}" method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-outline-danger"
                                        title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this plant?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        @if(request('search'))
                            No plants found matching your search.
                            <a href="{{ route('plants.index') }}" class="d-block mt-2">
                                Clear search and view all plants
                            </a>
                        @else
                            No plants available yet. 
                            <a href="{{ route('plants.create') }}" class="d-block mt-2">
                                Add your first plant
                            </a>
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($plants->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $plants->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection