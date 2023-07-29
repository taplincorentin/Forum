<?php

$user = $result["data"]['user'];
$posts = $result["data"]["posts"];

?>
<div class='userMain'>

    <h1>LATEST ACTIVITY</h1>


        <?php //get each postInfos and display
        foreach ($posts as $post) { ?>

            <table style="width:100%">
                <tr>
                    <th colspan="2" style='background-color: orange; color:white;'>
                        <?= $post->getCreationdate()?>
                    </th>
                </tr>
                <tr>
                    <td style="width:25%">
                        <a href='index.php?ctrl=forum&action=listPosts&id=<?= $post->getTopic()->getId() ?>'><?= $post->getTopic()->getTitle() ?></a>
                    </td>
                    <td>
                        <?= $post->getContent() ?>
                    </td>    
                </tr>
            </table>

        <?php } ?>

</div>

<div class='userRight'>
        <p><?= $user->getUsername()?>'s page</p>
        <p>joined: <?= $user->getCreationdate() ?></p>
    <?php if($user == \App\Session::getUser()){ ?>
        <p><a href='index.php?ctrl=security&action=changePassword&id=<?= $user->getId()?>'><i class="fa-solid fa-pen-to-square"></i>Password</a></p>
    <?php } ?>
</div>



