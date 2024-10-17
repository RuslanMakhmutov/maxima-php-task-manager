<?php

namespace app\Controllers\Auth;

use app\Helpers\Redirect;

class LogoutController
{
    public function __invoke()
    {
        $_SESSION['user_id'] = null;
        Redirect::to('/');
    }
}
