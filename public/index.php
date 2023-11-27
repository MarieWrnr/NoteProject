<?php
# базовый путь
const BASE_PATH = __DIR__ . '/../';

# подключаем необходимые функции
require BASE_PATH . 'functions.php';

spl_autoload_register(function ($class) {
    require base_path("Core/{$class}.php");
});

require base_path( 'router.php');

#$config = require('config.php'); # конфигурация базы данных

#$db = new Database($config['database']);

/*$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = :id";
$posts = $db->query($query, [':id' => $id])->fetch();
dd($posts);*/