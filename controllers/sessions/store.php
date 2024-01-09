<?php
// IF EMAIL, USERNAME AND PASSWORD MATCH - THEN CREATE A SESSION WITH CURRENT USER

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(\Core\Database::class);

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// validating
$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (Validator::string($username)) {
    $errors['password'] = 'Please provide a valid username!';
}

if (!Validator::password($password)) {
    $errors['password'] = 'Password must contain at least one char, digit and be more than 4 chars!';
}

if (!empty($errors)) {
    return view('sessions/create.view.php',
        [
            'errors' => $errors
        ]);
}

// match the data
$user = $db->query('SELECT * FROM users WHERE email = :email AND username = :username', [
    'email' => $email,
    'username' => $username
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        // password must match password in the db
        login(['email' => $email, 'username' => $username]);

        header('location: /');

        exit();
    }
}

return view('sessions/create.view.php',
    [
        'errors' => [
            'password' => 'No matching account for that password! Try again'
        ]
    ]);


