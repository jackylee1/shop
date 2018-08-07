<?php

namespace App\Repositories;

use App\Models\Image;
use App\Repositories\Interfaces\IImageRepository;

class ImageRepository extends BaseRepository implements IImageRepository
{
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function edit(Image $product, array $attributes)
    {
        return $product->fill($attributes);
    }

    public function get($id)
    {
        return $this->model->with(['product'])->find($id);
    }
}