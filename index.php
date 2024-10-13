<?php

use app\Routes\Dispatcher;

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

include_once __DIR__ . '/routes/web.php';

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$dispatcher = new Dispatcher($requestMethod, $requestUri);
$dispatcher->dispatch();
