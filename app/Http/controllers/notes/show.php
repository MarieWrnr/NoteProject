<?php

use app\Core\App;
use app\Core\Database;

$db = App::resolve(Database::class);

$heading = "Note";

$currentUserId = $_SESSION['user']->userid();
//dd($currentUserId);

$noteid = $_GET['id'];
$note = $db->query('select * from notes where noteid = :id', ['id' => $noteid])->findOrFail();
#dd($note);

authorize($note['author'] === $currentUserId);

view("notes/show.view.php",
    ['heading' => 'Note', 'note' => $note]);
