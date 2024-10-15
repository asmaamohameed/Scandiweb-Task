<?php

namespace Core;


class Router
{
    private static $routes = [];

    public static function add($method, $path, $action)
    {
        static::$routes[$path][$method] = $action;
    }

    public static function get($path, $action)
    {
        static::add('GET', $path, $action);
    }

    public static function post($path, $action)
    {
        static::add('POST', $path, $action);
    }

    public static function delete($path, $action)
    {
        static::add('DELETE', $path, $action);
    }


    public static function route($uri)
    {
        ['path' => $path] =  parse_url($uri);

        if (!isset(static::$routes[$path])) {
            throw new \Exception('RouteNotFound'); //RouteNotFound();
        }

        // Support different form methods (PUT, DELETE)
        if (isset($_POST['_method']) && in_array($_POST['_method'], ['DELETE', 'PUT'])) {
            $_SERVER['REQUEST_METHOD'] = $_POST['_method'];
        }

        if (!isset(static::$routes[$path][$_SERVER['REQUEST_METHOD']])) {
            throw new  \Exception('MethodNotAllowed'); //MethodNotAllowed;
        }

        $action = static::$routes[$path][$_SERVER['REQUEST_METHOD']];

        return $action();

        //static::abort();
    }

    private static function abort($code = 404)
    {
        http_response_code($code);

        require base_Path("views/{$code}.php");

        die();
    }
}
