<?php

namespace app\Http\Forms;

use app\Core\App;
use app\Core\Database;
use app\Core\Validator;

class RegistrationForm extends Form
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

        $username_check = App::resolve(Database::class)
            ->query('SELECT * FROM users WHERE username = :username', ['username' => $attributes['username']])
            ->find();

        if ($username_check) {
            $this->errors['username'] = 'Such username already exists!';
        }

    }


}