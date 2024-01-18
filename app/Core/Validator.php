<?php

namespace app\Core;

class Validator
{

    // create a password validation
    // password should contain nums and characters, but not symbols of space, slash, _+=!@#$%^&*()[]{} and so on

    public static function string($val, $min = 1, $max = INF)
    {
        $value = trim($val);

        return strlen($val) < $min || strlen($val) > $max;
    }

    /*Пароль содержит символы из трех следующих категорий.

    Прописные или строчные буквы европейских языков (от A до Z, с диакритической меткой, греческим и кириллицем).

    Базовые 10 цифр (от 0 до 9).

*/

    public static function password($val) {
        $pattern_pass = '/(?=.*[A-Za-z])(?=.*\d)\w{4,}/';

        return preg_match($pattern_pass, $val);
    }

    public static function email($val)
    {
        return filter_var($val, FILTER_VALIDATE_EMAIL);
    }
}
