<?php

use Core\Session;

session_start();

# базовый путь
const BASE_PATH = __DIR__ . '/../';

# подключаем необходимые функции
require BASE_PATH . 'Core/functions.php';

//dd($_SESSION);

# autoloading some classes
spl_autoload_register(function ($class) {

    $class = str_replace('\\', '/', $class);
    require base_path("{$class}.php");
});

require base_path("bootstrap.php");

$router = new \Core\Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];


$router->route($uri, $method);

Session::unflash();
