@extends('layouts.app')

@section('content')
    <div class="container product-info">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>{{ $product->title }}</h1>
                    <div class="text-right">
                        <a href="#" class="btn btn-sm btn-secondary"><i class="fa fa-share"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-8 left-side border-right pb-3">
                <div id="productCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item text-center active">
                            <div class="zoom">
                                <img class="img-fluid" src="{{ asset('images/product_example.jpg') }}" alt="{{ $product->title }}">
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <ol class="carousel-indicators">
                        <li data-target="#productCarousel" data-slide-to="0" class="active">
                            <img src="{{  asset('images/product_example.jpg') }}" alt="" class="carousel-preview">
                        </li>
                    </ol>
                </div>
            </div>
            <div class="col-md-4 right-side">
                <div class="price">
                    <span>
                        {{ price($product->price) }}
                        <small class="currency">$</small>
                        @if($product->old_price)
                        <s class="oldprice badge badge-danger">
                            {{ price($product->old_price) }}
                            <small class="currency">$</small>
                        </s>
                        @endif
                    </span>
                </div>

                <div class="btn-group-vertical w-100">
                    <a href="#" class="btn btn-success d-flex justify-content-center align-items-baseline">
                        <i class="fa fa-shopping-bag mr-2"></i> <span>Add to cart</span>
                    </a>
                    <a href="#" class="btn btn-secondary d-flex justify-content-center align-items-baseline">
                        <i class="fa fa-shopping-cart mr-2"></i> <span>Buy now</span>
                    </a>
                </div>

                <ul class="nav flex-column mt-4 nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Informationе</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reviews</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-8 border-top pt-2 pb-2 border-right">
                {{ $product->description }}
            </div>

            <div class="col-md-8 border-top pt-4 border-right reviews">
                @foreach($product->reviews as $review)
                    @include('reivews._review')
                @endforeach
            </div>
        </div>
    </div>
@endsection