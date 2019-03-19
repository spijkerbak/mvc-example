<?php
require_once '../general/include.php';
require_once 'View.php';

$view = new View('Database');
$view->start();
?>
        <h2>Wacht...</h2>
        
        <form id="admin" target="database" method="post" action="<?= Secret::DB_ADMIN ?>">
            <input type="hidden" name="pma_servername" value="<?= Secret::DB_HOST ?>" size="24">
            <input type="hidden" name="pma_username" value="<?= Secret::DB_USERNAME ?>" size="24">
            <input type="hidden" name="pma_password" value="<?= Secret::DB_PASSWORD ?>" size="24">
            <input type="hidden" name="server" value="1">    
            <p>Of druk op <input value="Start" type="submit"></p>
        </form>
        <script>
            window.onload = function (e) {
                document.getElementById("admin").submit();
            };
        </script>
<?php
$view->end();