<?php

use Core\Database;

$heading = "Note";

$config = require base_path('config.php'); # конфигурация базы данных
$db = new Database($config['database']);

$currentUserId = 3;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // form was submitted. delete the current note
    //dd($_POST);
    $note = $db->query('SELECT * FROM notes WHERE noteid = :id', ['id' => $_POST['id']])->findOrFail(); # ищем запись в таблице

    authorize($note['author'] === $currentUserId); # принадлежит ли запись текущему авторизованному пользователю

    $db->query('DELETE FROM NOTES WHERE noteid = :id',
        ['id' => $_POST['id']]
    );

    header('location: /notes');
    exit();
} else {

    $id = $_GET['id'];


    $note = $db->query('select * from notes where noteid = :id', ['id' => $id])->findOrFail();
#dd($note);

    authorize($note['author'] === $currentUserId);

    view("notes/show.view.php",
        ['heading' => 'Note', 'note' => $note]);
}
