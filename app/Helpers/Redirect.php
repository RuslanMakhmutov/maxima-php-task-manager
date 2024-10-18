<?php

namespace App\Helpers;


class Redirect
{
    public static function to($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);

        exit();
    }
    public static function back()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
