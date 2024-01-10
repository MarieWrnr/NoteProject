<?php

namespace Core;

class Authenticator
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

    public function login($user)
    {
        $_SESSION['user'] = ['email' => $user['email'], 'username' => $user['username']];

        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}