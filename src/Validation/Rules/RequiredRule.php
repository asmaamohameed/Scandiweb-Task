<?php

 namespace Scandiweb\Validation\Rules;

 use Scandiweb\Validation\Rules\Rule;


 class RequiredRule implements Rule
 {
    public function apply($field, $value, $data=[]): bool
    {
        return !empty($value);
    }

    public function __tostring()
    {
        return "%s is required and cannot be empty";
    }
 }