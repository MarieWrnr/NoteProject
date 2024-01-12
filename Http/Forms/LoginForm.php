<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    //public $attributes;
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        $this->attributes = $attributes;

        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (Validator::string($attributes['username'], 4)) {
            $this->errors['username'] = 'Please provide a valid username!';
        }

        if (!Validator::password($attributes['password'])) {
            $this->errors['password'] = 'Password must contain at least one char, digit and be more than 4 chars!';
        }

    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->fail() ? $instance->throw() : $instance;

    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function fail()
    {
        return count($this->errors);
    }

    public function addError($err_place, $err_message)
    {
        $this->errors[$err_place] = $err_message;

        return $this;
    }

    public function errors()
    {
        return $this->errors;
    }
}