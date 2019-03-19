<?php
require_once '../general/include.php';
require_once 'View.php';

$email = filter_input(INPUT_GET, 'email');
$user = User::get($email);
if (empty($user)) {
    header('location: home');
    exit;
}

$view = new View('Gebruiker', User::LEVEL_ADMIN);
$view->start();
?>
<form action="../controller/UserController.php?action=update" method="post">
    <input type="hidden" name="org_email" value="<?= $user->getEmail() ?>">
    <label>E-mailadres  <input type="text" name="email" value="<?= $user->getEmail() ?>"></label>
    <label>Naam         <input type="text" name="name" value="<?= $user->getName() ?>"></label>
    <label>Level        <input type="text" name="level" value="<?= $user->getLevel() ?>"></label>
    <button type="submit">Bewaren</button>
    <a href="../controller/UserController.php?action=delete&email=<?= $user->getEmail() ?>">Verwijderen</a>
</form>
<?php
$view->end();
