<?php
if(\App\Session::isAdmin()){
?>
    <!-- add new category if admin-->
<div class='logForm'>
    <form action="index.php?ctrl=forum&action=addCategory&id=<?=$id?>" method="post">
        <div> 
            <p>
                <label>NEW CATEGORY NAME</label>
                <input type='text' name='name'>
            </p>
            <p>
                <label>FIRST TOPIC TITLE</label>
                <input type='text' name='title'>
            </p>
            <p>
                <label>FIRST POST CONTENT</label>
                <textarea name = 'content'></textarea>
            </p>
            <p>
                <input type='submit' name='submit' value="ADD CATEGORY">
            </p>
        </div>
    </form>
</div>
<?php }