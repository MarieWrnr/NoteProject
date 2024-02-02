<?php

use app\Models\Note;

//$db = App::resolve(Database::class);

$heading = "Note";

$currentUserId = $_SESSION['user']->userid();
//dd($currentUserId);

$noteid = $_GET['id'];
$note = new Note(false, null, null, $noteid);

authorize($note->getAuthor() === $currentUserId);

view("notes/show.view.php",
    ['heading' => 'Note', 'note' => $note]);
