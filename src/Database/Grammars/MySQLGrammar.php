<?php

namespace Scandiweb\Database\Grammars;

use App\Models\Model;

class MySQLGrammar
{
    public static function InsertQuery($keys)
    {
        $values = '';
        for ($i = 0; $i < count($keys); $i++) {
            $values .= '?, ';
        }

        $query = 'INSERT INTO ' . Model::getTableName() . ' (`' . implode('`, `', $keys) . '`) VALUES(' . rtrim($values, ', ') . ')';
        
        return $query;
    }

    public static function SelectQuery($columns = '*', $filter = null)
    {
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }

        $query = "SELECT {$columns} FROM " . Model::getTableName();

        if ($filter) {
            $query .= " WHERE {$filter[0]} {$filter[1]} ?";
        }

        return $query;
    }

    public static function DeleteQuery()
    {
        return 'DELETE FROM ' . Model::getTableName() . ' WHERE ID = ?';
    }

    public static function DeleteManyQuery($keys)
    {
        $placeholders = implode(', ', array_fill(0, count($keys), '?'));
        $query = 'DELETE FROM ' . Model::getTableName() . ' WHERE id IN (' . $placeholders . ')';

        return $query;
    }


}