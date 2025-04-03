@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Add New Plant</h1>
    
    <form action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('plants.partials._form_fields', [
            'plant' => new App\Models\Plant(),
            'buttonText' => 'Save Plant'
        ])
    </form>
</div>
@endsection