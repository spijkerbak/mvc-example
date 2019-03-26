<?php
require_once '../general/include.php';
require_once 'View.php';
require_once '../model/Note.php';


class NoteView extends View {

    public function edit() {
        $id = filter_input(INPUT_GET, 'id');
        ASSERT_NOT_EMPTY($id);
        
        $note = Note::get($id);
        ASSERT_NOT_EMPTY($note);
        
        ASSERT_LEVEL_OR_USER(User::LEVEL_ADMIN, $note->getOwner());
        
        $this->start('Notitie');
        ?>
        <form action="../controller/NoteController.php?action=update" method="post">
            <input type="hidden" name="id" value="<?= $note->getId() ?>">
            <label class="w4">Titel  <input type="text" name="title" value="<?= $note->getTitle() ?>"></label>
            <label class="w4">Tekst  <textarea name="content"><?= $note->getContent() ?></textarea></label>
            <button type="submit">Bewaren</button>
            <a href="../controller/NoteController.php?action=delete&id=<?= $note->getId() ?>">Verwijderen</a>
        </form>
        <?php
        $this->end();
    }

    public function new() {
        ASSERT_LEVEL(User::LEVEL_USER);
        $this->start('Nieuwe notitie');
        ?>
        <form action="../controller/NoteController.php?action=insert" method="post">
            <label class="w4">Titel  <input type="text" name="title"></label>
            <label class="w4">Tekst  <textarea name="content"></textarea></label>
            <button type="submit">Bewaren</button>
        </form>
        <?php
        $this->end();
    }

    public function list() {
        ASSERT_LEVEL(User::LEVEL_USER);
        $this->start('Notities');
        ?>
        <table class='grid'>
            <thead>
                <tr>
                    <th class="click"><a href='NoteView.php?action=new'>🞤</a></th>
                    <th class="sort filter">Titel</th>
                    <th class="sort filter">Tekst</th>
                    <?php if (Login::hasLevel(User::LEVEL_ADMIN)) { ?>
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
                    echo "<td class='click'><a href='NoteView.php?action=edit&id={$note->getId()}'>✎</a></td>";
                    echo "<td>{$note->getTitle()}</td>";
                    echo "<td>{$note->getContent()}</td>";
                    if (Login::hasLevel(User::LEVEL_ADMIN)) {
                        echo "<td>{$note->getOwner()->getName()}</td>";
                    }
                    echo "<td>{$note->getCreateDate()}</td>";
                    echo "</tr>\n";
                }
                ?>
            </tbody>
        </table>
        <?php
        $this->end();
    }

}

$view = new NoteView();
$view->run();

