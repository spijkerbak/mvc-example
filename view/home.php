<?php
require_once '../general/include.php';
require_once 'View.php';

$view = new View('Home');
$level = $view->start();
?>
Sources staan op <a href="https://github.com/spijkerbak/mvc-example">Github</a>.
<?php
$view->end();
