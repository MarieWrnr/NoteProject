<?php

namespace app\Http\Forms;

use app\Core\Validator;

class LoginForm extends Form
{


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


}