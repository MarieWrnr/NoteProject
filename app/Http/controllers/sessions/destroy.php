<?php
//log the user out

use app\Core\Authenticator;

(new Authenticator())->logout();

redirect('/');
