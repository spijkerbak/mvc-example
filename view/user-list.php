<?php
require_once '../general/include.php';
require_once 'View.php';

$view = new View('Gebruikers', User::LEVEL_ADMIN);
$view->start();
?>
<table class='grid'>
    <thead>
        <tr>
            <th class="click"><a href='user-new.php'>🞤</a></th>
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
            echo "<td class='click'><a href='user-edit.php?email={$user->getEmail()}'>✎</a></td>";
            echo "<td>{$user->getEmail()}</td>";
            echo "<td>{$user->getName()}</td>";
            echo "<td class='num'>{$user->getLevel()}</td>";
            echo "</tr>\n";
        }
        ?>
    </tbody>
</table>
<?php
$view->end();
