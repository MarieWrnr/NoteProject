<?php

namespace app\Core;

use app\Models\User;

class Registrator extends LogUser
{
    public function register($user)
    {
        // if user is already registered
        $db = App::resolve(Database::class);

        $user_found = $db->query('SELECT * FROM users WHERE email = :email',
            ['email' => $_POST['email']])->find();

        if (!$user_found) {
            $user = new User($_POST['email'], $_POST['username'], $_POST['password'], false);
            // user has logged in
            $this->login($user);

            return true;
        }

        return false;

    }
}