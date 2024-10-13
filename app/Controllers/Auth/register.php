<?php

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$password_confirmation = $_POST['password_confirmation'] ?? null;
$personal_confirmation = $_POST['personal_confirmation'] ?? null;

if (empty($email) || empty($password) || empty($password_confirmation) || empty($personal_confirmation)) {
    die('Вы не заполнили все необходимые поля!');
}

if ($password != $password_confirmation) {
    die('Пароли не совпадают!');
}

echo 'Вы успешно зарегистрировались!';
