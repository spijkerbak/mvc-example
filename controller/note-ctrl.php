<?php

require_once '../general/include.php';
require_once '../model/Note.php';

if (User::getCurrent()->getLevel() >= User::LEVEL_USER) {
    $action = filter_input(INPUT_GET, 'action');
    switch ($action) {
        case 'delete':
            $id = filter_input(INPUT_GET, 'id');
            $note = Note::get($id);
            $note->delete();
            break;
        case 'insert':
            $note = new Note();
            $note->set(filter_input_array(INPUT_POST));
            $note->insert();
            break;
        case 'update':
            $id = filter_input(INPUT_POST, 'id');
            $note = Note::get($id);
            $note->set(filter_input_array(INPUT_POST));
            $note->update();
            break;
    }
}

header('location: ../view/note-list.php');

