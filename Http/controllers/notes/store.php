<?php
use Core\Database;
use Core\Validator;
use Core\App;

$db = App::resolve(Database::class);

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

$db->query('INSERT INTO notes(body, author) VALUES(:body, :author)', ['body' => $_POST['about'], 'author' => 3]);

header('location: /notes');
die();
