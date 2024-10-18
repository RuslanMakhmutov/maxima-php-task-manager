<?php

namespace App\Controllers\Auth;

use App\Helpers\Redirect;
use App\Models\User;

class AuthController
{
    public function __invoke()
    {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (empty($email) || empty($password)) {
            die('Вы не заполнили все необходимые поля!');
        }

        $user = User::findByEmail($email);

        if (empty($user)) {
            die('Пара логин/пароль не существует');
        } elseif (!password_verify($password, $user->getAttr('password'))) {
            die('Пара логин/пароль не существует');
        }

        $_SESSION['user_id'] = $user->getId();

        Redirect::to('/');
    }
}
