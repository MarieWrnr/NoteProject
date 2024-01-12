<?php

namespace Core;

class Authenticator extends LogUser
{
    public function attempt($email, $username, $password)
    {
        // match the data
        $user = App::resolve(Database::class)
            ->query('SELECT * FROM users WHERE email = :email AND username = :username', [
                'email' => $email,
                'username' => $username
            ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // password must match password in the db
                $this->login(['email' => $email, 'username' => $username]);

                return true;
            }
        }

            return false;
    }
}