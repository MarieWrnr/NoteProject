<?php
// IF EMAIL, USERNAME AND PASSWORD MATCH - THEN CREATE A SESSION WITH CURRENT USER

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $username, $password)) {


    $auth = new Authenticator();

    if ($auth->attempt($email, $username, $password)) {
        redirect('/'); // this actually kill the script
    }

    $form->addError('password', 'No matching account for that data! Try again');
}


Session::flash('errors', $form->errors());

return redirect('/login');


