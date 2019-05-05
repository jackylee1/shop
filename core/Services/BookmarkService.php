<?php

namespace Evention\Services;

use App\Models\Bookmark;
use App\Models\Product;
use App\Models\User\User;

class BookmarkService extends Service
{
    /**
     * @param Product|int $product
     * @param User|bool|null $user
     * @param bool $force
     *
     * @return bool
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function hasBookmark($product, $user = null, $force = false)
    {
        // TODO
        if(auth()->guest()) {
            return false;
        }

        [$user, $force] = self::getUser($user, $force);

        $product = self::getProduct($product);

        if(\Cache::has(self::getCacheHasBookmarkKey($product, $user)) && ! $force) {
            return self::getCachedBookmarkStatus($product, $user);
        }

        $status = self::getBookmarkStatus($product, $user);

        self::setCacheHasBookmarkStatus($product, $user, $status);

        return $status;
    }

    /**
     * @param bool $force
     *
     * @return integer
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function getCountBookmarks($force = false)
    {
        // TODO
        if(auth()->guest()) {
            return 0;
        }

        $user = auth()->user();

        if(\Cache::has(self::getCacheCountBookmarksKey($user->id)) && ! $force) {
            return \Cache::get(self::getCacheCountBookmarksKey($user->id));
        }

        $count = Bookmark::where('user_id', $user->id)
            ->isActive()
            ->count();

        \Cache::set(self::getCacheCountBookmarksKey($user->id), $count, now()->addHour());

        return $count;
    }

    /**
     * @param $user_id
     *
     * @return string
     */
    protected static function getCacheCountBookmarksKey($user_id)
    {
        return 'bookmarks-user-count-' . $user_id;
    }

    /**
     * @param User|bool $user
     * @param $force
     *
     * @return array
     */
    protected static function getUser($user, $force)
    {
        if(is_bool($user)) {
            $force = $user;

            $user = auth()->user();
        } else {
            $user = $user ?? auth()->user();
        }

        return [$user, $force];
    }

    /**
     * @param Product|mixed $product
     *
     * @return Product
     */
    protected static function getProduct($product)
    {
        return is_a($product, Product::class)
            ? $product
            : Product::find($product);
    }

    /**
     * @param Product $product
     * @param User $user
     *
     * @return string
     */
    protected static function getCacheHasBookmarkKey(Product $product, User $user)
    {
        return 'hasBookmark-user-product-'. $user->id . '-' . $product->id;
    }

    /**
     * @param Product $product
     * @param User $user
     * @param $status
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected static function setCacheHasBookmarkStatus(Product $product, User $user, $status): bool
    {
        return \Cache::set(
            self::getCacheHasBookmarkKey($product, $user),
            $status,
            now()->addHour());
    }

    /**
     * @param Product $product
     * @param User $user
     * @return mixed
     */
    public static function getBookmarkStatus(Product $product, User $user)
    {
        $status = $product->bookmarks()
            ->where('user_id', $user->id)
            ->isActive()
            ->exists();
        return $status;
    }

    /**
     * @param Product $product
     * @param User $user
     *
     * @return bool
     */
    protected static function getCachedBookmarkStatus(Product $product, User $user): bool
    {
        return (bool)\Cache::get(self::getCacheHasBookmarkKey($product, $user));
    }
}