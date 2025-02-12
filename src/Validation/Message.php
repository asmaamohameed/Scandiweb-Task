<?php

namespace Src\Validation;



class Message
{
    public static function generate($rule, $filed)
    {
        return str_replace("%s", $filed, $rule);

    }

}