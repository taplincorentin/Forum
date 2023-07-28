<?php

$user = $result["data"]['user'];
$posts = $result["data"]["posts"];

?>
<div class='userPage'>
<div class='userInfo'>
    <p><?= $user->getUsername()?>'s page</p>
    <p>joined: <?= $user->getCreationdate() ?></p>
</div>

<div class='posts'>
<p>Latest posts</p>
<table>
    <tr>
        <th>Topic</th>
        <th>Post</th>
        <th>Created on</th>
    </tr>
    <?php 
    foreach ($posts as $post) {
    ?>
    <tr>
        <td><a href='index.php?ctrl=forum&action=listPosts&id=<?= $post->getTopic()->getId() ?>'><?= $post->getTopic()->getTitle() ?></a></td>
        <td><?= $post->getContent() ?></td>
        <td><?= $post->getCreationdate()?></td>
    </tr>
    <?php
    } ?>
</table>
</div>
</div>
<div class="passwordChange">
<?php
    if($user == \App\Session::getUser()){
?>
    <a href='index.php?ctrl=security&action=changePassword&id=<?= $user->getId()?>'>Modify your password</a>
<?php
    } ?>
</div>

