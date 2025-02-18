<?php

namespace Scandiweb\Database\Concerns;

use Scandiweb\Database\Managers\Contracts\DatabaseManager;

trait ConnectsTo
{
    public static function connect(DatabaseManager $manager)
    {
        return $manager->connect();
    }
    
}
