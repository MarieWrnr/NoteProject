<?php

use app\Models\Note;
use app\Core\Validator;

//$db = App::resolve(Database::class);

$errors = [];

// validate check (on errors)
if (Validator::string($_POST['about'], 1, 1000)) {
    $errors['about'] = 'A body of no more than 1000 is required (but not empty)';
}

if (!empty($errors)) {
    return view("notes/create.view.php", [
    'heading' => 'Create Note',
    'errors' => $errors
]);
}

$currentUserId = $_SESSION['user']->userid();

$note = new Note(true, $_POST['about'], $currentUserId);

redirect('/notes');
