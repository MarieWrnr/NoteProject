<?php

namespace app\Core;

class LogUser
{
    public function login($user)
    {
        $_SESSION['user'] = $user;
        //dd($_SESSION['user']->userid());
        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}