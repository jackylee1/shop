<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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
        'category_id',
        'name',
        'url',
        'image_url',
        'status',
        'price',
        'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "created_at",
        "deleted_at",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class)->with(['parent']);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->with(['children', 'user']);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
