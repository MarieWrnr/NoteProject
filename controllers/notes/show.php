<?php
$heading = "Note";

$config = require base_path('config.php'); # конфигурация базы данных
$db = new Database($config['database']);

$id = $_GET['id'];
$currentUserId = 3;

$note = $db->query('select * from notes where noteid = :id', ['id' => $id])->findOrFail();
#dd($note);

authorize($note['author'] === $currentUserId);

view("notes/show.view.php",
['heading' => 'Note', 'note' => $note]);

