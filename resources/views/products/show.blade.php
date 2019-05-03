@extends('layouts.app')

@section('content')
    <div class="container product-info">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>{{ $product->name }}</h1>
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
                                <img class="img-fluid" src="{{ asset('images/product_example.jpg') }}" alt="{{ $product->name }}">
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
                        <small class="currency">грн.</small>
                        <s class="oldprice badge badge-danger">
                            20 999
                            <small class="currency">грн.</small>
                        </s>
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
                <div class="review">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                Maxim Rebitskiy
                            </div>
                            <p class="card-text">3 minutes ago</p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Good Product!</p>
                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                            <div class="review-controls">
                                <a href="#" class="btn btn-sm btn-link"><i class="fas fa-reply"></i> Reply</a>
                            </div>
                            <div class="review-rating">
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-thumbs-up"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fas fa-thumbs-down"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="review-reply">
                        <div class="card ml-5 mb-4">
                            <div class="card-header">
                                Moderator
                            </div>
                            <div class="card-body">
                                <p class="card-text">Good comment</p>
                            </div>
                            <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                                <div class="review-controls">
                                    <a href="#" class="btn btn-sm btn-link"><i class="fas fa-reply"></i> Reply</a>
                                </div>
                                <div class="review-rating">
                                    <a href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-thumbs-up"></i></a>
                                    <a href="#" class="btn btn-sm btn-outline-secondary"><i class="fas fa-thumbs-down"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection