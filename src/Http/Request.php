<?php

namespace Scandiweb\Http;

use Scandiweb\Support\Arr;
 
class Request
{
    public function Method()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);

        // If the form includes a hidden _method field, use that instead.
        if ($method === 'post' && isset($_POST['_method'])) {
            // Use the value of _method, converted to lowercase.
            $method = strtolower($_POST['_method']);
        }

        return $method;
    }

    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        return str_contains($path, '?') ? explode('?', $path)[0]  : $path;
    }
    public function all()
    {
        return $_REQUEST;
    }

    public function only($keys)
    {
        return Arr::only($this->all(), $keys);
    }

    public function get($key)
    {
        return Arr::get($this->all(), $key);
    }


}