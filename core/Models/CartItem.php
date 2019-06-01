<?php

namespace Evention\Models;

use App\Models\Product;
use App\Models\User\User;
use Evention\Elequent\Model;
use Illuminate\Database\Eloquent\Builder;
use Evention\Elequent\Traits\Relations\HasUser;
use Evention\Elequent\Traits\Relations\HasProduct;

class CartItem extends Model
{
    use HasProduct,
        HasUser;

    /** The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * Guarded attributes.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
    ];

    /**
     * Date casts.
     *
     * @var array
     */
    protected $dates = [
        'updated_at',
        'created_at',
    ];

    /**
     * Appends to JSON.
     *
     * @var array
     */
    protected $appends = [
        //
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        //
    ];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * @param Builder $query
     * @param User $user
     *
     * @return Builder
     */
    public function scopeWhereUser(Builder $query, User $user = null)
    {
        $user = $user ?? user();

        return $query->where('user_id', $user->id);
    }

    /**
     * @param Builder $query
     * @param Product $product
     *
     * @return Builder
     */
    public function scopeWhereProduct(Builder $query, Product $product)
    {
        return $query->where('product_id', $product->id);
    }
}
