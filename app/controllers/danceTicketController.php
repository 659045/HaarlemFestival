<?php
require_once __DIR__ . '/controller.php';





class DanceTicketController extends Controller{
    public function index(){      
    if (!isset($_SESSION['USER_ID']) and !isset($_SESSION['TEMP_ID'])){
        $_SESSION['TEMP_ID'] = random_int(100000, 999999);
    }
    if (isset($_SESSION['USER_ID'])) {
        $_SESSION['TEMP_ID'] = null;
    }
        require __DIR__ . '/../views/danceTicket/index.php';
    }

    public function overview(){
        if (!isset($_SESSION['USER_ID']) or !isset($_SESSION['TEMP_ID'])){
            header('Location: 404');
            exit();
        }

        if (isset($_GET['id'])){
            
        }
        require __DIR__ . '/../views/danceTicket/overview.php';
    }
}