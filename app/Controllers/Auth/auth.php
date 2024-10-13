<?php

$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;

if (empty($email) || empty($password)) {
    die('Вы не заполнили все необходимые поля!');
}

echo "Вы вошли как " . htmlentities($email);
