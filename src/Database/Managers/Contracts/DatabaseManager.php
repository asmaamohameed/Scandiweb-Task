<?php

namespace Src\Database\Managers\Contracts;

interface DatabaseManager
{
    public function connect(): \Pdo;
    public function query(string $query, array $values = []);
    public function create($data);
    public function read($columns="*", $filter = null);
    public function delete($id);
}

