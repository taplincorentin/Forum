<?php

$posts = $result["data"]['posts'];
$topic = $posts->current()->getTopic();

?>
<!-- show post's topic title and topic's category name-->
<h1><a href='index.php?ctrl=forum&action=listTopics&id=<?= $topic->getCategory()->getId()?>'><?= $topic->getCategory()->getName()?></a></h1>
<h2><?= $topic->getTitle() ?></h2>

<?php
    
    if($topic->getLocked()==0 && (\App\Session::getUser()== $topic->getUser() or \App\Session::isAdmin())){
        
        
?>
        <a href="index.php?ctrl=forum&action=lockTopic&id=<?=$id?>">
            lock topic
        </a>
<?php } ?>
<div class ='posts'>
<?php //get each postInfos and display
foreach ($posts as $post) {
?>
    <table style="width:100%">
        <tr>
            <th colspan="2"><?= $post->getCreationdate()?></th>
        </tr>
        <tr>
            <td style="width:25%">
                <a href='index.php?ctrl=forum&action=userProfile&id=<?= $post->getUser()->getId() ?>'><?= $post->getUser()->getUsername() ?></a><br>
                <?= $post->getUser()->getRole() ?><br>
                joined : <?= $post->getUser()->getCreationdate() ?>
            </td>
            <td><?= $post->getContent() ?></td>
            <td>
                <?php if(App\Session::getUser()->getId()==$post->getUser()->getId() or App\Session::isAdmin()){?>
                        <a href="index.php?ctrl=forum&action=editPost&id=<?= $post->getId() ?>">o</a>
                    <?php } ?>
            </td>
            <td>
                <?php if($post->getOp()==0 && (App\Session::getUser()->getId()==$post->getUser()->getId() or App\Session::isAdmin())){ ?>
                        <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">x</a>
                    <?php } ?>
            </td>
        </tr>
    </table>
    <p>
        
        
        
        
        
        
    </p>
<?php } ?>
</div>

<?php
//check if topic is locked before showing post form
if($post->getTopic()->getLocked()==0){ 
?>


    <form action="index.php?ctrl=forum&action=addPost&id=<?=$id?>" method="post">
        <div> 
            <p>
                <textarea name = 'content' placeholder="your comment"></textarea>
            </p>
            <p>
                <input type='submit' name='submit' value="Add post">
            </p>
        </div>
    </form>

<?php
}

else{
?>

    <h3>topic is locked</h3>
    
    <?php if(App\Session::isAdmin()){    ?>
        <a href="index.php?ctrl=forum&action=unlockTopic&id=<?= $topic->getId() ?>">unlock topic</a>
    

<?php
    }
}