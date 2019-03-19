<?php

interface Record {
    static function get(string $key);
    static function getAll(): ResultSet;
    function insert();
    function update();
    function delete();
}
