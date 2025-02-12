<?php

namespace Src\Validation;


use Src\Validation\Rules\NumericRule;
use Src\Validation\Rules\RequiredRule;
use Src\Validation\Rules\RequiredIfRule;
use Src\Validation\Rules\UniqueRule;

trait RulesMapper
{
    protected static array $map = [
        'required'=> RequiredRule::class,
        'numeric'=> NumericRule::class,
        'unique'=> UniqueRule::class,
        "required_if"=> RequiredIfRule::class
    ];

    public static function resolve(string $rule, $options)
    {
        return new static::$map[$rule](...$options);
    }

}