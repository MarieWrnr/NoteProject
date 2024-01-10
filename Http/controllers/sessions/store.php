<?php
// IF EMAIL, USERNAME AND PASSWORD MATCH - THEN CREATE A SESSION WITH CURRENT USER

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$db = App::resolve(\Core\Database::class);

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

$form = new LoginForm();

if (!$form->validate($email, $username, $password)) {
    return view('sessions/create.view.php',
        [
            'errors' => $form->errors()
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
            'password' => 'No matching account for that data! Try again'
        ]
    ]);


