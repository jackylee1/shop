<?php

namespace Evention\Modules\Cart;

use App\Models\Product;
use App\Models\User\User;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

/**
 * @property float $price
 * @property string $key
 */
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
     * @var \Evention\Models\CartItem|null
     */
    public $model = null;

    /**
     * @var User|null
     */
    protected $user = null;

    /**
     * CartItem constructor.
     *
     * @param Product $product
     * @param int $count
     * @param User|null $user
     */
    public function __construct(Product $product, $count = 1, User $user = null)
    {
        if ($count instanceof User) {
            $count = 1;
            $user = $count;
        }

        $this->product = $product;
        $this->count = $count ?? 1;
        $this->user = $user ?? auth()->user();

        if (! is_null($this->user)) {
            $this->model = $this->getModel();
        }

        $this->store();
    }

    /**
     * @param array $attributes
     *
     * @return bool|CartItem
     */
    public static function fromArray(array $attributes)
    {
        $product = Product::find($attributes['product_id']);

        if (! $product) {
            return false;
        }

        if (isset($attributes['user_id'])) {
            $user = User::find($attributes['user_id']);
        } else {
            if (auth()->check()) {
                $user = auth()->user();
            }
        }

        return new self($product, $attributes['count'] ?? 1, $user ?? null);
    }

    /**
     * @param \Evention\Models\CartItem $cartItem
     *
     * @return CartItem
     */
    public static function fromModel(\Evention\Models\CartItem $cartItem)
    {
        return new self($cartItem->product, $cartItem->count, $cartItem->user);
    }

    /**
     * @param int $count
     *
     * @return CartItem
     */
    public function increment($count = 1)
    {
        $this->count += $count;

        $this->store();

        return $this;
    }

    /**
     * @param int $count
     *
     * @return CartItem
     */
    public function decrement($count = 1)
    {
        $this->count -= $count;

        $this->store();

        return $this;
    }

    /**
     * @return float
     */
    public function price()
    {
        return $this->product->price * $this->count;
    }

    /**
     * @return bool
     *
     * @throws \Exception
     */
    public function delete()
    {
        if (! is_null($this->model)) {
            return $this->model->delete();
        }

        return true;
    }

    /**
     * Store CartItem to model (\Evention\Models\CartItem).
     *
     * @return bool
     */
    public function store()
    {
        if (! is_null($this->model)) {
            return $this->model->update([
                'count' => $this->count,
            ]);
        }

        return false;
    }

    /**
     * @return \Evention\Models\CartItem
     */
    public function getModel()
    {
        return app(config('cart.model'))->firstOrCreate([
            'product_id' => $this->product->id,
            'user_id' => $this->user->id,
        ], [
            'count' => $this->count,
        ]);
    }

    /**
     * Get item unique key.
     *
     * @return mixed|string
     */
    public function getKey()
    {
        if (is_null($this->user)) {
            return $this->product->id;
        }

        return $this->product->id.'_'.$this->user->id;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if ($name == 'key') {
            return $this->getKey();
        }

        if ($name == 'price') {
            return $this->price();
        }
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = [
            'product_id' => $this->product->id,
            'product' => $this->product,
            'count' => $this->count,
            'price' => $this->price,
            'key' => $this->key,
        ];

        if (! is_null($this->user)) {
            $attributes['user_id'] = $this->user->id;
            $attributes['user'] = $this->user;
        }

        return $attributes;
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
