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
        $review = $product->reviews()->create([
            'parent_id' => $request->get('parent_id'),
            'user_name' => $request->get('name'),
            'text' => $request->get('message'),
            'user_id' => auth()->id(),
        ]);

        return redirect(route('products.show', $product) . '#review-' . $review->id)
            ->with('success', 'Review successfully added');
    }
}
