<?php 

use Core\Response;

function dd($value)
{
    echo "<pre>";

    var_dump($value);

    echo "<pre>";

    die();
}

function URLIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;

}

function abort($code = 404)
{
    http_response_code($code);

    require base_Path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if(!$condition)
    {
        abort($status);
    }
}

function base_Path($path)
{
    return BASE_PATH.$path;

}

function view($path, $attributes= [])
{    
    extract($attributes);

    require base_Path("views/{$path}");

}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

