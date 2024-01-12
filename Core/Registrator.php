<?php

namespace Core;

class Registrator extends LogUser
{
    public function register($email, $username, $password)
    {
        // if user is already registered

        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email',
            ['email' => $email])->find();

        if (!$user) {
            App::resolve(Database::class)->query('INSERT INTO users(email, username, password) VALUES(:email, :username, :password)', [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT), # УЗНАТЬ ПОБОЛЬШШЕ ОБ ЭТОЙ ФУНКЦИИ
                'username' => $username
            ]);

            // user has logged in
            $this->login(['email' => $email, 'username' => $username]);

            return true;
        }

        return false;

    }
}