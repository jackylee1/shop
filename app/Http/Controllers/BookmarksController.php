<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Category;
use Illuminate\Http\Request;
use Evention\Services\BookmarkService;

class BookmarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Bookmark $bookmark
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Bookmark $bookmark, Category $category)
    {
        $bookmarks = $bookmark->byCurrentUser()
            ->isActive()
            ->with('product')
            ->paginate(setting('paginate_count', 20));

        $categories = $category->all();

        return view('bookmarks.index', compact('bookmarks', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Bookmark $bookmark
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function store(Request $request, Bookmark $bookmark)
    {
        $data = $this->validate($request, [
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $bookmark->toggleOrCreate([
            'product_id' => $data['product_id'],
            user_type().'_id' => user()->id,
        ]);

        BookmarkService::hasBookmark($data['product_id'], true);

        return response([
            'status' => 'success',
            'bookmarks' => BookmarkService::getCountBookmarks(true),
        ], 200);
    }
}
