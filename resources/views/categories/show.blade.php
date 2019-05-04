@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('components._breadcrumb', ['data' => $category])
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">{{ $category->title }}</div>
                </div>

                <div class="row mt-4">
                    @foreach($category->products as $product)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm product-item">
                                <div class="product-controls">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-heart"></i></button>
                                        <button type="button" class="btn btn-sm btn-light"><i class="fas fa-balance-scale"></i></button>
                                    </div>
                                </div>
                                @if($product->cover)
                                    <img src="{{ asset($product->cover) }}" alt="{{ $product->title }}" class="bg-placeholder-img card-img-top">
                                @endif
                                <div class="card-body">
                                    <a href="{{ route('products.show', $product) }}" class="card-link">
                                        {{ $product->title }}
                                    </a>
                                    <small class="text-muted">
                                        {{ $category->title }}
                                    </small>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">

                                    <span class="price">
                                        <b>{{ price($product->price) }}</b> $
                                    </span>

                                        <button type="button" class="btn btn-sm btn-success">
                                            <i class="fas fa-shopping-cart"></i> <span class="buy-text">Купить</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($category->children as $child)
                                <a href="{{ route('categories.show', $child) }}" class="list-group-item">{{ $child->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection