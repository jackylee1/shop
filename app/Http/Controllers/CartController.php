<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Evention\Modules\Cart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->wantsJson()) {
            return [
                'items' => Cart::all(),
                'count' => Cart::count(),
            ];
        }

        dd(Cart::all());
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function increment($id)
    {
        $item = Cart::get($id);

        if($item) {
            Cart::update($item->increment());
            Cart::store();
        }

        return response([
            'status' => 'success',
            'count' => Cart::count()
        ], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function decrement($id)
    {
        $item = Cart::get($id);

        if($item) {
            Cart::update($item->decrement());
            Cart::store();
        }

        return response([
            'status' => 'success',
            'count' => Cart::count()
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($key)
    {
        Cart::remove($key);
    }
}
