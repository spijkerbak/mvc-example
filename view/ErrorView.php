<?php
require_once '../general/include.php';
require_once 'View.php';

$status = filter_input(INPUT_GET, 'status');
switch ($status) {
    case 403:
        $message = 'Forbidden';
        break;
    case 404:
        $message = 'Not found';
        break;
    default:
        $message = 'Error';
        break;
}
header('HTTP/1.0 ' . $status . ' ' . $message);

$view = new View();
$view->start('Error: ' . $message);
echo 'Status code = ' . $status;
$view->end();

