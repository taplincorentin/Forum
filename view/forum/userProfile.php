<?php

$user = $result["data"]['user'];

?>

<h1><?= $user->getUsername()?>'s page</h1>

<p>joined: <?= $user->getCreationdate() ?></p>

