<?php

namespace App;

use App\Routes\Dispatcher;

class App
{
    public static function run()
    {
        session_start();

        include_once __DIR__ . '/../routes/web.php';

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $dispatcher = new Dispatcher($requestMethod, $requestUri);
        $dispatcher->dispatch();
    }
}
