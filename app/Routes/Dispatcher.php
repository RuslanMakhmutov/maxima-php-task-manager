<?php

namespace app\Routes;

use app\View;

class Dispatcher {

    public function __construct(private string $requestMethod, private string $requestUri)
    {
    }

    public function dispatch() {
        foreach (Route::getRoutes()[$this->requestMethod] as $route => $action) {
            if ($route === $this->requestUri) {
                return $this->executeAction($action);
            }
        }

        http_response_code(404);

        if ($this->requestMethod == 'GET') {
            View::render('errors.404');
        } else {
            die('Page not found');
        }
    }

    private function executeAction($action) {
        if (is_callable($action)) {
            return $action();
        }

        if (is_array($action)) {
            list($controller, $method) = $action;
        } elseif (class_exists($action)) {
            $controller = $action;
        } else {
            list($controller, $method) = explode('@', $action);
        }

        if ($this->requestMethod == 'GET') {
            $payload = $_GET;
        } else {
            $payload = $_POST;
        }

        $controller = new $controller;
        if (!empty($method)) {
            return $controller->$method(...$payload);
        }
        return $controller(...$payload);
    }
}
