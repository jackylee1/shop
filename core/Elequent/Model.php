<?php

namespace Evention\Elequent;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    /**
     * Delete the first record matching the attributes or create it
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function deleteOrCreate(array $attributes, array $values = [])
    {
        if (! is_null($instance = $this->where($attributes)->first())) {
            return $instance->delete();
        }

        return tap($this->newModelInstance($attributes + $values), function ($instance) {
            $instance->save();
        });
    }
}