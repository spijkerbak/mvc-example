<?php

require_once '../general/include.php';
require_once 'Controller.php';

class UserController extends Controller {

    public function getMinimumLevel() : int {
        return User::LEVEL_ADMIN;
    }
    
    public function delete() {
        $email = filter_input(INPUT_GET, 'email');
        $user = User::get($email);
        $user->delete();
    }

    public function insert() {
        $user = new User();
        $user->set(filter_input_array(INPUT_POST));
        $user->insert();
    }

    public function update() {
        $email = filter_input(INPUT_POST, 'org_email');
        $user = User::get($email);
        $user->set(filter_input_array(INPUT_POST));
        $user->update();
    }

}

$controller = new UserController();
$controller->run();

header('location: ../view/UserView.php?action=list');

