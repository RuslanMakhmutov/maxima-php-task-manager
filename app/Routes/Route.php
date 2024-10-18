<?php

namespace App\Routes;

class Route
{
    private static array $routes = [];

    public static function addRoute($method, $route, $action): void
    {
        self::$routes[$method][$route] = $action;
    }

    public static function get(string $route, mixed $action): void
    {
        self::addRoute('GET', $route, $action);
    }

    public static function post(string $route, mixed $action): void
    {
        self::addRoute('POST', $route, $action);
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
}
