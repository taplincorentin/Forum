<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["date_of_creation", "DESC"])
                ]
            ];
        
        }

        public function listCategories(){
            $categoryManager = new CategoryManager();
 
            return [
                "view" => VIEW_DIR."forum/listCategories.php",
                "data" => [
                    "categories" => $categoryManager->findAll()
                ]
            ];
        }

        public function listTopics(){
          

            $topicManager = new TopicManager();
 
             return [
                 "view" => VIEW_DIR."forum/listTopics.php",
                 "data" => [
                     "topics" => $topicManager->findAll(["date_of_creation", "DESC"])
                 ]
             ];
         
         }

        

    }
