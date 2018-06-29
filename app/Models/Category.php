<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
        'parent_id',
        'name',
        'url',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parentWithProducts()
    {
        return $this->belongsTo(Category::class, 'parent_id')->with('products');
    }

    public function childrenWithProducts()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('products');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
