<?php

$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);
$password_confirmation = htmlentities($_POST['password_confirmation']);
$personal_confirmation = $_POST['personal_confirmation'];

if (empty($email) || empty($password) || empty($password_confirmation) || empty($personal_confirmation)) {
    die('Вы не заполнили все необходимые поля!');
}

if ($password != $password_confirmation) {
    die('Пароли не совпадают!');
}

echo 'Вы успешно зарегистрировались!';
