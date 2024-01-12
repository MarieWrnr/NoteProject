<?php

use Core\Session;
use Core\ValidationException;

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

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    //dd($_SERVER);
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}


Session::unflash();
