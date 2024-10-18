<?php

namespace App\Controllers\Auth;

use App\View;

class RegistrationController
{
    public function __invoke()
    {
        View::render('auth.registration');
    }
}
