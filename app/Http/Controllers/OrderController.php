<?php

namespace App\Http\Controllers;

use Evention\Modules\Cart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $cart = Cart::all();

        $email = auth()->check() ? auth()->user()->email : null;

        return view('order.index', compact('cart', 'email'));
    }
}
