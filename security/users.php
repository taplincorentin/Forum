<?php

$users = $result["data"]['users'];

?>

<h1>users list</h1>

<?php
foreach ($users as $user) {

    ?>
    <p>
        <a href='index.php?ctrl=forum&action=userProfile&id=<?= $user->getId() ?>'><?= $user->getUsername() ?></a>
        <a href="index.php?ctrl=home&action=deleteUser&id=<?= $user->getId() ?>">x</a>
    </p>

    <?php
}