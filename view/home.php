<div class='homeMain'>

    <h1>WELCOME TO OUR FORUM</h1>
    <p>Welcome, if you cannot find what you are looking for, make your own post!</p>

</div>

<?php if(isset($_SESSION['user'])){?>
<div class='homeRight'>

     
    <?php $categories = $result["data"]['categories']; ?>

    <a>CATEGORIES</a>

    <?php foreach ($categories as $category) { ?>
        <a href='index.php?ctrl=forum&action=listTopics&id=<?= $category->getId() ?>'><?= $category->getName() ?></a>
    <?php }

    if(\App\Session::isAdmin()){ ?>
        <a href='index.php?ctrl=forum&action=addCategory' style='background-color: grey !important;'>Add Category</a>
    <?php }        
} ?>


</div>