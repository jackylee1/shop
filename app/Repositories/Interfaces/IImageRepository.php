<?php

namespace App\Repositories\Interfaces;

use App\Models\Image;

interface IImageRepository
{
    /**
     * @param array $attributes
     * @return Image
     */
    function create(array $attributes);

    /**
     * @param Image $image
     * @param array $attributes
     * @return Image
     */
    function edit(Image $image, array $attributes);

    /**
     * @param int $id
     * @return Image
     */
    function get($id);
}