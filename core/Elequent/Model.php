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

    /**
     * Toggle fields of the first record matching the attributes or create it
     *
     * @param array $attributes
     * @param array $values
     * @param array|string $fields
     *
     * @return mixed
     */
    public function toggleOrCreate(array $attributes, $values = [], $fields = ['status'])
    {
        $fields = is_array($fields) ? $fields : [$fields];

        if (! is_null($instance = $this->where($attributes)->first())) {
            $values = [];

            foreach ($fields as $field) {
                $values[$field] = ! ((boolean) $instance->$field);
            }

            return $instance->fill($values)->save();
        }

        return tap($this->newModelInstance($attributes + $values), function ($instance) {
            $instance->save();
        });
    }
}