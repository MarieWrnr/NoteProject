<?php

// add new route with method GET

// main page is getting index.php from server and uploads it to client
$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

// getting all notes and making possibility to create new ones
$router->get('/notes', 'controllers/notes/index.php');
$router->post('/notes', 'controllers/notes/store.php');

// getting specific note and deleting it
$router->get('/note', 'controllers/notes/show.php');
$router->delete('/note', 'controllers/notes/destroy.php');

// form for creating a new note
$router->get('/notes/create', 'controllers/notes/create.php');

// getting a form for editing note and updating it
$router->get('/note/edit', 'controllers/notes/edit.php');
$router->patch('/note', 'controllers/notes/update.php');

#$router->patch('', 'controllers/notes/');

// registration form
$router->get('/register', 'controllers/registration/create.php');
$router->post('/register', 'controllers/registration/store.php');

//dd($router->routes);

