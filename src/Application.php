<?php

namespace Src;

use Src\Database\DB;
use Src\Http\Response;
use Src\Http\Request;
use Src\Http\Route;
use Src\Support\Config;
use Src\Support\Session;
use Src\Database\Managers\MySQLManager;

class Application
{
    protected Route $route;
    protected Request $request;
    protected Response $response;
    protected Config $config;
    protected Session $session;


    protected DB $db;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->route = new Route($this->request, $this->response);
        $this->config = new Config($this->loadConfigurations());
        $this->db = new DB($this->getDBDriver());
        $this->session = new Session;

    }

    protected function getDBDriver()
    {
         return match(env('DB_DRIVER')) {
            'mysql' => new MySQLManager,
            default => new MySQLManager
        };
    }

    public function run()
    {
        $this->db->init();
        $this->route->resolves();
    }

    protected function loadConfigurations()
    {
        foreach (scandir(config_path()) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $fileName = explode('.', $file)[0];

            /* `yield` allows the function to return values one at a time, pausing and resuming.*/
            yield $fileName => require config_path() . $file;
        }

    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

}