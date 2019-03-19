<?php
require_once 'secret.php';

class Database extends PDO {

    public function __construct($host, $dbname, $user, $pass) {
        try {
            $dsn = "mysql:dbname=$dbname;host=$host;charset=utf8"; // no hyphen in utf8
            parent::__construct($dsn, $user, $pass, null);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die('Database cnnection failed: ' . $ex->getMessage());
        }
    }
}

class ResultSet {
    private $class;
    private $stmt;
    
    function __construct($class, $stmt) {
        $this->class = $class;
        $this->stmt = $stmt;
    }

    function getNext() {
        return $this->stmt->fetchObject($this->class) ?: null;
    }
}

$db = new Database(Secret::DB_HOST, Secret::DB_NAME, Secret::DB_USERNAME, Secret::DB_PASSWORD);
