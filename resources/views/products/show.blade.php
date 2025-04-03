@extends('layouts.app')

@section('title', $product->name . ' - Plants Store')

@section('content')
    <div class="product-detail">
        <h1>{{ $product->name }}</h1>
        <p>Price: ${{ $product->price }}</p>
    </div>
@endsection