<?php

namespace Evention\Elequent\Traits\Relations;

use App\Models\Product;

trait HasProducts
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}