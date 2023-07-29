<?php

$users = $result["data"]['users'];

?>
<div class='logForm'>
<h1>USERS LIST</h1>

<?php
foreach ($users as $user) {

    ?>
    <p>
        <a href='index.php?ctrl=forum&action=userProfile&id=<?= $user->getId() ?>'><?= $user->getUsername() ?></a>
        <a href="index.php?ctrl=home&action=deleteUser&id=<?= $user->getId() ?>"><i class="fa-solid fa-xmark" style="color: #ff9500;"></i></a>
    </p>

<?php }?>

</div>