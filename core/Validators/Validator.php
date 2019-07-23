<?php

namespace Evention\Validators;

use \Illuminate\Contracts\Validation\Validator as ValidatorContract;

abstract class Validator
{
    /**
     * @param string $attribute
     * @param string $value
     * @param array $parameters
     * @param ValidatorContract $validator
     *
     * @return bool
     */
    public abstract function validate($attribute, $value, $parameters, ValidatorContract $validator);
}