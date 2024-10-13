<?php

namespace app\Controllers\Auth;

use app\View;

class LoginController
{
    public function __invoke()
    {
        View::render('auth.login');
    }
}
