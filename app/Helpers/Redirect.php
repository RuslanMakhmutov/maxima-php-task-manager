<?php

namespace app\Helpers;


class Redirect
{
    public static function to($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);

        exit();
    }
}
