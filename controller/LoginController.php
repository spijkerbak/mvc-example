<?php

require_once '../general/include.php';
require_once 'Controller.php';

class LoginController extends Controller {

    public function login() {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $user = User::get($email);
        if ($user !== null && Login::login($user, $password)) {
            header('location: ../view/HomeView.php');
        } else {
            header('location: ../view/LoginView.php');
        }
    }

    public function logout() {
        //session_start(); // already started
        session_destroy();
        header('location: ../view/HomeView.php');
    }

}

$controller = new LoginController();
$controller->run();

header('location: ../view/HomeView.php');


