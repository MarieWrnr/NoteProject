<?php

namespace app\Models;

use app\Core\Database;
use app\Core\App;

class Note
{
    private $noteid;
    private $body;
    private $author;

    public function __construct($new, ?string $body = null, ?int $author = null, ?int $noteid = null)
    {
        $db = App::resolve(Database::class);
        //dd($new);
        if ($new) {
            $this->body = $body;
            $this->author = $author;

            $this->createNote($db);
            $this->noteid = $db->getLastInsertedId();

        } else {
            $note = $this->findNote($db, ['noteid' => $noteid]);

            $this->author = $note['author'];
            $this->noteid = $noteid;
            $this->body = $note['body'];

        }
        return $this;
    }

    public function createNote($db)
    {
        $db->query('INSERT INTO notes(body, author) VALUES(:body, :author)',
            [
                'body' => $this->body,
                'author' => $this->author
            ]);
    }

    public function findNote($db, $parameters)
    {
        $query = "SELECT * FROM notes WHERE ";
        foreach ($parameters as $parameter => $value) {
            $query .= "$parameter = :$parameter";
        }

        return $db->query($query, $parameters)->findOrFail();

    }

        public function destroyNote()
    {
        $db = App::resolve(Database::class);
        $db->query('DELETE FROM NOTES WHERE noteid = :id', ['id' => $this->noteid]);

    }

    public function getAuthor() {
        return $this->author;
    }

}