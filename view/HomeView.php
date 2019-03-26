<?php
require_once '../general/include.php';
require_once 'View.php';

$view = new View();
$view->start('Home');
?>
Sources staan op <a href="https://github.com/spijkerbak/mvc-example">Github</a>.
<?php
$view->end();
