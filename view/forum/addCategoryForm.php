<?php
if(\App\Session::isAdmin()){
?>
    <!-- add new category if admin-->
<div>
    <form action="index.php?ctrl=forum&action=addCategory&id=<?=$id?>" method="post">
        <div> 
            <p>
                <label>category name</label>
                <input type='text' name='name'>
            </p>
            <p>
                <label>topic title</label>
                <input type='text' name='title'>
            </p>
            <p>
                <label>first post</label>
                <textarea name = 'content' placeholder="your comment"></textarea>
            </p>
            <p>
                <input type='submit' name='submit' value="Add category">
            </p>
        </div>
    </form>
</div>
<?php }