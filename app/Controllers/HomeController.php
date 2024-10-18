<?php

namespace App\Controllers;

use App\View;

class HomeController
{
    public function __invoke()
    {
        View::render('home');
    }
}
