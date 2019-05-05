<?php

namespace Evention\Models;

use Evention\Elequent\Model;
use Evention\Elequent\Traits\Sluggable;
use Illuminate\Support\Str;

class Setting extends Model
{
    /**
     * Setting types
     */
    const TYPE_TEXT = 0;
    const TYPE_IMAGE = 1;
    const TYPE_NUMBER = 2;
    const TYPE_SELECT = 3;
    const TYPE_TEXTAREA = 4;
    const TYPE_SELECT_MULTI = 5;

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
        'values' => 'array',
    ];

    /**
     * @param string|null $value
     * @return void
     */
    public function setKeyAttribute($value = null)
    {
        $value = $value ?? Str::slug($this->name);

        if (static::whereKey($value)->exists()) {
            $value = "{$value}-{$this->id}";
        }

        $this->attributes['key'] = $value;
    }

    /**
     * @param bool $withNames
     *
     * @return array
     */
    public static function getPropertyTypes($withNames = false)
    {
        $list = [
            self::TYPE_TEXT => 'text',
            self::TYPE_IMAGE => 'img',
            self::TYPE_NUMBER => 'number',
            self::TYPE_SELECT => 'select',
            self::TYPE_TEXTAREA => 'textarea',
            self::TYPE_SELECT_MULTI => 'multiselect'
        ];

        if(! $withNames) {
            return array_keys($list);
        }

        return $list;
    }
}