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
if(\App\Session::isAdmin()){
?>
    <!-- add new category if admin-->

    <form action="index.php?ctrl=forum&action=addCategory&id=<?=$id?>" method="post">
        <div> 
            <p>
                <label>category name</label>
                <input type='text' name='name'>
            </p>
            <p>
                <input type='submit' name='submit' value="Add category">
            </p>
        </div>
    </form>

<?php }