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

    public function listCategories(){
        //checking there is a user in session
        if(isset($_SESSION['user'])){
            $categoryManager = new CategoryManager();

            return [
                "view" => VIEW_DIR . "forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll(['name', 'ASC'])
                ]
            ];
        }

        else {
            return [
                "view" => BASE_DIR . "/security/login.html",
                ];
        }
    }

    public function listTopics($id)
    {   
        if(isset($_SESSION['user'])){
            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR . "forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findTopics($id, ['a.creationdate', 'DESC'])
                ]
            ];
        }

        else {
            return [
                "view" => BASE_DIR . "/security/login.html",
                ];
        }
    }

    public function listPosts($id){   
        if(isset($_SESSION['user'])){
            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR . "forum/listPosts.php",
                "data" => [
                    "posts" => $postManager->findPosts($id, ['creationdate', 'ASC'])
                ]
            ];
        }

        else {
            return [
                "view" => BASE_DIR . "/security/login.html",
                ];
        }

    }

    public function userProfile($id){
        //checking there is a user in session
        if(isset($_SESSION['user'])){
            $userManager = new UserManager();

            return [
                "view" => VIEW_DIR . "forum/userProfile.php",
                "data" => [
                    "user" => $userManager->findOneById($id)
                ]
            ];
        }

        else {
            return [
                "view" => BASE_DIR . "/security/login.html",
                ];
        }
    }

    public function addCategory(){
        //checking user in session is an admin
        if(\App\Session::isAdmin()){
            //testing added data
            if(isset($_POST['submit'])){
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            
                //checking there are no null or false value after filter
                if($name && $title && $content){
                    //category values
                    $data =["name"=>$name];
                    $categoryManager = new CategoryManager();
                    $idC = $categoryManager->add($data);

                    //topic values
                    $data =["title"=>$title, 'user_id'=>\App\Session::getUser()->getId(), 'category_id'=>$idC];
                    $topicManager = new TopicManager();
                    $idT = $topicManager->add($data);

                    //first post values
                    $data =["content"=>$content, 'user_id'=>\App\Session::getUser()->getId(), 'topic_id'=>$idT, 'op'=>1];
                    $postManager = new PostManager();
                    $postManager->add($data);


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
        
    }

    public function addTopic($id){
        //checking there is a user in session
        if(isset($_SESSION['user'])){
            //testing added data
            if(isset($_POST['submit'])){
                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                //checking there are no null or false value after filter
                if($title && $content){
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

                else {
                    return [
                        //go to error page
                        "view" => BASE_DIR . "/security/error.php", 
                        "data" =>["error" => "problem in input values"]
                    ];
                }
            }
        }        
        
        else {
            return [
                "view" => BASE_DIR . "/security/login.html",
                ];
        }
    }

    public function addPost($id){
        if(isset($_SESSION['user'])){
            //testing added data
            if(isset($_POST['submit'])){
                $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            
                //checking there are no null or false value after filter
                if($content){
                    $data =["content"=>$content, 'user_id'=>\App\Session::getUser()->getId(), 'topic_id'=>$id];
        
                    $postManager = new PostManager();
                    $postManager->add($data);

                    header("Location: index.php?ctrl=forum&action=listPosts&id=".$id);
                }

                else {
                    return [
                        //go to error page
                        "view" => BASE_DIR . "/security/error.php", 
                        "data" =>["error" => "problem in input values"]
                    ];
                }
            }
        }

        else {
            return [
                "view" => BASE_DIR . "/security/login.html",
                ];
        }
    }


    public function deletePost($id){

        $postManager = new PostManager();
        $post = $postManager->findOneById($id);
        
        if(\App\Session::getUser()==$post->getUser() or \App\Session::isAdmin()){
            
            //get topic id for redirection
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

        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);

        if(\App\Session::getUser()==$topic->getUser() or \App\Session::isAdmin()){
            
            //get category id for redirection
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

        $postManager = new PostManager();
        $post = $postManager->findOneById($id);

        if(\App\Session::getUser()==$post->getUser() or \App\Session::isAdmin()){        
            
            //testing edited data
            if(isset($_POST['submit'])){
                $content = filter_input(INPUT_POST, "content", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            
                //checking there are no null or false value after filter
                if($content){
                    $content = $_REQUEST["content"];
                } 

                //get topic id for redirection
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
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        if(\App\Session::getUser()==$topic->getUser() or \App\Session::isAdmin()){  
            
            
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

    public function unlockTopic($id){
        $topicManager = new TopicManager();
        $topic = $topicManager->findOneById($id);
        if(\App\Session::isAdmin()){  
            
            
            $topicManager->unlockTopic($id);

            header("Location: index.php?ctrl=forum&action=listPosts&id=".$id);
        }

        else {
            return [
                //go to error page
                "view" => BASE_DIR . "/security/error.php", 
                "data" =>["error" => "not an admin"]
            ];
        }
    }

}