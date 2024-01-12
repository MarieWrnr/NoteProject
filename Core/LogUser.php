<?php

namespace Core;

class LogUser
{
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