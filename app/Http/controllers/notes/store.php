<?php

use app\Core\App;
use app\Core\Database;
use app\Core\Validator;

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

$currentUserId = $_SESSION['user']->userid();

$db->query('INSERT INTO notes(body, author) VALUES(:body, :author)', ['body' => $_POST['about'], 'author' => $currentUserId]);// ХАРДКОДИШЬ СУКА
//dd($db->connection->lastInsertId());

redirect('/notes');
