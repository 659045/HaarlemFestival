<?php
use Ramsey\Collection\Tool\ValueToStringTrait;
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/shoppingCartService.php';
require_once __DIR__ . '/../services/userService.php';
require_once __DIR__ . '/../services/ticketService.php';
require_once __DIR__ . '/../services/mailService.php';
require_once __DIR__ . '/../services/eventService.php';
require_once __DIR__ . '/../services/restaurantSessionService.php';
require_once __DIR__ . '/../services/danceSessionService.php';
require_once __DIR__ . '/../models/ticket.php';


class ShareCartController extends Controller
{
    public function index(){
        if (!isset($_GET['id'])) {
            header('Location: /home');
        }
        $this->displayView('shareCart');
    }
}