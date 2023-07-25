<?php

namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;

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

    public function addCategory(){
        //testing added data
        if(isset($_POST['submit'])){
            $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            
            //checking there are no null or false value after filter
            if($name){
                $data =["name"=>$name];
                $categoryManager = new CategoryManager();
                $idC = $categoryManager->add($data);

                header("Location: index.php?ctrl=forum&action=listTopics&id=".$idC);
            }
        }
        
        else {
            return [
                //go to error page
                "view" => BASE_DIR . "/security/error.php", 
                "data" =>["error" => "problem in input of name"]
            ];
        }
        
    }

    public function addTopic($id){
        //testing added data
        if(isset($_POST['submit'])){
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

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

        //topic values
        $data =["title"=>$title, 'user_id'=>\App\Session::getUser()->getId(), 'category_id'=>$id];
        $topicManager = new TopicManager();
        $idT = $topicManager->add($data);

        //first post values
        $data =["content"=>$content, 'user_id'=>\App\Session::getUser()->getId(), 'topic_id'=>$idT, 'op'=>1];
        $postManager = new PostManager();
        $postManager->add($data);


        header("Location: index.php?ctrl=forum&action=listPosts&id=".$idT);

        
    }

    public function addPost($id){
        //testing added data
        if(isset($_POST['submit'])){
            $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            
            //checking there are no null or false value after filter
            if($content){
                $content = $_REQUEST["content"];
            }
        }
        
        else {
            echo 'error';
            die;
        }

        $data =["content"=>$content, 'user_id'=>\App\Session::getUser()->getId(), 'topic_id'=>$id];
        
        $postManager = new PostManager();
        $postManager->add($data);

        header("Location: index.php?ctrl=forum&action=listPosts&id=".$id);
        
    }


    public function deletePost($id){

        
        if(\App\Session::getUser()->getId()==$id or \App\Session::isAdmin()){
            $postManager = new PostManager();
            //get topic id for redirection
            $post = $postManager->findOneById($id);
            $topicId = $post->getTopic()->getId();
        
            $postManager->delete($id);
        
            header("Location: index.php?ctrl=forum&action=listPosts&id=".$topicId);
        }

        else {
            return [
                //go to error page
                "view" => BASE_DIR . "/security/error.php", 
                "data" =>["error" => "not an admin or post creator"]
            ];
        }
    }


    public function deleteTopic($id){

        if(\App\Session::getUser()->getId()==$id or \App\Session::isAdmin()){
            
            $topicManager = new TopicManager();

            //get category id for redirection
            $topic = $topicManager->findOneById($id);
            $categoryId = $topic->getCategory()->getId();

            $topicManager->delete($id);

            header("Location: index.php?ctrl=forum&action=listTopics&id=".$categoryId);
        }
        else {
            return [
                //go to error page
                "view" => BASE_DIR . "/security/error.php", 
                "data" =>["error" => "not an admin or topic creator"]
            ];
        }
    }


    public function editPost($id){

        if(\App\Session::getUser()->getId()==$id or \App\Session::isAdmin()){        
            $postManager = new PostManager();
            //testing edited data
            if(isset($_POST['submit'])){
                $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            
                //checking there are no null or false value after filter
                if($content){
                    $content = $_REQUEST["content"];
                } 

                //get topic id for redirection
                $post = $postManager->findOneById($id);
                $idT = $post->getTopic()->getId();

                $postManager->updatePost($id, $content);

                header("Location: index.php?ctrl=forum&action=listPosts&id=".$idT);
            }

            else {
                return [
                    "view" => VIEW_DIR . "forum/editPostForm.php",
                    "data" => [
                        "post" => $postManager->findOneById($id)
                    ]
                ];
            }
        }

        else {
            return [
                //go to error page
                "view" => BASE_DIR . "/security/error.php", 
                "data" =>["error" => "not an admin or post creator"]
            ];
        }

    }     
    
    
    public function lockTopic($id){

        if(\App\Session::getUser()->getId()==$id or \App\Session::isAdmin()){  
            
            $topicManager = new TopicManager();
            $topicManager->lockTopic($id);

            header("Location: index.php?ctrl=forum&action=listPosts&id=".$id);
        }

        else {
            return [
                //go to error page
                "view" => BASE_DIR . "/security/error.php", 
                "data" =>["error" => "not an admin or topic creator"]
            ];
        }
    }

}