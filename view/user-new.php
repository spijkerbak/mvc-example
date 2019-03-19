<?php
require_once '../general/include.php';
require_once 'View.php';

$view = new View('Nieuwe gebruiker', User::LEVEL_ADMIN);
$view->start();
?>
<form action="../controller/UserController.php?action=insert" method="post">
    <label>E-mailadres  <input type="text" name="email"></label>
    <label>Naam         <input type="text" name="name"></label>
    <label>Level        <input type="text" name="level"></label>
    <button type="submit">Bewaren</button>
</form>
<?php
$view->end();