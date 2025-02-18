<?php

namespace Scandiweb\Validation;


use Scandiweb\Validation\Rules\NumericRule;
use Scandiweb\Validation\Rules\RequiredRule;
use Scandiweb\Validation\Rules\RequiredIfRule;
use Scandiweb\Validation\Rules\UniqueRule;

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