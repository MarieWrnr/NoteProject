<?php
# базовый путь
const BASE_PATH = __DIR__ . '/../';

# подключаем необходимые функции
require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {

    $class = str_replace('\\', '/', $class);
    require base_path("{$class}.php");
});

require base_path( 'Core/router.php');

#$config = require('config.php'); # конфигурация базы данных

#$db = new Database($config['database']);

/*$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = :id";
$posts = $db->query($query, [':id' => $id])->fetch();
dd($posts);*/