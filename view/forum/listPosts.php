<?php

$posts = $result["data"]['posts'];

?>

<h1>posts</h1>

<?php
foreach ($posts as $post) {

    ?>
    <p>
        <?= $post->getContent() ?>
        <?= $post->getId() ?>
    </p>
    <?php
}