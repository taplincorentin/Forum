<?php

$topics = $result["data"]['topics'];

?>
<!-- show topics info-->
<div class = 'topicsMain'>
    <h1><?= $topics->current()->getCategory()->getName() ?></h1>


    
        <?php //get eack topicsInfos
        foreach ($topics as $topic) { ?>
        <table style="width:100%">
        <tr>
            <th colspan="3" style='background-color: orange; color:white;'>

                <?= $topic->getCreationdate()?>

                <div class='deleteButton'><?php if(App\Session::getUser()->getId()==$topic->getUser()->getId() or \App\Session::isAdmin()){ ?>
                        <a href="index.php?ctrl=forum&action=deleteTopic&id=<?= $topic->getId() ?>"><i class="fa-solid fa-pen fa-xs" style="color: #ffffff;"></i></a>
                    <?php } ?>
                </div>
            </th>
        </tr>
        <tr>    
            <td style="width:50%"><a href='index.php?ctrl=forum&action=listPosts&id=<?= $topic->getId() ?>'><?= $topic->getTitle() ?></a></td>
            
            <td><a href='index.php?ctrl=forum&action=userProfile&id=<?= $topic->getUser()->getId() ?>'>by <?= $topic->getUser()->getUsername() ?></a></td>
            
            <td><?= $topic->getNbPosts() ?> post(s)</td>
        </tr>
        
    </table>
    <?php } ?>
</div>



<!-- add new topic form with first comment-->
<div class = 'topicsRight'>
    <h3>NEW TOPIC</h3>
    <form action="index.php?ctrl=forum&action=addTopic&id=<?=$id?>" method="post">
        <div> 
            <p>
                <label>TITLE</label>
                <input type='text' name='title'>
            </p>
            <p>
                <label>FIRST POST</label>
                <textarea name = 'content'></textarea>
            </p>
            <p>
                <input type='submit' name='submit' value="ADD">
            </p>
        </div>
    </form>
</div>


