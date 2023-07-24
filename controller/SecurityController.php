<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicCategory;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;

    class SecurityController extends AbstractController implements ControllerInterface{
        
        public function index(){
            return [
            "view" => VIEW_DIR . "home.php"
            ];
        }

        public function register(){
            if(isset($_POST['submit'])){
                $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                
                if($username && $email && $password && $password2){
                    $userManager = new UserManager;
                    //if username or email exists
                    if($userManager->usernameExists($username) or $userManager->emailExists($email)){
                        return [
                            //go to error page
                            "view" => BASE_DIR . "/security/error.php", 
                            "data" =>["error" => 'username or email already used']
                        ];
                    }
                    else {
                        if($password == $password2 && strlen($password) > 7){
                            $data =["username"=>$username, 'email'=>$email , "password"=> password_hash($password, PASSWORD_DEFAULT)];
                            $userManager->add($data);
                            header("Location:./view/security/login.php");
                        }
                        else{
                            return [
                                //go to error page
                                "view" => BASE_DIR . "/security/error.php", 
                                "data" =>["error" => "two passwords aren't the same or not enough characters "]
                            ];
                        }
                    }
                }
            }
        }

    }