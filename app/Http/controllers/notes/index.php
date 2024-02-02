<?php

use app\Models\Note;

$author = $_SESSION['user']->userid();

// getting all notes of this author
$notes = Note::allNotesByAuthor($author);
//dd($notes);

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
