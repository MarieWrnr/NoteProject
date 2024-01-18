<?php

use app\Core\App;
use app\Core\Database;

$db = App::resolve(Database::class);
$author = $_SESSION['user']->userid();

// getting all notes of this author
$notes = $db->query('select * from notes where author = :author', ['author' => $author])->getAll();
//dd($notes);

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
