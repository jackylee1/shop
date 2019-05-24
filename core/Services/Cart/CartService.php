<?php

namespace Evention\Services\Cart;

use App\Models\Product;
use App\Models\User\User;
use Evention\Services\Service;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Session\SessionManager;
use Evention\Services\Cart\CartItem;

class CartService extends Service
{
    /**
     * Instance of the session manager.
     *
     * @var \Illuminate\Session\SessionManager
     */
    private $session;

    /**
     * Instance of the event dispatcher.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    private $events;

    /**
     * @var CartItemCollection
     */
    private $items;

    /**
     * @var \Evention\Models\CartItem
     */
    private $model;

    /**
     * Cart constructor.
     *
     * @param \Illuminate\Session\SessionManager $session
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     * @param CartItemCollection|null $items
     */
    public function __construct(SessionManager $session, Dispatcher $events, CartItemCollection $items = null)
    {
        $this->session = $session;

        $this->events = $events;

        $this->items = $items ?? CartItemCollection::fromSession($session);

        $this->model = app(config('cart.cartItem'));
    }

    /**
     * Add an item to the cart.
     *
     * @param Product $product
     * @param int $count
     * @param User|null $user
     *
     * @return CartItem
     */
    public function add($product, $count = 1, User $user = null)
    {
        if($count instanceof User) {
            $count = 1;
            $user = $count;
        }

        $user = $user ?? auth()->user();

        $cartItem = $this->items->add($product, $count, $user);

        $this->events->fire('cart.added', $cartItem);

        return $cartItem;
    }

    /**
     * Update an item on the cart
     *
     * @param Product $product
     * @param int $count
     * @param User|null $user
     *
     * @return CartItem
     */
    public function update($product, $count, User $user = null)
    {
        if($count instanceof User) {
            $count = 1;
            $user = $count;
        }

        $user = $user ?? auth()->user();

        $cartItem = $this->items->update($product, $count, $user);

        $this->events->fire('cart.added', $cartItem);

        return $cartItem;
    }

    /**
     * Remove an item from the cart
     *
     * @param Product $product
     * @param User|null $user
     *
     * @return void
     */
    public function remove($product, User $user = null)
    {
        $user = $user ?? auth()->user();

        $cartItem = $this->items->remove($product, $user);

        $this->events->fire('cart.removed', $cartItem);
    }

    /**
     * @return bool
     */
    public function store()
    {
        if(auth()->guest())
            return false;

        foreach ($this->items as $item) {
            $this->model->updateOrCreate([
                'product_id' => $item->product->id,
                'user_id' => $item->user->id
            ], [
                'count' => $item->count
            ]);
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return $this->items->count();
    }

    /**
     * @return mixed
     */
    public function sum()
    {
        return $this->items->sum();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function get()
    {
        return $this->items->get();
    }
}