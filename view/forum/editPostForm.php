<?php

$post = $result["data"]['post'];

?>

<h1>modify your comment</h1>

<form action="index.php?ctrl=forum&action=editPost&id=<?=$id?>" method="post">
    <div> 
        <p>
            <textarea name = 'content'><?= $post->getContent() ?></textarea>
        </p>
        <p>
            <input type='submit' name='submit' value="edit post">
        </p>
    </div>
</form>