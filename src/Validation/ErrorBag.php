<?php

namespace Scandiweb\Validation;



class ErrorBag
{
    protected $errors = [];

    public function add($filed, $message)
    {
        $this->errors[$filed][] = $message;
    }

    public function __get($key)
    {
        if(property_exists($this, $key)) {
            return $this->$key;
        }
  

    }



}