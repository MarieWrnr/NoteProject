<?php

use app\Models\Note;
use app\Core\Validator;

$currentUserId = $_SESSION['user']->userid();

$id = $_POST['id'];

$note = new Note(false, null, null, $id);
authorize($note->getAuthor() === $currentUserId);

if (Validator::string($_POST['about'], 1, 1000)) {
    $errors['about'] = 'A body of no more than 1000 is required (but not empty)';
}

if (!empty($errors)) {
    return view('notes/edit.view.php',
    [
        'heading' => 'Edit Note',
        'errors' => $errors,
        'note' => $note
    ]);
}

$note->updateBody($_POST['about']);

redirect('/notes');