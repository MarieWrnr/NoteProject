<?php

use app\Core\App;
use app\Core\Database;

// getting access to db
$db = App::resolve(Database::class);

// bad authentication
$currentUserId = $_SESSION['user']->userid();

// form was submitted. delete the current note
$note = $db->query('SELECT * FROM notes WHERE noteid = :id', ['id' => $_POST['id']])->findOrFail(); # ищем запись в таблице

authorize($note['author'] === $currentUserId); # принадлежит ли запись текущему авторизованному пользователю

$db->query('DELETE FROM NOTES WHERE noteid = :id',
    ['id' => $_POST['id']]
);

// relocate to notes page
redirect('/notes');
