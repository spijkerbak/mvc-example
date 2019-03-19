<?php

require_once 'Record.php';

class Note implements Record {

    private $id;
    private $title;
    private $content;
    private $createDate;
    private $owner;

    function __construct() {
        
    }

    function set(array $array) {
        $this->title = $array['title'];
        $this->content = $array['content'];
    }

    static function getAll(): ResultSet {
        global $db;
        if (User::getCurrent()->getLevel() == User::LEVEL_ADMIN) {
            $sql = 'SELECT * FROM `note`';
            $stmt = $db->prepare($sql);
            $stmt->execute();
        } else {
            $sql = 'SELECT * FROM `note` WHERE `owner` = ?';
            $stmt = $db->prepare($sql);
            $stmt->execute([User::getCurrent()->getEmail()]);
        }
        return new ResultSet('Note', $stmt);
    }

    function getId() : int {
        return $this->id;
    }

    function getTitle() : string {
        return $this->title;
    }

    function getContent() : string{
        return $this->content;
    }

    /**
     * 
     * @return string: the createDate as a string "yyyy-mm-dd hh:mm"
     */
    function getCreateDate() : string {
        return substr($this->createDate, 0, 16);
    }

    function getOwner() : User {
        return User::get($this->owner);
    }

    static function get(string $id): ?Note {
        global $db;
        $sql = 'SELECT * FROM `note` WHERE id = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $note = $stmt->fetchObject('Note');
        if (!empty($note)) {
            $note->owner = User::get($note->owner);
            return $note;
        } else {
            return null;
        }
    }

    function insert() {
        global $db;
        $sql = 'INSERT INTO `note` '
                . '(`title`, `content`, `owner`) '
                . 'VALUES (?, ?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->title, $this->content, User::getCurrent()->getEmail()]);
    }

    function update() {
        global $db;
        $sql = 'UPDATE `note` SET '
                . '`title` = ?, `content` = ?'
                . 'WHERE `id` = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->title, $this->content, $this->id]);
    }

    function delete() {
        global $db;
        $sql = 'DELETE FROM `note` WHERE `id` = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->id]);
    }

}
