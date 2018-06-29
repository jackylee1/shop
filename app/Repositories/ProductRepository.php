<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\IProductRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function edit(Product $product, array $attributes)
    {
        return $product->fill($attributes);
    }

    public function get($id)
    {
        return $this->model->with(['category'])->find($id);
    }
}