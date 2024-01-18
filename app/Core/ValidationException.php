<?php

namespace app\Core;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;

    public static function throw($errors, $old) {
        $instance = new static(); // new exception

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}