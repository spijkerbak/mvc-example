<?php

require_once '../general/include.php';
require_once 'Controller.php';
require_once '../model/Note.php';

class NoteController extends Controller {

    public function getMinimumLevel() : int {
        return User::LEVEL_USER;
    }
    
    public function delete() {
        $id = filter_input(INPUT_GET, 'id');
        $note = User::get($id);
        $note->delete();
    }

    public function insert() {
        $note = new Note();
        $note->set(filter_input_array(INPUT_POST));
        $note->insert();
    }

    public function update() {
        $id = filter_input(INPUT_POST, 'id');
        $note = User::get($id);
        $note->set(filter_input_array(INPUT_POST));
        $note->update();
    }

}

$controller = new UserController();
$controller->run();

header('location: ../view/user-list.php');

