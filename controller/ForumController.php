<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Entities\Post;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\UserManager;

class ForumController extends AbstractController implements ControllerInterface
{

    public function index()
    {
        return [
            "view" => VIEW_DIR . "home.php"
        ];
    }

    public function listCategories()
    {
        $categoryManager = new CategoryManager();

        return [
            "view" => VIEW_DIR . "forum/listCategories.php",
            "data" => [
                "categories" => $categoryManager->findAll(['name', 'ASC'])
            ]
        ];
    }

    public function listTopics($id)
    {
        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/listTopics.php",
            "data" => [
                "topics" => $topicManager->findTopics($id, ['a.creationdate', 'DESC'])
            ]
        ];

    }

    public function listPosts($id)
    {
        $postManager = new PostManager();

        return [
            "view" => VIEW_DIR . "forum/listPosts.php",
            "data" => [
                "posts" => $postManager->findPosts($id, ['creationdate', 'ASC'])
            ]
        ];



    }

    public function userProfile($id)
    {

        $userManager = new UserManager();

        return [
            "view" => VIEW_DIR . "forum/userProfile.php",
            "data" => [
                "user" => $userManager->findOneById($id)
            ]
        ];
    }


    public function addTopic($id){
        if(isset($_POST['submit'])){
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //checking there are no null or false value after filter
            if($title){
                $title = $_REQUEST["title"];
                $content = $_REQUEST["content"];
            }
        }
        
        else {
            echo 'error';
            die;
        }

        $data =["title"=>$title, 'user_id'=>1, 'category_id'=>$id];
        $topicManager = new TopicManager();
        $idT = $topicManager->add($data);

        
        $data =["content"=>$content, 'user_id'=>1, 'topic_id'=>$idT];
        $postManager = new PostManager();
        $postManager->add($data);


        header("Location: index.php?ctrl=forum&action=listPosts&id=".$idT);

        
    }

    public function addPost($id){
        if(isset($_POST['submit'])){
            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            //checking there are no null or false value after filter
            if($content){
                $content = $_REQUEST["content"];
            }
        }
        
        else {
            echo 'error';
            die;
        }

        $data =["content"=>$content, 'user_id'=>1, 'topic_id'=>$id];
        
        $postManager = new PostManager();
        $postManager->add($data);

        header("Location: index.php?ctrl=forum&action=listPosts&id=".$id);
        
    }

    public function deletePost($id){

        $postManager = new PostManager();
        $postManager->delete($id);
        
        header("Location: index.php?ctrl=forum&action=listPosts&id=7");
    }

    public function deleteTopic($id){

        $topicManager = new TopicManager();
        $topicManager->delete($id);

        header("Location: index.php?ctrl=forum&action=listTopics&id=1");
    }

}