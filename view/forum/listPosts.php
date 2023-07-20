<?php

$posts = $result["data"]['posts'];


?>
<h1><?= $posts->current()->getTopic()->getCategory()->getName()?></h1>
<h2><?= $posts->current()->getTopic()->getTitle() ?></h2>

<?php
foreach ($posts as $post) {
    ?>
    <p>
        <?= $post->getUser()->getUsername() ?>
        <?= $post->getContent() ?>
        <?= $post->getCreationdate() ?>
        <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">x</a>
        <a href="index.php?ctrl=forum&action=editPostForm&id=<?= $post->getId() ?>">o</a>
    </p>
    <?php
}

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