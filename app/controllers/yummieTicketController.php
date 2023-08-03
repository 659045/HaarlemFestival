<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/reservationService.php';
require_once __DIR__ . '/../services/restaurantSessionService.php';
require_once __DIR__ . '/../services/restaurantService.php';



class YummieTicketController extends Controller{
    private $reservationService;
    private $sessionService;
    private $restaurantService;

    public function __construct(){
        $this->reservationService = new ReservationService();
        $this->sessionService = new RestaurantSessionService();
        $this->restaurantService = new RestaurantService();
    }


    public function index(){
        if (!isset($_SESSION['USER_ID']) and !isset($_SESSION['TEMP_ID'])){
            $_SESSION['TEMP_ID'] = random_int(100000, 999999);
        }
        if (isset($_SESSION['USER_ID'])) {
            $_SESSION['TEMP_ID'] = null;
        }
        require __DIR__ . '/../views/yummieTicket/index.php';
    }

    public function overview(){

        if (isset($_GET['id'])){
            $reservation = $this->reservationService->get_ReservationById($_GET['id']);
            $session = $this->sessionService->get_RestaurantSessionById($reservation->get_session_id());
            $restaurant = $this->restaurantService->get_RestaurantById($session->get_restaurant_id());    

            $date = $session->get_session_date();
            $startTime = $session->get_session_startTime();
            $endTime = $session->get_session_endTime();
            $restaurantName = $restaurant->get_name();
            $adults = $reservation->get_adults();
            $kids = $reservation->get_kids();
            $comment = $reservation->get_comment();
        }
        require __DIR__ . '/../views/yummieTicket/overview.php';
    }
}