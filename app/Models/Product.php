<?php

namespace App\Models;

use App\Models\User\User;
use Evention\Elequent\Model;
use App\Models\User\TemporaryUser;
use Illuminate\Support\Facades\Cache;
use App\Models\Pivots\ProductProperty;
use Evention\Services\BookmarkService;
use Evention\Elequent\Traits\Sluggable;
use Evention\Modules\Cart\Facades\Cart;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Sluggable;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

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
        'cover',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'category',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)
            ->notChild()
            ->published();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(Property::class)
            ->using(ProductProperty::class)
            ->withPivot('value');
    }

    /**
     * @return Image
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getCoverAttribute()
    {
        if (Cache::has($this->getCoverCacheKey())) {
            return Cache::get($this->getCoverCacheKey());
        }

        $cover = $this->images()->getQuery()->isCover()->value('path');

        Cache::set($this->getCoverCacheKey(), $cover, now()->addHour());

        return $cover;
    }

    /**
     * @return string
     */
    public function getCoverCacheKey()
    {
        return 'product-cover-'.$this->id;
    }

    /**
     * @param User|TemporaryUser|null|bool $user
     * @param bool $force
     *
     * @return bool
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function hasBookmark($user = null, $force = false)
    {
        return BookmarkService::hasBookmark($this, $user, $force);
    }

    /**
     * @param User|null $user
     *
     * @return bool
     */
    public function inCart($user = null)
    {
        return Cart::has($this);
    }
}
