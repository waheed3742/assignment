@extends('layouts.frontend')

@section('content')
<div class="nk-content">
    <div class="container-fluid my-5">
        <h1 class="text-center mb-4">{{ $category->name }} Products</h1>

        <p class="text-center text-muted">Explore the products in this category.</p>

        <div class="row">
            @foreach($category->products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-lg overflow-hidden h-100">
                        <div class="card-img-top" style="background-image: url('{{ asset('storage/'.$product->images->first()->image_path ?? 'default-image.jpg') }}'); background-size: cover; height: 200px;">
                        </div>
                        
                        <div class="card-body text-center">
                            <h5 class="card-title font-weight-bold text-dark">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ $product->description }}</p>
                            <h6 class="text-primary">${{ number_format($product->price, 2) }}</h6>
                            <a href="{{ route('product.details', $product->slug) }}" class="btn btn-primary btn-lg px-4 py-2">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
