<?php

use Core\App;
use Core\Database;

// getting access to db
$db = App::resolve(Database::class);

// bad authentication
$currentUserId = 3;

// form was submitted. delete the current note
$note = $db->query('SELECT * FROM notes WHERE noteid = :id', ['id' => $_POST['id']])->findOrFail(); # ищем запись в таблице

authorize($note['author'] === $currentUserId); # принадлежит ли запись текущему авторизованному пользователю

$db->query('DELETE FROM NOTES WHERE noteid = :id',
    ['id' => $_POST['id']]
);

// relocate to notes page
header('location: /notes');
exit();
