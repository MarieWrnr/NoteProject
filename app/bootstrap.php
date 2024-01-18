<?php
// using dependency container for more comfortable initializing Database object

use app\Core\App;
use app\Core\Database;
use app\Core\Container;

$container = new Container();

// new type of initialization (sooner we can use it to make a db object)

$container->bind('app\Core\Database', function () {
    $config = require base_path('config.php');
    return new Database($config['database']);
});

// container that stores all dependencies

App::setContainer($container);
