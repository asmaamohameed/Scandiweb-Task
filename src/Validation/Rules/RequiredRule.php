<?php

 namespace Src\Validation\Rules;

 use Src\Validation\Rules\Rule;


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