<?php

require_once '../general/include.php';
require_once 'Controller.php';

class LoginController extends Controller {

    public function login() {
        checkUserLevel(User::LEVEL_NONE);
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $user = User::get($email);
        if ($user !== null && $user->login($password)) {
            header('location: ../view/HomeView.php');
        } else {
            header('location: ../view/LoginView.php');
        }
    }

    public function logout() {
        checkUserLevel(User::LEVEL_USER);
        //session_start();
        session_destroy();
        header('location: ../view/HomeView.php');
    }

}

$controller = new LoginController();
$controller->run();

goHome();

