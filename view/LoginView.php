<?php
require_once '../general/include.php';
require_once 'View.php';

$view = new View();
$view->start('Login');
?>
<form action="../controller/LoginController.php?action=login" method="post">
    <label>E-mailadres
        <input type="text" name="email">
    </label>
    <label>Password
        <input type="password" name="password">
    </label>
    <button type="submit">Login</button>
</form>
<?php
$view->end();
