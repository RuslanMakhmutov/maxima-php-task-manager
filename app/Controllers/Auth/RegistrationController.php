<?php

namespace app\Controllers\Auth;

use app\View;

class RegistrationController
{
    public function __invoke()
    {
        View::render('auth.registration');
    }
}
