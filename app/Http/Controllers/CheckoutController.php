<?php

namespace App\Http\Controllers;

use Evention\Modules\Cart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckoutController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $cart = Cart::all();

        $user = optional(auth()->user());

        $price = Cart::price();

        return view('checkout.index', compact('cart', 'user', 'price'));
    }
}
