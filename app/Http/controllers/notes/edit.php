<?php

use app\Models\Note;

//$db = App::resolve(Database::class);

$currentUserId = $_SESSION['user']->userid();

$id = $_GET['id'];
// if note exists and belongs to current author id
$note = new Note(false, null, null, $id);

authorize($note->getAuthor() === $currentUserId);

// getting editing form
view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' =>  $note
]);