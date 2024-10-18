<?php

namespace App;

class View
{
    public static function render($view, $data = []): void
    {
        $view = str_replace('.', DIRECTORY_SEPARATOR, $view);
        $filepath = dirname(__DIR__) . "/resources/views/{$view}.php";

        if (!file_exists($filepath)) {
            throw new \Exception("View {$view} not found");
        }

        if (!empty($data)) {
            extract($data);
        }

        require $filepath;

        // $keys = array_keys($data);
        // $values = array_values($data);
        // $viewContent = str_replace($keys, $values, $viewContent);
        // echo $viewContent;
    }
}
