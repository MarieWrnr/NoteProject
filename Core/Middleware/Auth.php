<?php

namespace Core\Middleware;
class Auth
{

    public function handle()
    {
        if (!$_SESSION['user'] ?? false) { // а пользователь совершил аутентификацию
            header('location: /'); // иди домой чел
            exit();
        }
    }
}
