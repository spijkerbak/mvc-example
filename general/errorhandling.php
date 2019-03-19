<?php
// When debugging: disable caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// When debugging: report all PHP errors 
ini_set('error_reporting', E_ALL);
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

set_error_handler(function($errno, $errstr, $errfile, $errline ) {
    //throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
    // IGNORE warning from mail() about logging
    //header('Content-type: text/html');
    echo "ERROR HANDLER:<br>\n";
    if (stripos($errstr, 'phpmaillog') !== false) {
        return;
    }
    echo "Fout $errno:<br>$errstr";
    echo '<br>';
    if (stristr($errstr, 'SQL') !== false) {
        echo '<br>Statement:<br>';
        echo '<br>';
    }
    echo "<br>Back trace:<br>";
    foreach (debug_backtrace() as $trace) {
        if (!empty($trace['file'])) {
            echo substr($trace['file'], strlen($_SERVER['DOCUMENT_ROOT'])) . ' (' . $trace['line'] . ')';
            echo "<br>\n";
        }
    }
    echo "<br>\n";
    exit();
});
