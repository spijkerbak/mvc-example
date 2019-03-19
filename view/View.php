<?php

class View {

    private $title;
    private $user;

    /**
     * @param string title: Page title
     * @param int minLevel: level needed to show this view
     * exception: view redirected to 'home' on insufficient user level
     */
    function __construct($title, $minLevel = User::LEVEL_NONE) {
        $this->title = $title;
        $this->user = User::getCurrent();
        if ($minLevel !== User::LEVEL_NONE) {
            if ($this->user == null || !$this->user->getLevel() >= $minLevel) {
                header('location: home.php');
                exit;
            }
        }
    }

    function getUserLevel() : int {
        return $this->user == null ? User::LEVEL_NONE : $this->user->getLevel();
    }
    
    /**
     * Start a view  by generating <html>, <head> en start of <body>
     * containing main menu and page header
     */
    function start() {
        echo "<!doctype html>\n";
        echo "<html lang='nl'>\n";
        $this->HtmlHead();
        echo "<body>\n";
        $this->showMenu();
        $this->showLogo();
        echo "<h2>{$this->title }</h2>\n";
    }

    /**
     * End the view by closing <body> and <html>
     */
    function end() {
        echo "</body>\n";
        echo "</html>\n";
    }

    private function HtmlHead() {
        ?>
        <head>
            <title><?= $this->title ?></title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans" />
            <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto+Slab"> 
            <link rel="stylesheet/less" type="text/css" href="style/style.less">
            <script src="//spijkerman.nl/script/tablefilter-105.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
        </head>
        <?php
    }

    private function showMenu() {
        echo "<nav>\n";
        echo "Menu: ";
        if ($this->user == null) {
            echo "<a href='login.php'>Login</a>\n";
        } else {
            echo "<a href='home.php'>Home</a>\n";
            echo "<a href='note-list.php'>Notities</a>\n";
            echo "{$this->user}: ";
            echo "<a href='../controller/logout-ctrl.php'>Logout</a>\n";
            if ($this->user->getLevel() == User::LEVEL_ADMIN) {
                echo "Admin: ";
                echo "<a href='user-list.php'>Gebruikers</a>\n";
                echo "<a href='dbadmin.php'>Database</a>\n";
            }
        }
        echo "</nav>\n";
    }

    private function showLogo() {
        echo "<header>\n";
        echo "<h1>Just Notes</h1>\n";
        echo "</header>\n";
    }

}
