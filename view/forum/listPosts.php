<?php

$posts = $result["data"]['posts'];

/*<?= $posts->current()->getTopic()->getTitle() ?>*/
?>

<h1><?= $posts->current()->getTopic()->getTitle() ?></h1>

<?php
foreach ($posts as $post) {
    ?>
    <p>
        <?= $post->getUser()->getUsername() ?>
        <?= $post->getContent() ?>
        <?= $post->getCreationdate() ?>
        <a href="index.php?ctrl=forum&action=deletePost&id=<?= $post->getId() ?>">x</a>
    </p>
    <?php
}

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