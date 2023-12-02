<?php
# базовый путь
const BASE_PATH = __DIR__ . '/../';

# подключаем необходимые функции
require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {

    $class = str_replace('\\', '/', $class);
    require base_path("{$class}.php");
});

require base_path("bootstrap.php");

$router = new \Core\Router();

$routes = require base_path('routes.php');
//
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
//dd($method);


$router->route($uri, $method);

#$config = require('config.php'); # конфигурация базы данных

#$db = new Database($config['database']);

/*$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = :id";
$posts = $db->query($query, [':id' => $id])->fetch();
dd($posts);*/