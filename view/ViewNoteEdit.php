<?php
require_once '../general/include.php';
require_once 'View.php';
require_once '../model/Note.php';

class ViewNoteEdit extends View {

    private $note;

    function __construct() {
        parent::__construct('Notitie', User::LEVEL_USER);
        $id = filter_input(INPUT_GET, 'id');
        $this->note = Note::get($id);
        if (empty($this->note)) {
            header('location: home.php');
            exit;
        }
    }

    function show() {
        $this->start();
        ?>
        <form action="../controller/NoteController.php?action=update" method="post">
            <input type="hidden" name="id" value="<?= $this->note->getId() ?>">
            <label class="w4">Titel  <input type="text" name="title" value="<?= $this->note->getTitle() ?>"></label>
            <label class="w4">Tekst  <textarea name="content"><?= $this->note->getContent() ?></textarea></label>
            <button type="submit">Bewaren</button>
            <a href="../controller/NoteController.php?action=delete&id=<?= $this->note->getId() ?>">Verwijderen</a>
        </form>
        <?php
        $this->end();
    }

}

$view = new ViewNoteEdit();
$view->show();

