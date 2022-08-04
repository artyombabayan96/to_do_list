<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    require_once($class.'.php');
});

$url = strtok($_SERVER["REQUEST_URI"], '?');

(new App\Routes\Router())->route($url);
