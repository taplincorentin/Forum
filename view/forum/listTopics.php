<?php

$topics = $result["data"]['topics'];

?>

<h1>liste topics</h1>

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