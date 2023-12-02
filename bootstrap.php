<?php
// using dependency container for more comfortable initializing Database object

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

// new type of initialization (sooner we can use it to make a db object)

$container->bind('Core\Database', function () {
    $config = require base_path('config.php');
    return new Database($config['database']);
});

// container that stores all dependencies

App::setContainer($container);
