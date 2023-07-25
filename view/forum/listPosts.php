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
<?php
    }
//get each postInfos and display
foreach ($posts as $post) {
    ?>
    <p>
        <a href='index.php?ctrl=forum&action=userProfile&id=<?= $post->getUser()->getId() ?>'><?= $post->getUser()->getUsername() ?></a>
        <?= $post->getContent() ?>
        <?= $post->getCreationdate()?>
        <?php
        if(App\Session::getUser()->getId()==$post->getUser()->getId()){
        ?>
        <a href="index.php?ctrl=forum&action=editPost&id=<?= $post->getId() ?>">o</a>
        
        <?php
        }
            if($post->getOp()==0 && App\Session::getUser()->getId()==$post->getUser()->getId()){
        ?>
                <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">x</a>
        <?php
            }
        ?>
        
    </p>
    <?php
}
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

<?php
}