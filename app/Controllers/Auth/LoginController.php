<?php

namespace App\Controllers\Auth;

use App\View;

class LoginController
{
    public function __invoke()
    {
        View::render('auth.login');
    }
}
