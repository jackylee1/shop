<?php

namespace Evention\Modules\Cart;

use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Contracts\Support\Arrayable;

class CartList implements Arrayable, Jsonable
{
    /**
     * @var Collection
     */
    protected $items;

    /**
     * CartList constructor.
     *
     * @param Collection|null $items
     */
    public function __construct(Collection $items = null)
    {
        $this->items = $items ?? new Collection;
    }

    /**
     * @param CartItem $item
     *
     * @return $this
     */
    public function add(CartItem $item)
    {
        $this->items->put($item->getKey(), $item);

        return $this;
    }

    /**
     * @param CartItem|string $key
     * @param CartItem $item
     *
     * @return $this
     */
    public function update($key, CartItem $item = null)
    {
        if ($key instanceof CartItem) {
            $item = $key;
            $key = $item->getKey();
        }

        $this->items->put($key, $item);

        return $this;
    }

    /**
     * @param CartItem|string $key
     *
     * @return $this
     */
    public function remove($key)
    {
        if ($key instanceof CartItem) {
            $key = $key->getKey();
        }

        $this->items->forget($key);

        return $this;
    }

    /**
     * @param CartItem|string $key
     *
     * @return CartItem
     */
    public function get($key)
    {
        if ($key instanceof CartItem) {
            $key = $key->getKey();
        }

        return $this->items->get($key);
    }

    /**
     * @return Collection
     */
    public function all()
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
    public function price()
    {
        return $this->items->sum(function (CartItem $item) {
            return $item->price;
        });
    }

    /**
     * @return $this
     */
    public function store()
    {
        $this->items->map->store();

        return $this;
    }

    /**
     * @param string|CartItem $key
     *
     * @return bool
     */
    public function has($key)
    {
        if ($key instanceof CartItem) {
            $key = $key->getKey();
        }

        return $this->items->has($key);
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->items->isEmpty();
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
        return $this->items->toJson($options);
    }
}
