<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/tourLocationService.php';
require_once __DIR__ . '/../services/tourSessionService.php';




class TourTicketController extends Controller{
    private $tourLocationService;
    private $tourSessionService;
    public function __construct(){
        $this->tourLocationService = new TourLocationService();
        $this->tourSessionService = new TourSessionService();
    }


    public function index(){
        if (!isset($_SESSION['USER_ID']) and !isset($_SESSION['TEMP_ID'])){
            $_SESSION['TEMP_ID'] = random_int(100000, 999999);
        }
        require __DIR__ . '/../views/tourTicket/index.php';
    }

    public function overview(){
        if (!isset($_SESSION['USER_ID']) or !isset($_SESSION['TEMP_ID'])){
            header('Location: 404');
            exit();
        }

        if (isset($_GET['id'])){

        }
        require __DIR__ . '/../views/tourTicket/overview.php';
    }
}