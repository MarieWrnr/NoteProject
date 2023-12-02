<?php
use Core\Response;

// text output and program exit (using for testing)
function dd($st) {
    echo "<pre>";
    var_dump($st);
    echo "</pre>";
    die();
}


function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort ($code = 404) {
    // setting http code for this page
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function authorize($condition, $status = Response::FORBIDDEN) {
    // if author is not matching current user by condition
    if (! $condition) {
        abort($status);
    }
}

function base_path($path) {
    return BASE_PATH . $path;
}

// using for getting views
function view($path, $attributes = []) {
    extract($attributes); # превращает ключи в переменные
    require base_path("views/" . $path);
}
