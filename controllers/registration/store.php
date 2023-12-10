<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];

$db = App::resolve(Database::class);

// validating
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}
// checking if an account exists

if (Validator::string($password, 7, 255)) {
    $errors['password'] = 'Password must be more than 8 chars!';
}

if (Validator::string($username, 4, 255)) {
    $errors['password'] = 'Username must be more than 4 chars!';
}

// if we have same login in db

$log = $db->query('SELECT * FROM users WHERE username = :username', ['username' => $username])->find();

if ($log) {
    $errors['username'] = 'Such username already exists!';
}

if (!empty($errors)) {
    return view('registration/create.view.php', ['errors' => $errors]);
}



// If yes - redirect to login page

// finding user

$user = $db->query('SELECT * FROM users WHERE email = :email',
    ['email' => $email])->find();

// if we have a user in a database
if ($user) {
    header('location: /'); // there will be login
} else {
    $db->query('INSERT INTO users(email, username, password) VALUES(:email, :username, :password)', [
        'email' => $email,
        'password' => $password,
        'username' => $username
    ]);

    // user has logged in
    $_SESSION['user'] = ['email' => 'email'];

    header('location: /');
    exit();
}
