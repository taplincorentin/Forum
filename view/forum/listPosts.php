<?php
    $posts = $result["data"]['posts'];
    $topic = $posts->current()->getTopic();
?>

<!-- show post's topic title and topic's category name-->
<div class ='postsMain'>
    <h1><a href='index.php?ctrl=forum&action=listTopics&id=<?= $topic->getCategory()->getId()?>'><?= $topic->getCategory()->getName()?></a></h1>
    <h2><?= $topic->getTitle() ?></h2>

    <?php if($topic->getLocked()==0 && (\App\Session::getUser()== $topic->getUser() or \App\Session::isAdmin())){ ?>
        <a href="index.php?ctrl=forum&action=lockTopic&id=<?=$id?>">
            <i class="fa-solid fa-lock"></i>LOCK
        </a>
<?php } ?>

<?php //get each postInfos and display
foreach ($posts as $post) {
?>
    <table style="width:100%">
        <tr>
            <th colspan="2" style='background-color: orange; color:white;'>
            
                <?= $post->getCreationdate()?>

                <div class='deleteButton'>
                    <?php if($post->getOp()==0 && (App\Session::getUser()->getId()==$post->getUser()->getId() or App\Session::isAdmin())){ ?>
                            <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>"><i class="fa-solid fa-xmark" style="color: #ffffff;"></i></a>
                    <?php } ?>
                </div>

                <div class='editButton'><?php if(App\Session::getUser()->getId()==$post->getUser()->getId() or App\Session::isAdmin()){?>
                        <a href="index.php?ctrl=forum&action=editPost&id=<?= $post->getId() ?>"><i class="fa-solid fa-pen fa-xs" style="color: #ffffff;"></i></a>
                    <?php } ?>
                </div>

            </th>
        </tr>
        <tr>
            <td style="width:25%">
                <a href='index.php?ctrl=forum&action=userProfile&id=<?= $post->getUser()->getId() ?>'><?= $post->getUser()->getUsername() ?></a><br>
                <?= $post->getUser()->getRole() ?><br>
                joined : <?= $post->getUser()->getCreationdate() ?>
            </td>
            <td><?= $post->getContent() ?></td>
            
            
        </tr>
    </table>

<?php } ?>
</div>




<div class='postsRight'>

    <?php
    //check if topic is locked before showing post form
    if($post->getTopic()->getLocked()==0){ ?>

        <h2>NEW POST</h2>
        <form action="index.php?ctrl=forum&action=addPost&id=<?=$id?>" method="post">
            <div> 
                <p>
                    <textarea name = 'content'></textarea>
                </p>
                <p>
                    <input type='submit' name='submit' value="ADD">
                </p>
            </div>
        </form>
    <?php }

    else{ ?>

        <h3>TOPIC IS LOCKED</h3>
    
        <?php if(App\Session::isAdmin()){    ?>
            <a href="index.php?ctrl=forum&action=unlockTopic&id=<?= $topic->getId() ?>"><i class="fa-solid fa-unlock"></i>UNLOCK</a>
    
        <?php }
    } ?>
</div>