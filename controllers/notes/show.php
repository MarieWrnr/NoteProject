<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$heading = "Note";

$currentUserId = 3;

$id = $_GET['id'];
$note = $db->query('select * from notes where noteid = :id', ['id' => $id])->findOrFail();
#dd($note);

authorize($note['author'] === $currentUserId);

view("notes/show.view.php",
    ['heading' => 'Note', 'note' => $note]);
