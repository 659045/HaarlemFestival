<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/restaurantService.php';
require_once __DIR__ . '/../services/restaurantSessionService.php';

class FoodController extends Controller
{
    private $restaurantService;
    private $restaurantSessionService;

    public function __construct()
    {
        $this->restaurantService = new RestaurantService();
        $this->restaurantSessionService = new RestaurantSessionService();
    }

    public function index()
    {
        $this->echoPage("food");
    }

    public function detailPage()
    {
        if (isset($_GET['id'])) {
            $restaurant = $this->restaurantService->get_RestaurantById($_GET['id']);
            $sessions = $this->restaurantSessionService->get_AllRestaurantSessionsByRestaurantId($_GET['id']);
            $restaurantSessions = array();
            $addedSessionTimes = array();
            foreach ($sessions as $session) {
                $sessionStartTime = $session->get_session_startTime();
                  
                if (!in_array($sessionStartTime, $addedSessionTimes)) {
                    $addedSessionTimes[] = $sessionStartTime;
                    $restaurantSessions[] = $session;
                }
            }
    
            $imageString = $restaurant->get_imagePath();
            $imagePaths = explode(":", $imageString);
        }
        require __DIR__ . '/../views/food/detailPage.php';
    }
}
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');

    * {
        padding: 0px;
        margin: 0px;
        /* outline: 1px solid red; */
    }
</style>

<body class="overflow-x-hidden bg-[#F7F7FB] flex flex-col items-center h-fit w-screen"></body>