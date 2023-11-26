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
        abort(Response::FORBIDDEN);
    }
}
