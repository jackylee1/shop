<?php

namespace Evention\Services\Cart;

use App\Models\Product;
use App\Models\User\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class CartItem implements Arrayable, Jsonable
{
    /**
     * @var Product
     */
    public $product;

    /**
     * @var int
     */
    public $count = 1;

    /**
     * @var User
     */
    public $user = null;

    /**
     * CartItem constructor.
     *
     * @param Product $product
     * @param int $count
     * @param User|null $user
     */
    public function __construct(Product $product, $count = 1, User $user = null)
    {
        $this->product = $product;
        $this->count = $count;
        $this->user = $user;
    }

    /**
     * @param \Evention\Models\CartItem $model
     *
     * @return CartItem
     */
    public static function fromModel(\Evention\Models\CartItem $model)
    {
        return new self($model->product, $model->count, $model->user);
    }

    /**
     * @param array $attributes
     *
     * @return bool|CartItem
     */
    public static function fromArray(array $attributes)
    {
        $product = Product::find($attributes['product_id']);

        if(! $product) {
            return false;
        }

        return new self($product, $attributes['count'] ?? 1, $attributes['user'] ?? null);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'product_id' => $this->product->id,
            'count' => $this->count,
            'user' => $this->user,
        ];
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }
}