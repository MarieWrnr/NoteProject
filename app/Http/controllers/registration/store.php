<?php

use app\Core\Registrator;
use app\Http\Forms\RegistrationForm;

/* 0. Доп. переменные для данных необязательны (возможно, в будущем для них стоит итерироваться)
 * 1. Валидация совпадает с формой для аутентификации (можно сослаться на этот класс)
 * 2. Класс Registrator ??? наследующийся от класса LOG */

$form = RegistrationForm::validate($attributes = [
    'email' => $_POST['email'],
    'username' => $_POST['username'],
    'password' => $_POST['password']
]);


// If yes - redirect to login page
//

$reg = new Registrator();
$isRegistered = $reg->register($_POST['email'], $_POST['username'], $_POST['password']);
if (!$isRegistered) {
    redirect('login'); // there will be login
}
redirect('/');
