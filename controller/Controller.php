<?php

abstract class Controller {

    abstract function getMinimumLevel();
    
    abstract function delete();

    abstract function insert();

    abstract function update();

    function run() {
        if(User::getCurrent()->getLevel() < $this->getMinimumLevel()) {
            return;
        }
        $action = filter_input(INPUT_GET, 'action');
        switch ($action) {
            case 'delete':
                $this->delete();
                break;
            case 'insert':
                $this->insert();
                break;
            case 'update':
                $this->update();
                break;
        }
    }

}