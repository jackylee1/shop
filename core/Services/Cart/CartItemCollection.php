<?php

namespace Evention\Services\Cart;

use App\Models\Product;
use App\Models\User\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;

class CartItemCollection implements Arrayable, Jsonable
{
    /**
     * @var Collection
     */
    protected $items;

    /**
     * CartItemCollection constructor.
     *
     * @param Collection $items
     */
    public function __construct(Collection $items)
    {
        $this->items = $items ?? new Collection;
    }

    /**
     * @param SessionManager $session
     *
     * @return CartItemCollection
     */
    public static function fromSession(SessionManager $session)
    {
        return new self($session->get(config('cart.session')));
    }

    /**
     * @param array $items
     *
     * @return CartItemCollection
     */
    public static function fromArray(array $items)
    {
        return new self(new Collection($items));
    }

    /**
     * @param \Evention\Models\CartItem $model
     * @param User $user
     *
     * @return CartItemCollection
     */
    public static function fromDB(\Evention\Models\CartItem $model, User $user)
    {
        return new self($model->whereUser($user)->get());
    }

    /**
     * Add an item to the cart.
     *
     * @param $product
     * @param int $count
     * @param User|null $user
     *
     * @return CartItem
     */
    public function add($product, $count = 1, User $user = null)
    {
        $cartItem = $this->createCartItem($product, $count, $user);

        $this->items->add($cartItem);

        return $cartItem;
    }

    /**
     * Add an item to the cart.
     *
     * @param $product
     * @param int $count
     * @param User|null $user
     *
     * @return CartItem
     */
    public function update($product, $count = 1, User $user = null)
    {
        $cartItem = $this->createCartItem($product, $count, $user);

        $this->items->add($cartItem);

        return $cartItem;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function get()
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->items->sum(function (CartItem $item) {
            return $item->count;
        });
    }

    /**
     * @return float
     */
    public function sum()
    {
        return $this->items->sum(function (CartItem $item) {
            return $item->product->price;
        });
    }

    /**
     * @param $product
     * @param $count
     * @param User|null $user
     *
     * @return mixed
     */
    protected function createCartItem($product, $count, User $user = null)
    {
        $attributes = [
            'product_id' => $product->id,
            'count' => $count ?? 1,
        ];

        if(! is_null($user)) {
            $attributes['user_id'] = $user->id;

            $item = $this->model->firstOrCreate($attributes);
            $item = CartItem::fromModel($item);
        } else {
            $item = CartItem::fromArray($attributes);
        }

        return $item;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->items->toArray();
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