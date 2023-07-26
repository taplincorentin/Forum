<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
use Model\Entities\User;
use Model\Managers\UserManager;
    use Model\Managers\TopicCategory;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){
            
           
                return [
                    "view" => VIEW_DIR."home.php"
                ];
            }
            
        
   
        public function users(){
            if(\App\Session::isAdmin()){

                $manager = new UserManager();
                $users = $manager->findAll(['creationdate', 'DESC']);

                return [
                    "view" => BASE_DIR."/security/users.php",
                    "data" => [
                        "users" => $users
                    ]
                ];
            }

            else {
                return [
                    //go to error page
                    "view" => BASE_DIR . "/security/error.php", 
                    "data" =>["error" => "you don't have the rights, son!"]
                ];
            }
        }

        public function deleteUser($id){
            if(\App\Session::isAdmin()){
                $userManager = new UserManager();
                $userManager->delete($id);

                header("Location: http://forum.test/index.php?ctrl=home&action=users");
            }
            
            else{
                return [
                    //go to error page
                    "view" => BASE_DIR . "/security/error.php", 
                    "data" =>["error" => "problem in input of name"]
                ];
            }
        }

        public function forumRules(){
            
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }

        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
