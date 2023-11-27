<?php
require base_path("Core/Validator.php");

$config = require base_path('config.php');
$db = new Database($config['database']);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (Validator::string($_POST['about'], 1, 1000)) {
        $errors['about'] = 'A body of no more than 1000 is required (but not empty)';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes(body, author) VALUES(:body, :author)', ['body' => $_POST['about'], 'author' => 3]);
    }
}
view("notes/create.view.php", [
    'heading' => 'Create Note',
    'errors' => $errors
]);
