<h1>BIENVENUE SUR LE FORUM</h1>



<p>Bienvenue sur notre forum. Si vous ne trouvez pas ce que vous voulez, créez le</p>
<?php
    if(isset($_SESSION['user'])){
?>
        <a href="index.php?ctrl=forum&action=listCategories">Categories</a>
    <?php }

