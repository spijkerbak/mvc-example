<?php
require_once '../general/include.php';
require_once 'View.php';

$view = new View('Home');
$level = $view->start();
?>

<?php
$view->end();
