<?php

require_once '../general/include.php';
require_once 'Controller.php';
require_once '../model/Note.php';

class NoteController extends Controller {

    public function delete() {
        $id = filter_input(INPUT_GET, 'id');
        $note = Note::get($id);
        assertNotEmpty($note);
        Login::assertLevelOrUser(User::LEVEL_ADMIN, $note->getOwner());
        $note->delete();
    }

    public function insert() {
        $note = new Note();
        $note->set(filter_input_array(INPUT_POST));
        $note->insert();
    }

    public function update() {
        $id = filter_input(INPUT_POST, 'id');
        $note = Note::get($id);
        $note->set(filter_input_array(INPUT_POST));
        $note->update();
    }

}

$controller = new NoteController();
$controller->run();

header('location: ../view/NoteView.php?action=list');

