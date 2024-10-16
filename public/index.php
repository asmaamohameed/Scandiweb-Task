<?php

use Core\Session;
use core\Router;

const BASE_PATH = __DIR__ .'/../';

require BASE_PATH . 'vendor/autoload.php';

require BASE_PATH.'Core/functions.php';

require base_Path('Core/bootstrap.php');

require base_Path('Routes/routes.php');


Router::route($_SERVER['REQUEST_URI']);









