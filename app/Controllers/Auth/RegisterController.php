<?php

namespace App\Controllers\Auth;

use App\Helpers\Redirect;
use App\Models\User;

class RegisterController
{
    public function __invoke()
    {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $password_confirmation = $_POST['password_confirmation'] ?? null;
        $personal_confirmation = $_POST['personal_confirmation'] ?? null;

        if (empty($name) || empty($email) || empty($password) || empty($password_confirmation) || empty($personal_confirmation)) {
            die('Вы не заполнили все необходимые поля!');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Вы указали невалидный e-mail');
        }

        if ($password != $password_confirmation) {
            die('Пароли не совпадают!');
        }

        if (!empty(User::findByEmail($email))) {
            die('E-mail занят');
        }

        $new_user = User::register($name, $email, $password);

        if (empty($new_user->getId())) {
            die('Ошибка регистрации');
        } else {
            Redirect::to('/success_registration');
        }

    }
}
