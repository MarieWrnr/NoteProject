<?php
$heading = "Note";

$config = require('config.php'); # конфигурация базы данных
$db = new Database($config['database']);

$id = $_GET['id'];
$currentUserId = 3;

$note = $db->query('select * from notes where noteid = :id', ['id' => $id])->findOrFail();
#dd($note);

authorize($note['author'] === $currentUserId);

require "views/notes/show.view.php";

