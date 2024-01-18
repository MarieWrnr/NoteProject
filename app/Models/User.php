<?php

namespace app\Models;

use app\Core\App;
use app\Core\Database;

class User
{
    private $userid;
    private $email;
    private $username;
    private $password;

    //private $db;

    public function __construct($email, $username, $password, $registered, ?int $userid = null)
    {
        $db = App::resolve(Database::class);

        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        if (!$registered) {
            $this->registerUser($db);
            $this->userid = $db->getLastInsertedId();
        }
        else {
            $this->userid = $userid;
        }
        return $this;
    }

    private function registerUser($db)
    {
        $db->query('INSERT INTO users(email, username, password) VALUES(:email, :username, :password)', [
            'email' => $this->email,
            'password' => $this->password, # УЗНАТЬ ПОБОЛЬШШЕ ОБ ЭТОЙ ФУНКЦИИ
            'username' => $this->username
        ]);
    }

    public function userid()
    {
        return $this->userid;
    }

    public function email()
    {
        return $this->email;
    }

    public function username()
    {
        return $this->username;
    }
}