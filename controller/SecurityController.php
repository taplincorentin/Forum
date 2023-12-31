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
            //checking there is a user in session
            if(isset($_SESSION['user'])){
                $categoryManager = new CategoryManager();

                return [
                    "view" => VIEW_DIR . "home.php",
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

        public function register(){
            if((isset($_SESSION['user']))){
                return [
                    "view" => VIEW_DIR . "home.php"
                    ];
            }
            else{
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
                            header("Location: /security/login.html");
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
                else {
                    return [
                        //go to error page
                        "view" => BASE_DIR . "/security/error.php", 
                        "data" =>["error" => "problem in input of values"]
                    ];
                }
            }
            else {
                return [
                    "view" => BASE_DIR . "/security/register.html",
                    ];
            }
            }
        }

        public function login(){

            if((isset($_SESSION['user']))){
                return [
                    "view" => VIEW_DIR . "home.php"
                    ];
            }

            if(isset($_POST['submit'])){

                $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

                if($email && $password){
                    $userManager = new UserManager;
                    $emailCheck = $userManager->emailExists($email);
                    
                    if($emailCheck){ //if email exists in DB
                        $hash = $emailCheck[0]['password'];
                        
                        if(password_verify($password, $hash)){
                            $id_user = $emailCheck[0]['id_user'];
                            $user = $userManager->findOneById($id_user);
                            $_SESSION['user'] = $user;

                            header("Location: index.php");
                        }
                        else{
                            return [
                                //go to error page
                                "view" => BASE_DIR . "/security/error.php", 
                                "data" =>["error" => "wrong password"]
                            ];
                        }
                    }
                    else{
                        return [
                            //go to error page
                            "view" => BASE_DIR . "/security/error.php", 
                            "data" =>["error" => "user with this email doesn't exist"]
                        ];
                    }
                }
                else{
                    return [
                        //go to error page
                        "view" => BASE_DIR . "/security/error.php", 
                        "data" =>["error" => "error in username or password"]
                    ];
                }
            }

            else {
                return [
                    "view" => BASE_DIR . "/security/login.html",
                    ];
            }
        }

        public function logout(){
            

                session_unset();
                session_destroy();

                return [
                    "view" => BASE_DIR . "/security/login.html",
                    ];
            }
        
        public function changePassword($id){
            
            $userManager = new UserManager;
            $user = $userManager->findOneById($id);
            

            if(\App\Session::getUser()==$user){     

                if(isset($_POST['submit'])){
                    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                    $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                
                    if($password && $password2){
                        //if username or email exists
                        if($password == $password2 && strlen($password) > 7){

                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            
                            $userManager->updatePassword($id,$hash);

                            //make user logout
                            session_unset();
                            session_destroy();

                            header("Location: /security/login.html");
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
                else{
                    return [
                        "view" => BASE_DIR . "/security/editPasswordForm.php",
                        "data" => [
                            "post" => $userManager->findOneById($id)
                        ]
                    ];
                }
            }
            else {
                return [
                    //go to error page
                    "view" => BASE_DIR . "/security/error.php", 
                    "data" =>["error" => "not right user"]
                ];
            }
        }        
    }