<?php
require_once '../general/include.php';
require_once 'View.php';
require_once '../model/User.php';

class UserView extends View {

    public function edit() {
        checkUserLevel(User::LEVEL_ADMIN);
        $email = filter_input(INPUT_GET, 'email');
        $user = User::get($email);
        goHomeIfEmpty($user);
        $this->start('Gebruiker');
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
        $this->end();
    }

    public function new() {
        checkUserLevel(User::LEVEL_ADMIN);
        $this->start('Nieuwe gebruiker');
        ?>
        <form action="../controller/UserController.php?action=insert" method="post">
            <label>E-mailadres  <input type="text" name="email"></label>
            <label>Naam         <input type="text" name="name"></label>
            <label>Level        <input type="text" name="level"></label>
            <button type="submit">Bewaren</button>
        </form>
        <?php
        $this->end();
    }

    public function list() {
        checkUserLevel(User::LEVEL_ADMIN);
        $this->start('Gebruikers');
        ?>
        <table class='grid'>
            <thead>
                <tr>
                    <th class="click"><a href='../view/UserView.php?action=new'>🞤</a></th>
                    <th class="sort filter">E-mail</th>
                    <th class="sort filter">Naam</th>
                    <th class="sort filter">Level</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users = User::getAll();
                while ($user = $users->getNext()) {
                    echo "<tr>";
                    echo "<td class='click'><a href='../view/UserView.php?action=edit&email={$user->getEmail()}'>✎</a></td>";
                    echo "<td>{$user->getEmail()}</td>";
                    echo "<td>{$user->getName()}</td>";
                    echo "<td class='num'>{$user->getLevel()}</td>";
                    echo "</tr>\n";
                }
                ?>
            </tbody>
        </table>
        <?php
        $this->end();
    }

}

$view = new UserView();
$view->run();

