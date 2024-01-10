<?php

use Core\Database;
use Core\Validator;

use Core\App;

$db = App::resolve(Database::class);

$currentUserId = 3;

$id = $_POST['id'];
$note = $db->query('select * from notes where noteid = :id', ['id' => $id])->findOrFail();

authorize($note['author'] == $currentUserId);

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

$db->query('UPDATE notes SET body = :body where noteid = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['about']
]);

redirect('/notes');