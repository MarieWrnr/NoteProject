<?php
namespace app\Core\Middleware;

class Auth {
    public static function handle()
    {
        if (!$_SESSION['user'] ?? false) { // а пользователь совершил аутентификацию
            redirect('/');
        }
    }
}