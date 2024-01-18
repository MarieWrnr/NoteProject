<?php

use app\Core\Router;
use app\Core\Session;
use app\Core\ValidationException;

const BASE_PATH_V = __DIR__ . '/../';
const BASE_PATH = __DIR__ . '/../app/';

require BASE_PATH_V . '/vendor/autoload.php';

session_start();

# подключаем необходимые функции
require BASE_PATH . 'Core/functions.php';

require base_path("bootstrap.php");

$router = new Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {

    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}


Session::unflash();
