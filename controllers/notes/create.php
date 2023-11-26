<?php
require "Validator.php";

$config = require('config.php');
$db = new Database($config['database']);

$heading = "Create Note";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    if (Validator::string($_POST['about'], 1, 1000)) {
        $errors['about'] = 'A body of no more than 1000 is required (but not empty)';
    }

    if (empty($errors)) {
        $db->query('INSERT INTO notes(body, author) VALUES(:body, :author)', ['body' => $_POST['about'], 'author' => 3]);
    }
}
require 'views/notes/create.view.php';
