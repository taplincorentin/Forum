<?php

$user = $result["data"]['user'];

?>

<h1><?= $user->getUsername()?>'s page</h1>

<p>joined: <?= $user->getCreationdate() ?></p>



<?php
    if($user == \App\Session::getUser()){
?>
    <a href='index.php?ctrl=security&action=changePassword&id=<?= $user->getId()?>'>Modify your password</a>
<?php
    }

