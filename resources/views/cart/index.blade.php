@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('components._breadcrumb')
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="row">
                    @foreach($cart as $item)
                        @include('cart._item')
                    @endforeach

                    <div class="col-12 text-center list-empty @if(! $cart->isEmpty()) d-none @endif">
                        <div class="alert alert-info">Your shopping cart is empty</div>
                    </div>

                    <div class="col-12">
                        <div class="row border-top pt-3 align-items-center">
                            <div class="col">
                                <p>
                                    Total: <b class="cart-total-price">{{ price($total) }}$</b>
                                </p>
                            </div>
                            <div class="col text-right">
                                <button class="btn btn-success">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category) }}" class="list-group-item">{{ $category->title }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection