<?php

// add new route with method GET

// main page is getting index.php from server and uploads it to client
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// getting all notes and making possibility to create new ones
$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->post('/notes', 'controllers/notes/store.php')->only('auth');

// getting specific note and deleting it
$router->get('/note', 'controllers/notes/show.php')->only('auth');
$router->delete('/note', 'controllers/notes/destroy.php')->only('auth');

// form for creating a new note
$router->get('/notes/create', 'controllers/notes/create.php')->only('auth');

// getting a form for editing note and updating it
$router->get('/note/edit', 'controllers/notes/edit.php')->only('auth');
$router->patch('/note', 'controllers/notes/update.php')->only('auth');

#$router->patch('', 'controllers/notes/');

// registration form
$router->get('/register', 'controllers/registration/create.php')->only('guest'); // ура разграничение ролей
$router->post('/register', 'controllers/registration/store.php')->only('guest');

$router->get('/login', 'controllers/sessions/create.php')->only('guest');
$router->post('/session', 'controllers/sessions/store.php')->only('guest');

$router->delete('/session', 'controllers/sessions/destroy.php')->only('auth');
//dd($router->routes);

