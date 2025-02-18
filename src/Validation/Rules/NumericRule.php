<?php

 namespace Scandiweb\Validation\Rules;

 use Scandiweb\Validation\Rules\Rule;


 class NumericRule implements Rule
 {
    public function apply($field, $value, $data): bool
    {
        if (!array_key_exists($field, $data) || $value === '') {
            return true;
        }
        return is_numeric($value);
    }

    public function __tostring()
    {
        return "%s Must be Numbers only";
    }
 }