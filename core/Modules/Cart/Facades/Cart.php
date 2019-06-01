<?php

namespace Evention\Modules\Cart\Facades;

use App\Models\Product;
use App\Models\User\User;
use Illuminate\Support\Collection;
use Evention\Modules\Cart\CartItem;
use Illuminate\Support\Facades\Facade;

/**
 * @method static CartItem add(Product $product, $count = 1, User $user = null)
 * @method static CartItem update(CartItem $item)
 * @method static CartItem get($item)
 * @method static void remove($item, User $user = null)
 * @method static Collection all()
 * @method static \Evention\Modules\Cart\Cart store()
 * @method static CartItem createCartItem(Product $product, $count = 1, User $user = null)
 * @method static int count()
 * @method static float price()
 * @method static bool has($item, User $user = null)
 *
 * @see \Evention\Modules\Cart\Cart
 */
class Cart extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
