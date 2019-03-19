<?php
require_once '../general/include.php';
require_once 'View.php';
require_once '../model/Note.php';

$view = new View('Notities', User::LEVEL_USER);
$view->start();
$level = $view->getUserLevel();
?>
<table class='grid'>
    <thead>
        <tr>
            <th class="click"><a href='note-new.php'>🞤</a></th>
            <th class="sort filter">Titel</th>
            <th class="sort filter">Tekst</th>
            <?php if ($level == User::LEVEL_ADMIN) { ?>
                <th class="sort filter">Maker</th>
            <?php } ?>
            <th class="sort filter">Datum + tijd</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $notes = Note::getAll();
        while ($note = $notes->getNext()) {
            echo "<tr>";
            echo "<td class='click'><a href='ViewNoteEdit.php?id={$note->getId()}'>✎</a></td>";
            echo "<td>{$note->getTitle()}</td>";
            echo "<td>{$note->getContent()}</td>";
            if ($level == User::LEVEL_ADMIN) {
                echo "<td>{$note->getOwner()->getName()}</td>";
            }
            echo "<td>{$note->getCreateDate()}</td>";
            echo "</tr>\n";
        }
        ?>
    </tbody>
</table>
<?php
$view->end();
