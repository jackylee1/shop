<?php

namespace Evention\Modules\Cart;

use App\Models\Product;
use App\Models\User\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Session\SessionManager;

class Cart
{
    /**
     * @var SessionManager
     */
    protected $session;

    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * @var CartList
     */
    protected $items;

    /**
     * Cart constructor.
     *
     * @param SessionManager $session
     * @param Dispatcher $events
     */
    public function __construct(SessionManager $session, Dispatcher $events)
    {
        $this->session = $session;
        $this->events = $events;

        $items = $this->session->get(config('cart.session'));

        $this->items = $items instanceof CartList
                ? $items
                : new CartList;
    }

    /**
     * @param Product $product
     * @param int $count
     * @param User|null $user
     *
     * @return CartItem
     */
    public function add(Product $product, $count = 1, User $user = null)
    {
        if($count instanceof User) {
            $user = $count;
            $count = 1;
        }

        $user = $user ?? auth()->user();

        $cartItem = $this->createCartItem($product, $count, $user);

        if($this->items->has($cartItem)) {
            $cartItem = $this->items->get($cartItem);
            $cartItem->increment($count);
        }

        $this->items->add($cartItem);

        $this->events->dispatch('cart.added', $cartItem);

        $this->store();

        return $cartItem;
    }

    /**
     * @param CartItem $item
     *
     * @return CartItem
     */
    public function update(CartItem $item)
    {
        $this->items->update($item);

        $this->events->dispatch('cart.updated', $item);

        $this->store();

        return $item;
    }

    /**
     * @param CartItem|string $item
     *
     * @return CartItem
     */
    public function get($item)
    {
        return $this->items->get($item);
    }

    /**
     * @param CartItem|Product|string $item
     * @param User|null $user
     *
     * @return void
     *
     * @throws \Exception
     */
    public function remove($item, User $user = null)
    {
        if($item instanceof Product) {
            $key = $this->getKeyToProduct($item, $user);

            $item = $this->items->get($key);
        }

        if(is_string($item)) {
            $item = $this->items->get($item);
        }

        $item->delete();

        $this->items->remove($item);

        $this->events->dispatch('cart.removed', $item);
    }

    /**
     * @param Product|CartItem|string $item
     * @param User|null $user
     * @return bool
     */
    public function has($item, User $user = null)
    {
        if($item instanceof Product) {
            $key = $this->getKeyToProduct($item, $user);

            return $this->items->has($key);
        }

        return $this->items->has($item);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return $this->items->all();
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->items->count();
    }

    /**
     * @return float
     */
    public function price()
    {
        return $this->items->price();
    }

    /**
     * @return $this
     */
    public function store()
    {
        $this->session->put(config('cart.session'), $this->items);

        $this->items->store();

        $this->events->dispatch('cart.stored', $this->items);

        return $this;
    }

    /**
     * @param Product $product
     * @param int $count
     * @param User|null $user
     *
     * @return CartItem
     */
    public function createCartItem(Product $product, $count = 1, User $user = null)
    {
        return new CartItem($product, $count, $user);
    }

    /**
     * @param Product $product
     * @param User $user
     * @return string
     */
    protected function getKeyToProduct(Product $product, User $user = null): string
    {
        $key = $product->id;

        if (!is_null($user) || auth()->check()) {
            $user = $user ?? auth()->user();

            $key .= '_' . $user->id;
        }

        return $key;
    }
}