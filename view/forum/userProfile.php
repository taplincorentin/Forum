<?php

$user = $result["data"]['user'];
$posts = $result["data"]["posts"];

?>

<h1><?= $user->getUsername()?>'s page</h1>

<p>joined: <?= $user->getCreationdate() ?></p>

<div class='posts'>
<h3>Latest posts</h3>
<?php 
    foreach ($posts as $post) {
    ?>
    <p>
        <?= $post->getTopic()->getTitle() ?>
        <?= $post->getContent() ?>
        <?= $post->getCreationdate()?>
    <?php
    } ?>

</div>
<?php
    if($user == \App\Session::getUser()){
?>
    <a href='index.php?ctrl=security&action=changePassword&id=<?= $user->getId()?>'>Modify your password</a>
<?php
    }

