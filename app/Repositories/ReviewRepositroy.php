<?php

namespace App\Repositories;

use App\Models\Review;
use App\Repositories\Interfaces\IReviewRepository;

class ReviewRepositroy extends BaseRepository implements IReviewRepository
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function edit(Review $product, array $attributes)
    {
        return $product->fill($attributes);
    }

    public function get($id)
    {
        return $this->model->with(['product'])->find($id);
    }
}