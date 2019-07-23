<?php

namespace Evention\Validators;

use Illuminate\Support\Facades\Validator;
use Evention\Validators\Validator as BaseValidator;
use \Illuminate\Contracts\Validation\Validator as ValidatorContract;

class IfUserGuestRequiredValidator extends BaseValidator
{
    /**
     * @param string $attribute
     * @param string $value
     * @param array $parameters
     * @param ValidatorContract $validator
     *
     * @return bool
     */
    public function validate($attribute, $value, $parameters, ValidatorContract $validator)
    {
        if(auth()->guest()) {
            return Validator::make([$attribute, $value], [$attribute => 'required'])->passes();
        }

        return true;
    }
}