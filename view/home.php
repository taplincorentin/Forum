<h1>WELCOME TO OUR FORUM</h1>



<p>Welcome, if you cannot find what you are looking for, make your own post!
    Sign in if you want to access the forum.
</p>
<?php
    if(isset($_SESSION['user'])){
?>
        <a href="index.php?ctrl=forum&action=listCategories">Categories</a>
    <?php }

