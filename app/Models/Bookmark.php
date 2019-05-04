<?php

namespace App\Models;

use Evention\Elequent\Model;
use Evention\Elequent\Traits\Relations\HasProduct;
use Evention\Elequent\Traits\Relations\HasTemporaryUser;
use Evention\Elequent\Traits\Relations\HasUser;

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
        //
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
}
