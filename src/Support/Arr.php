<?php

namespace Scandiweb\Support;

use ArrayAccess;

class Arr
{

    public static function only($array, $keys)
    {
        return array_intersect_key($array, array_flip((array) $keys));
    }

    public static function accessible($value)
    {
        return is_array($value) || $value instanceof ArrayAccess;
    }

    public static function exists($array, $key)
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }

        return array_key_exists($key, $array);
    }

    public static function has($array, $keys)
    {
        if (is_null($keys)) {
            return false;
        }

        $keys = (array) $keys;

        if (empty($keys)) {
            return false;
        }

        foreach ($keys as $key) {
            $subArray = $array;

            if (static::exists($array, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $segmant) {
                if (static::accessible($subArray) && static::exists($subArray, $segmant)) {
                    $subArray = $subArray[$segmant];
                } else {
                    return false;

                }
            }

        }



        return true;

    }

    public static function last($array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            return empty($array) ? value($default) : end($array);
        }

        return static::first(array_reverse($array), $callback, $default);

    }

    public static function first($array, callable $callback = null, $default = null)
    {
        if (is_null($callback)) {
            if (empty($array)) {
                return value($default);
            }

            foreach ($array as $item) {
                return $item;
            }
        }

        foreach ($array as $key => $value) {
            if (call_user_func($callback, $value, $key)) {
                return $value;

            }
        }

        return value($default);



    }

    public static function forget($array, $keys)
    {
        $orginal = &$array;

        $keys = (array) $keys;

        if (!count($keys)) {
            return false;
        }

        foreach ($keys as $key) {
            if (static::exists($array, $key)) {
                unset($array[$key]);

                continue;
            }
        }

        $parts = explode('.', $key);

        $array = &$orginal;

        while (count($parts) > 1) {

            $part = array_shift($parts);

            if (isset($array[$part]) && is_array($array[$part])) {
                $array = &$array[$part];

            } else {
                continue;
            }
        }

        unset($array[array_shift($parts)]);

    }

    public static function except($array, $keys)
    {
        return static::forget($array, $keys);
    }

    public static function flatten($array, $depth = INF)
    {
        $result = [];

        foreach ($array as $item) {
            if (is_array($item) && $depth > 1) {
                $result = array_merge($result, static::flatten($item, $depth - 1));
            } else {
                $result[] = $item;
            }
        }
        return $result;
    }

    public static function get($array, $key, $default = null)
    {
        if(!static::accessible($array))
        {
            return value($default);
        }

        if(is_null($key))
        {
            return $array;
        }

        if(static::exists($array, $key))
        {
            return $array[$key];
        }

        if(!str_contains($key, '.'))
        {
            return $array[$key] ?? value($default);

        }

        foreach(explode('.' , $key) as $segmant)
        {
            if(static::accessible($array) && static::exists($array, $segmant))
            {
                $array = $array[$segmant];
            }
            else
            {
                return value($default);
            }

        }

        return $array;

    }

    public static function set(&$array, $key, $value)
    {
        if(is_null($key))
        {
            return $array = $value;

        }

        $keys = explode('.', $key);

        while(count($keys) > 1)
        {
            $key = array_shift($keys);
            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;         
    }

    public static function unset($array, $key)
    {
        static::set($array, $key, null);
    }
 }
