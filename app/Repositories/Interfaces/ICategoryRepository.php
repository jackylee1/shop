<?php

namespace App\Repositories\Interfaces;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface ICategoryRepository
{
    /**
     * @param array $attributes
     * @return Category
     */
    function create(array $attributes);

    /**
     * @param Category $category
     * @param array $attributes
     * @return Category
     */
    function edit(Category $category, array $attributes);

    /**
     * @param int $id
     * @return Category
     */
    function get($id);

    /**
     * @return Collection
     */
    function getAll();

    /**
     * @param int $id
     * @return Collection
     */
    function getWithChildren($id);
}