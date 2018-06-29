<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\ICategoryRepository;
use App\Repositories\Interfaces\IProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function edit(Category $category, array $attributes)
    {
        return $category->fill($attributes);
    }

    public function get($id)
    {
        return $this->model->find($id);
    }

    public function getWithChildren($id)
    {
        return $this->model->with(['children'])->find($id);
    }

    public function getAll()
    {
        return $this->model->with(['children'])->get();
    }

    public function getProducts($id, IProductRepository $productRepository)
    {
        return $this->model->with(['childrenWithProducts', 'products'])->find($id);
    }
}