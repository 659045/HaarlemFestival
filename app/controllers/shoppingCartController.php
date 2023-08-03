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
require_once __DIR__ . '/../services/qrCodeService.php';
require_once __DIR__ . '/../services/invoiceService.php';
require_once __DIR__ . '/../models/ticket.php';



class ShoppingCartController extends Controller
{
    public function index()
    {
        $this->checkPendingTickets();
        if (!isset($_SESSION['USER_ID']) and !isset($_SESSION['TEMP_ID'])){
            $_SESSION['TEMP_ID'] = random_int(100000, 999999);
        }
        if (isset($_SESSION['USER_ID'])) {
            $_SESSION['TEMP_ID'] = null;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['selectedTicket'])) {
                $this->assignTicketToUser();
            }
            if (isset($_POST['removePendingTicket'])) {
                $this->removePendingTicket($_POST['removePendingTicket']);
            }
        }
        $this->setAllAvailableTickets();
        $this->displayView('shoppingCart');
    }

    public function addTicket()
    {
        $ticketService = new TicketService();
        $ticket = $ticketService->get_TicketById($_POST['ticketId']);
        $shoppingCartService = new ShoppingCartService();
        $shoppingCartService->addTicket($ticket);
    }
    public function assignTicketToUser()
    { //this method is a mess but hey it workd.
        try {
            $ticketService = new TicketService();
            $eventService = new EventService();
            $danceService = new DanceSessionService();
            $restaurantService = new RestaurantSessionService();
            $ticket = new Ticket();
            $ticket->setEvent_Id($_POST['selectedTicket']);
            $ticket->setStatus('pending');
            $ticket->set_UserId($_SESSION['USER_ID']);
            $event = $eventService->get_EventYummieById($_POST['selectedTicket']);
            if ($event == null) {
                $event = $eventService->get_EventStrollById($_POST['selectedTicket']);
            }
            if ($event == null) {
                $event = $eventService->get_EventEDMById($_POST['selectedTicket']);
            }

            //if exists, its non-yummie event
            if (property_exists($event, "price")) {
                $ticket->setPrice($event->price);
            }
            $ticket->set_IsAllAccess(false);
            $ticketService->post_Ticket($ticket);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function removeTicket()
    {
        $ticketService = new TicketService();
        $ticket = $ticketService->get_TicketById($_POST['ticketId']);
        $shoppingCartService = new ShoppingCartService();
        $shoppingCartService->removeTicket($ticket);
    }
    private function setAllAvailableTickets()
    {
        $ticketService = new TicketService();
        $danceService = new DanceSessionService();
        $restaurantService = new RestaurantSessionService();
        //i hate doing it like this i had one method which would get me all the avaialble tickets with a parameter but it kept giving errors so this is what you get, sorry.
        $_SESSION['edmEvents'] = $danceService->get_AllDanceSessions();
        $_SESSION['yummieEvents'] = $restaurantService->get_AllRestaurantSessions();
        $_SESSION['strollEvents'] = $ticketService->getAllEventsStroll();
    }
    public function getPendingUserTickets()
    {
        try {
            $ticketService = new TicketService();
            $tickets = $ticketService->get_TicketsByUserIdAndStatus($_SESSION['USER_ID'], 'pending');
            $_SESSION['pendingTickets'] = $tickets;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function removePendingTicket($uuid)
    { // also a mess of a method, sorry.
        try {
            $ticketService = new TicketService();
            $ticketService->delete_Ticket($uuid);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function checkPendingTickets()
    {
        $ticketService = new TicketService();
        $tickets = $ticketService->get_TicketsByStatus('pending');

        foreach ($tickets as $ticket) {
            if ($ticket->exp_date >= new DateTime("now")) {
                $ticketService->delete_Ticket($ticket->uuid);
            }
        }
    }

    public function payment()
    {
        require_once __DIR__ . '/../config/mollieapi.php';
        if (isset($_SESSION['USER_ID'])) {
            try {

                $amount = $_GET["amount"];
                $payment = $mollie->payments->create([
                    "amount" => [
                        "currency" => "EUR",
                        "value" => $amount
                    ],
                    "method" => "creditcard",
                    "description" => "payment",
                    "redirectUrl" => "https://9b5c-2001-1c00-190f-2500-98e4-6c4c-e24c-ed06.ngrok-free.app//api/webhook",
                    "webhookUrl"  => "https://9b5c-2001-1c00-190f-2500-98e4-6c4c-e24c-ed06.ngrok-free.app//api/webhook",
                ]);


                header("Location: " . $payment->getCheckoutUrl(), true, 303);
            } catch (Exception $e) {
                echo $e->getMessage();
                $this->createPaymentWithoutMollie();
            }
        } else {
            header("Location: /login");
        }
    }

    function createPaymentWithoutMollie()
    {

        $ticketService = new TicketService();

        $result = $ticketService->get_TicketsByUserIdAndStatus($_SESSION["USER_ID"], "pending");
        $qrCodeService = new QrCodeService();
        $qrCodeService->send_QRCode($result);
        $invoiceService = new InvoiceService();
        $invoiceService->send_Invoice($result);

        for ($i = 0; $i < sizeof($result); $i++) {
            $ticketService->checkoutTicket($result[$i]->getId());
        }
    }
}
