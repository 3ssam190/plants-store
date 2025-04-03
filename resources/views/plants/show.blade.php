@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>{{ $plant->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Type:</strong> {{ ucfirst($plant->type) }}</p>
            <p><strong>Price:</strong> ${{ number_format($plant->price, 2) }}</p>
            <p><strong>Environment:</strong> {{ ucfirst($plant->environment) }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('plants.edit', $plant) }}" class="btn btn-warning">
                Edit
            </a>
            <form action="{{ route('plants.destroy', $plant) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" 
                    onclick="return confirm('Delete this plant permanently?')">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection