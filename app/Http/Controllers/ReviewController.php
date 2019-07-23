<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyReviewRequest;
use App\Models\Product;

class ReviewController extends Controller
{
    /**
     * @param Product $product
     * @param ReplyReviewRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Product $product, ReplyReviewRequest $request)
    {
        $product->reviews()->create([
            'user_name' => $request->get('name'),
            'text' => $request->get('message'),
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Review successfully added');
    }
}
