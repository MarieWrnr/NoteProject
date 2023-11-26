<?php
$heading = "My Notes";

$config = require('config.php'); # конфигурация базы данных
$db = new Database($config['database']);

$notes = $db->query('select * from notes where author = 3')->getAll();
#dd($notes);

require "views/notes/index.view.php";
