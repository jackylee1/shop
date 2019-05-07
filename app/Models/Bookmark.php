<?php

namespace App\Models;

use Evention\Elequent\Model;
use Evention\Elequent\Traits\Relations\HasProduct;
use Evention\Elequent\Traits\Relations\HasTemporaryUser;
use Evention\Elequent\Traits\Relations\HasUser;
use Illuminate\Database\Eloquent\Builder;

class Bookmark extends Model
{
    use HasUser, HasProduct, HasTemporaryUser;

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
        //
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        //
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
        'status' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        if(is_null($this->user_id)) {
            return $this->temporary_user();
        }

        return $this->user();
    }

    /**
     * @param Builder $builder
     * @param null $user_id
     *
     * @return Builder
     */
    public function scopeByCurrentUser(Builder $builder, $user_id = null)
    {
        $user_id = $user_id ?? user()->id;

        return $builder->where(user_type() . "_id", $user_id);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeIsActive(Builder $query)
    {
        return $query->where('status', true);
    }
}
