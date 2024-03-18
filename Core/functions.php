<?php

use Core\Response;

function urlIs($val)
{
    return $val === $_SERVER["REQUEST_URI"];
}

function dd($uri)
{
    echo "<pre>";
    var_dump($uri);
    echo "</pre>";
    die();
}

function abort($code = 404)
{
    http_response_code($code);
    require base_path("views/{$code}.php");
    die();
}

function authorize($cond, $status = Response::FORBIDDEN)
{
    if (!$cond) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    // extract : accepts an array and turns it into a set of variables
    require base_path('views/' . $path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function old($key, $default = null)
{
    return Core\Session::get('old')[$key]  ?? $default;
}
