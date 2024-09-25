<?php

$email = htmlentities($_POST['email']);
$password = htmlentities($_POST['password']);

if (empty($email) || empty($password)) {
    die('Вы не заполнили все необходимые поля!');
}

echo "Вы вошли как {$email}";
