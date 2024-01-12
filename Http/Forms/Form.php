<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class Form
{
    //public $attributes;
    protected $errors = [];

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        // if validation is failed -> then throw an exception
        return $instance->fail() ? $instance->throw() : $instance;

    }

    public function throw()
    {
        // throwing an exception, we send errors and attributes from this form
        ValidationException::throw($this->errors, $this->attributes);
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