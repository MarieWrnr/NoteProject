<?php

use app\Models\Note;

// bad authentication
$currentUserId = $_SESSION['user']->userid();

// form was submitted. delete the current note
$note = new Note(false, null, null, $_POST['id']);
    //$db->query('SELECT * FROM notes WHERE noteid = :id', ['id' => $_POST['id']])->findOrFail(); # ищем запись в таблице

authorize($note->getAuthor() === $currentUserId); # принадлежит ли запись текущему авторизованному пользователю

$note->destroyNote();
unset($note);

/*$db->query('DELETE FROM NOTES WHERE noteid = :id',
    ['id' => $_POST['id']]
);*/

// relocate to notes page
redirect('/notes');
