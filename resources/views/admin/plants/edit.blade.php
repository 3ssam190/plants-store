@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Plant</h1>
    
    <form action="{{ route('plants.update', $plant) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('plants.partials._form_fields', [
            'plant' => $plant,
            'buttonText' => 'Update Plant'
        ])
    </form>
</div>
@endsection