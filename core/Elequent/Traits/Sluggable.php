<?php

namespace Evention\Elequent\Traits;

use Illuminate\Support\Str;

trait Sluggable
{
    /**
     * Slug field.
     *
     * @var string
     */
    protected $slugField = 'slug';

    /**
     * Model title field.
     *
     * @var string
     */
    protected $titleField = 'title';

    /**
     * @return mixed|string
     */
    public function getRouteKeyName()
    {
        return $this->slugField;
    }

    /**
     * @return string
     */
    public function getTitleFieldName()
    {
        return $this->titleField;
    }

    /**
     * @return mixed
     */
    public function getTitleField()
    {
        return $this->getAttribute($this->titleField);
    }

    /**
     * Boot the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSluggable()
    {
        static::created(function ($model) {
            $model->update([$model->getRouteKeyName() => $model->getTitleField()]);
        });
    }

    /**
     * @param $value
     */
    public function setSlugAttribute($value)
    {
        if ($this->where($this->slugField, ($slug = Str::slug($value)))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes[$this->slugField] = $slug;
    }
}
