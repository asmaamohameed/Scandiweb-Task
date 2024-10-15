<?php 

namespace Core;

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind('Core\Database', function(){

    $config = require base_Path('Config/config.php');

    return new Database($config['database']);

});


App::setContainer($container);