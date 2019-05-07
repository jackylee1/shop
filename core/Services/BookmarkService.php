<?php

namespace Evention\Services;

use App\Models\Bookmark;
use App\Models\Product;
use App\Models\User\TemporaryUser;
use App\Models\User\User;
use \Evention\Services\Facades\TemporaryUser as TemporaryUserService;

class BookmarkService extends Service
{
    /**
     * @param Product|int $product
     * @param User|TemporaryUser|bool|null $user
     * @param bool $force
     *
     * @return bool
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public static function hasBookmark($product, $user = null, $force = false)
    {
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
        $user = user();

        if(\Cache::has(self::getCacheCountBookmarksKey($user->id)) && ! $force) {
            return \Cache::get(self::getCacheCountBookmarksKey($user->id));
        }

        $count = Bookmark::byCurrentUser($user->id)
            ->isActive()
            ->count();

        \Cache::set(self::getCacheCountBookmarksKey($user->id), $count, now()->addHour());

        return $count;
    }

    /**
     * @param Product $product
     * @param User|TemporaryUser $user
     * @return mixed
     */
    public static function getBookmarkStatus(Product $product, $user)
    {
        $status = $product->bookmarks()
            ->byCurrentUser($user->id)
            ->isActive()
            ->exists();

        return $status;
    }

    /**
     * @param User $user
     *
     * @return bool
     */
    public static function changeTemporaryUser(User $user)
    {
        $temporary = TemporaryUserService::id();

        return Bookmark::where('temporary_user_id', $temporary)
            ->update([
                'user_id' => $user->id,
                'temporary_user_id' => null,
            ]);
    }

    /**
     * @param $user_id
     *
     * @return string
     */
    protected static function getCacheCountBookmarksKey($user_id)
    {
        return 'bookmarks-user-count-'. user_type() .'-'. $user_id;
    }

    /**
     * @param User|TemporaryUser|bool $user
     * @param $force
     *
     * @return array
     */
    protected static function getUser($user, $force)
    {
        if(is_bool($user)) {
            $force = $user;

            $user = user();
        } else {
            $user = $user ?? user();
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
     * @param User|TemporaryUser $user
     *
     * @return string
     */
    protected static function getCacheHasBookmarkKey(Product $product, $user)
    {
        return 'hasBookmark-user-product-'. user_type() .'-'. $user->id . '-' . $product->id;
    }

    /**
     * @param Product $product
     * @param User|TemporaryUser $user
     * @param $status
     * @return bool
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    protected static function setCacheHasBookmarkStatus(Product $product, $user, $status): bool
    {
        return \Cache::set(
            self::getCacheHasBookmarkKey($product, $user),
            $status,
            now()->addHour());
    }

    /**
     * @param Product $product
     * @param User|TemporaryUser $user
     *
     * @return bool
     */
    protected static function getCachedBookmarkStatus(Product $product, $user): bool
    {
        return (bool)\Cache::get(self::getCacheHasBookmarkKey($product, $user));
    }
}