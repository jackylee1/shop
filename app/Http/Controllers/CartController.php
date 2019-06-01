<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Evention\Modules\Cart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Category $category
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Category $category)
    {
        if($request->wantsJson()) {
            return [
                'items' => Cart::all(),
                'count' => Cart::count(),
            ];
        }

        $cart = Cart::all();

        $categories = $category->all();

        $total = Cart::price();

        return view('cart.index', compact('cart', 'categories', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'product_id' => ['required', 'exists:products,id'],
        ]);

        Cart::add(Product::find($data['product_id']));

        return response([
            'status' => 'success',
            'count' => Cart::count()
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type)
    {
        if(! in_array($type, ['increment', 'decrement'])) {
            return abort(403);
        }

        if($item = Cart::get($id)) {
            Cart::update(call_user_func([$item, $type]));
            Cart::store();
        }

        return response([
            'status' => 'success',
            'count' => Cart::count(),
            'item_count' => $item->count
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $key
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        Cart::remove($key);

        return response([
            'count' => Cart::count(),
            'total' => price(Cart::price()),
        ], 200);
    }
}
