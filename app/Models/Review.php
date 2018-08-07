<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var array
     */
    protected $fillable = [

    ];

    public function parent()
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Review::class, 'parent_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
