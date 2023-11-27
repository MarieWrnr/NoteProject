<?php
function dd($st) {
    echo "<pre>";
    var_dump($st);
    echo "</pre>";
    die();
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function authorize($condition, $status = Response::FORBIDDEN) {
    if (! $condition) {
        abort($status);
    }
}

function base_path($path) {
    return BASE_PATH . $path;
}

function view($path, $attributes = []) {
    extract($attributes); # превращает ключи в переменные
    require base_path("views/" . $path);
}
