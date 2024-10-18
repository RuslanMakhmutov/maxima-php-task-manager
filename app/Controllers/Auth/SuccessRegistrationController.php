<?php

namespace App\Controllers\Auth;

use App\View;

class SuccessRegistrationController
{
    public function __invoke()
    {
        View::render('auth.success_registration');
    }
}
