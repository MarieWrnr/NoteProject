<?php
# подключаем необходимые функции
require_once  'functions.php';
# подключение к дб
require 'database.php';
require 'response.php';
require 'router.php';

#$config = require('config.php'); # конфигурация базы данных

#$db = new Database($config['database']);

/*$id = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = :id";
$posts = $db->query($query, [':id' => $id])->fetch();
dd($posts);*/