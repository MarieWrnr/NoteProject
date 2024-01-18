<?php

namespace app\Core;
use app\Models\User;

class Authenticator extends LogUser
{
    public function attempt($email, $username, $password)
    {
        // match the data
        $found_user = App::resolve(Database::class)
            ->query('SELECT * FROM users WHERE email = :email AND username = :username', [
                'email' => $email,
                'username' => $username
            ])->find();
        //dd($user);
        if ($found_user) {
            if (password_verify($password, $found_user['password'])) {
                // password must match password in the db
                $user = new User($_POST['email'], $_POST['username'], $_POST['password'], true, $found_user['userid']);
                $this->login($user);

                return true;
            }
        }

            return false;
    }
}