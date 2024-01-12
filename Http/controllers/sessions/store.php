<?php
// IF EMAIL, USERNAME AND PASSWORD MATCH - THEN CREATE A SESSION WITH CURRENT USER


use Core\Authenticator;
use Http\Forms\LoginForm;

/*
1. Calling method validate() to check if data is correct (using constructor of LoginForm) ->
2. Return new object of login if data is correct
*/

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'username' => $_POST['username'],
    'password' => $_POST['password']
]);


$auth = new Authenticator();
$signedIn = $auth->attempt($attributes['email'], $attributes['username'], $attributes['password']);

if (!$signedIn) {
    $form->addError('password', 'No matching account for that data! Try again')
        ->throw();

}

redirect('/'); // this actually kill the script

