<?php

namespace Scandiweb\Validation\Rules;



interface Rule
{
    public function apply($filed, $value, $data);

    public function __tostring();
    

}