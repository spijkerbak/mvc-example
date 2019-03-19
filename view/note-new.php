
<?php
require_once '../general/include.php';
require_once 'View.php';

$view = new View('Nieuwe notitie', User::LEVEL_USER);
$view->start();
?>
<form action="../controller/note-ctrl.php?action=insert" method="post">
    <label class="w4">Titel  <input type="text" name="title"></label>
    <label class="w4">Tekst  <textarea name="content"></textarea></label>
    <button type="submit">Bewaren</button>
</form>
<?php
$view->end();

