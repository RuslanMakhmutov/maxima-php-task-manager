<?php

namespace app\Controllers;

use app\View;

class HomeController
{
    public function __invoke()
    {
        View::render('home');
    }
}
