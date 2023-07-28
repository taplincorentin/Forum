<?php

$user = $result["data"]['user'];
$posts = $result["data"]["posts"];

?>
<div class='userMain'>
    <p>Latest posts</p>
    <table>
        <tr>
            <th>Topic</th>
            <th>Post</th>
            <th>Created on</th>
        </tr>
        <?php foreach ($posts as $post) { ?>
        <tr>
            <td><a href='index.php?ctrl=forum&action=listPosts&id=<?= $post->getTopic()->getId() ?>'><?= $post->getTopic()->getTitle() ?></a></td>
            <td><?= $post->getContent() ?></td>
            <td><?= $post->getCreationdate()?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<div class='userRight'>
        <p><?= $user->getUsername()?>'s page</p>
        <p>joined: <?= $user->getCreationdate() ?></p>
    <?php if($user == \App\Session::getUser()){ ?>
        <p><a href='index.php?ctrl=security&action=changePassword&id=<?= $user->getId()?>'>Modify your password</a></p>
    <?php } ?>
</div>



