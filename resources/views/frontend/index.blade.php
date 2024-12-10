@extends('layouts.frontend')

@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <h1>Categories</h1>
        <div class="row">
            @foreach($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-lg overflow-hidden h-100">
                        <div class="card-img-top" style="background-color: #f4f4f4; height: 200px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-box-open" style="font-size: 50px; color: #6c757d;"></i>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title text-uppercase font-weight-bold text-dark">{{ $category->name }}</h5>
                            <p class="card-text text-muted">Explore products in this category</p>
                            <a href="{{ route('category.products', $category->slug) }}" class="btn btn-primary btn-lg px-4 py-2">View Products</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
