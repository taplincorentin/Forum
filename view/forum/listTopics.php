<?php

$topics = $result["data"]['topics'];

?>

<h1><?= $topics->current()->getCategory()->getName() ?></h1>

<div class = 'topics'>
<table>
  <tr>
    <th>Title</th>
    <th>Created on</th>
    <th>By</th>
    <th>Number posts</th>
    <th></th>
  </tr>

<?php

//show topics info


foreach ($topics as $topic) {
    ?>
    <tr>    
        <td><a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'><?= $topic->getTitle() ?></a></td>
        <td><?= $topic->getCreationdate() ?></td>
        <td><a href='index.php?ctrl=forum&action=userProfile&id=<?= $topic->getUser()->getId() ?>'><?= $topic->getUser()->getUsername() ?></a></td>
        <td><?= $topic->getNbPosts() ?></td>

        <?php
        if(App\Session::getUser()->getId()==$topic->getUser()->getId() or \App\Session::isAdmin()){
        ?>
        <td><a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>">x</a></td>
        <?php } ?>
    </tr>

    <?php 
}
?>
</table>
</div>
<!-- add new topic form with first comment-->
<div class = 'newTopicForm'>
<form action="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" method="post">
    <div> 
        <p>
            <label>Title</label>
            <input type='text' name='title'>
        </p>
        <p>
            <label>First post</label>
            <textarea name = 'content'></textarea>
        </p>
        <p>
            <input type='submit' name='submit' value="Add topic">
        </p>
    </div>
</form>
</div>


