<?php 
    require_once __DIR__ . '/controller.php';
    require_once __DIR__ . '/../services/userService.php';
    require_once __DIR__ . '/../models/user.php';
    class LoginController extends Controller{
        public function index(){

            if(isset($_SESSION['USER_ID'])){
                session_destroy();
                header('refresh:0;url=/home');
                return;
            }
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $this->handlePost();
                return;
            }
            
            $this->displayView($this);
        }

        function handlePost(){
            $email = $_POST['mail'];
            $passwd = md5($_POST['passwd']);


            $userService = new UserService();
            if($userService->verify_UserCredentials($email, $passwd)){
                $user = $userService->get_UserByEmail($email);
                //set uid for header
                $_SESSION['USER_ID'] = $user->get_uid();
                $_SESSION['USER_ROLE'] = $user->get_role();
                $_SESSION['USER_MAIL'] = $user->get_email();
                $_SESSION['USER_USERNAME'] = $user->get_username();
                header('Location: /userPanel');
                return;
            }
            else{
                $_SESSION['msg'] = 'incorrect credentials';
                require __DIR__ . '/../views/login/index.php';
            }
        }
    }

?>
