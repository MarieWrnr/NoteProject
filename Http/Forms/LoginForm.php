<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($email, $username, $password)
    {

        if (!Validator::email($email)) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (Validator::string($username, 4)) {
            $this->errors['username'] = 'Please provide a valid username!';
        }

        if (!Validator::password($password)) {
            $this->errors['password'] = 'Password must contain at least one char, digit and be more than 4 chars!';
        }

        return empty($this->errors);
    }

    public function addError($err_place, $err_message) {
        $this->errors[$err_place] = $err_message;
    }

    public function errors() {
        return $this->errors;
    }
}