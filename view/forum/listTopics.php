<?php

$topics = $result["data"]['topics'];

?>

<h1><?= $topics->current()->getCategory()->getName() ?></h1>

<?php

foreach ($topics as $topic) {
    ?>
    <p>
        
        <a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'><?= $topic->getTitle() ?></a>
        <?= $topic->getCreationdate() ?>
        <a href='index.php?ctrl=forum&action=userProfile&id=<?= $topic->getUser()->getId() ?>'><?= $topic->getUser()->getUsername() ?></a>
    </p>
    <?php
}
?>
<form action="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" method="post">
    <div> 
        <p>
            <label>title</label>
            <input type='text' name='title'>
        </p>
        <p>
            <label>first post</label>
            <textarea name = 'content' placeholder="your comment"></textarea>
        </p>
        <p>
            <input type='submit' name='submit' value="Add topic">
        </p>
    </div>
</form>


