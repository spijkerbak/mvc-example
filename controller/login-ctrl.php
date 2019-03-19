<?php

require_once '../general/include.php';

$email = filter_input(INPUT_POST, 'email');
$password = filter_input(INPUT_POST, 'password');
$user = User::get($email);
if ($user !== null && $user->login($password)) {
    header('location: ../view/home.php');
} else {
    header('location: ../view/login.php');
}
