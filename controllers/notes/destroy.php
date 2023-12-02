<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);


$currentUserId = 3;

// form was submitted. delete the current note
$note = $db->query('SELECT * FROM notes WHERE noteid = :id', ['id' => $_POST['id']])->findOrFail(); # ищем запись в таблице

authorize($note['author'] === $currentUserId); # принадлежит ли запись текущему авторизованному пользователю

$db->query('DELETE FROM NOTES WHERE noteid = :id',
    ['id' => $_POST['id']]
);

header('location: /notes');
exit();
