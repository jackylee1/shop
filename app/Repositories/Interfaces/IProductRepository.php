<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;

interface IProductRepository
{
    /**
     * @param array $attributes
     * @return Product
     */
    function create(array $attributes);

    /**
     * @param Product $product
     * @param array $attributes
     * @return Product
     */
    function edit(Product $product, array $attributes);

    /**
     * @param int $id
     * @return Product
     */
    function get($id);
}