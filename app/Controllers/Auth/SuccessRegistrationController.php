<?php

namespace app\Controllers\Auth;

use app\View;

class SuccessRegistrationController
{
    public function __invoke()
    {
        View::render('auth.success_registration');
    }
}
