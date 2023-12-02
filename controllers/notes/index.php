<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$notes = $db->query('select * from notes where author = 3')->getAll();
//dd($notes);

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
