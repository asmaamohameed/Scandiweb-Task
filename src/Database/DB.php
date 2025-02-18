<?php

namespace Scandiweb\Database;

use Scandiweb\Database\Concerns\ConnectsTo;
use Scandiweb\Database\Managers\Contracts\DatabaseManager;
class DB
{
    protected DatabaseManager $manager;

    public function  __construct(DatabaseManager $manager) 
    {
        $this->manager = $manager;
        $this->init();
    }
    public function init()
    {
        ConnectsTo::connect($this->manager);
    }
    protected function raw(string $query, $value = [])
    {
        return $this->manager->query($query, $value);
    }
    protected function create(array $data)
    {
        return $this->manager->create($data);
    }
    protected function delete($id)
    {
        return $this->manager->delete($id);
    }
    protected function read($columns = "*", $filter = null)
    {
        return $this->manager->read($columns, $filter);

    }
    public function __call($method, $args)
    {
        if(method_exists($this, $method))
        {
            return call_user_func_array([$this, $method], $args);
        }
    }

}