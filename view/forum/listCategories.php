<?php

$categories = $result["data"]['categories'];

?>

<h1>category list</h1>

<?php
foreach ($categories as $category) {

    ?>
    <p><a href='index.php?ctrl=forum&action=listTopics&id=<?= $category->getId() ?>'><?= $category->getName() ?></a></p>
    <?php
}