<?php

// add new route with method GET

// main page is getting index.php from server and uploads it to client
$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

// getting all notes and making possibility to create new ones
$router->get('/notes', 'notes/index.php')->only('auth');
$router->post('/notes', 'notes/store.php')->only('auth');

// getting specific note and deleting it
$router->get('/note', 'notes/show.php')->only('auth');
$router->delete('/note', 'notes/destroy.php')->only('auth');

// form for creating a new note
$router->get('/notes/create', 'notes/create.php')->only('auth');

// getting a form for editing note and updating it
$router->get('/note/edit', 'notes/edit.php')->only('auth');
$router->patch('/note', 'notes/update.php')->only('auth');

#$router->patch('', 'notes/');

// registration form
$router->get('/register', 'registration/create.php')->only('guest'); // ура разграничение ролей
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'sessions/create.php')->only('guest');
$router->post('/session', 'sessions/store.php')->only('guest');

$router->delete('/session', 'sessions/destroy.php')->only('auth');
//dd($router->routes);

