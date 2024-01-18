<?php

use app\Core\Session;

view('sessions/create.view.php', [
    'errors' => Session::get('errors')
]);
