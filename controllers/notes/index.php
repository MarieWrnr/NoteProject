<?php

use Core\Database;

$config = require base_path('config.php'); # конфигурация базы данных
$db = new Database($config['database']);

$notes = $db->query('select * from notes where author = 3')->getAll();
//dd($notes);

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
