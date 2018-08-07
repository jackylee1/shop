<?php

namespace App\Repositories\Interfaces;

use App\Models\Review;

interface IReviewRepository
{
    /**
     * @param array $attributes
     * @return Review
     */
    function create(array $attributes);

    /**
     * @param Review $review
     * @param array $attributes
     * @return Review
     */
    function edit(Review $review, array $attributes);

    /**
     * @param int $id
     * @return Review
     */
    function get($id);
}