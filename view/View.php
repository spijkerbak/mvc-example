<?php

class View {

    function run() {
        $action = filter_input(INPUT_GET, 'action');
        if(!method_exists($this, $action)) {
            echo "onbekende actie: $action";
            exit;
        }
        $this->$action();
    }

    /**
     * Start a view  by generating <html>, <head> en start of <body>
     * containing main menu and page header
     * @param string title: Page title
     */
    function start(string $title) {
        echo "<!doctype html>\n";
        echo "<html lang='nl'>\n";
        $this->showHtmlHead($title);
        echo "<body>\n";
        $this->showMenu();
        $this->showLogo();
        echo "<h2>{$title}</h2>\n";
    }

    /**
     * End the view by closing <body> and <html>
     */
    function end() {
        echo "</body>\n";
        echo "</html>\n";
    }

    private function showHtmlHead($title) {
        ?>
        <head>
            <title><?= $title ?></title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans" />
            <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto+Slab"> 
            <link rel="stylesheet/less" type="text/css" href="style/style.less">
            <script src="//spijkerman.nl/script/spikescript/2.10/spikescript.js"></script>
            <script src="//spijkerman.nl/script/tablefilter/2.11/tablefilter.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
        </head>
        <?php
    }

    private function showMenu() {
        echo "<nav>\n";
        echo "Menu: ";
        if (!Login::hasLevel(User::LEVEL_USER)) {
            echo "<a href='LoginView.php'>Login</a>\n";
        } else {
            echo "<a href='HomeView.php'>Home</a>\n";
            echo "<a href='NoteView.php?action=list'>Notities</a>\n";
            echo Login::getCurrent() . ": ";
            echo "<a href='../controller/LoginController.php?action=logout'>Logout</a>\n";
            if (Login::hasLevel(User::LEVEL_ADMIN)) {
                echo "Admin: ";
                echo "<a href='UserView.php?action=list'>Gebruikers</a>\n";
                echo "<a href='DBView.php'>Database</a>\n";
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
