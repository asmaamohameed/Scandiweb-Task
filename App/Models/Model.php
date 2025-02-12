<?php

namespace App\Models;

abstract class Model
{
    protected static $instance;

    public static function create(array $data)
    {
        self::$instance = static::class;

        return app()->db->create($data);
    }
    public static function all()
    {
        self::$instance = static::class;

        return app()->db->read();
        
    }
    public static function find($id)
    {
        self::$instance = static::class;

        return app()->db->read('*', ['id' => $id]);
    }
    public static function delete($id)
    {
        self::$instance = static::class;

        return app()->db->delete($id);
    }
    public static function deleteMany(array $ids)
    {
        self::$instance = static::class;

        foreach ($ids as $id) {
            app()->db->delete($id);
        }
    }
    public static function where($filter, $columns = "*")
    {
        self::$instance = static::class;

        return app()->db->read($columns, $filter);
    }
    public static function getModel()
    {
        return self::$instance;
    }
    public static function getTableName()
    {
        return class_basename(self::$instance);
    }

}