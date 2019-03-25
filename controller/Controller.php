<?php

abstract class Controller {

    function run() {
        $action = filter_input(INPUT_GET, 'action');
        if(!method_exists($this, $action)) {
            echo "onbekende actie: $action";
            exit;
        }
        $this->$action();
    }
}