<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 3;

$id = $_GET['id'];
// if note exists and belongs to current author id
$note = $db->query('select * from notes where noteid = :id', ['id' => $id])->findOrFail();
#dd($note);

authorize($note['author'] === $currentUserId);

// getting editing form
view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' =>  $note
]);