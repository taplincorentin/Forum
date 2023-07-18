<?php

$posts = $result["data"]['posts'];

?>

<h1>posts</h1>

<?php
foreach ($posts as $post) {
    var_dump($post);
    ?>
    <p>
        <?= $post->getCreationdate() ?>
        <?= $post->getUser()->getUsername() ?>
        <?= $post->getContent() ?>
        <?= $post->getId() ?>
    </p>
    <?php
}