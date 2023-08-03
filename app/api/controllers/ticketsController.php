<?php
require __DIR__ . '/../../services/ticketService.php';

class TicketsController
{
    private $ticketService;

    function __construct()
    {
        $this->ticketService = new TicketService();
    }


    //to get the events for the tickets just use the sessions service you guys made it just uses the same things. There is also one for the tour events.

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $body =  file_get_contents('php://input');
            $object = json_decode($body);
            if ($object == null)
                return;
            
            switch ($object->get_type) {
                case 'all':
                    $result = $this->ticketService->get_AllTickets();
                    break;
                case 'userAndStatus':
                    
                    //use this one to get the tickets in shopping cart with the user_id of the user and status pending. or paid.
                    
                    $result = $this->ticketService->get_TicketsByUserIdAndStatus($object->user_id, $object->status);
                    break;
            }
            header('Content-type: Application/JSON');
            echo json_encode($result);
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $body =  file_get_contents('php://input');
            $jsonData = stripslashes(html_entity_decode($body));

            $object = json_decode($jsonData);
            if ($object == null) {
              return;
            }
      
            switch ($object->post_type) { 
            case 'insert':
                // if the ticket is all access just leave event null and set the bool to true
                
                // to get the events for the tickets just use the sessions service you guys made it just uses the same things.
                
                $ticket = new Ticket();
                $ticket->setEvent_id(htmlspecialchars($object->event_id));
                $ticket->set_UserId(htmlspecialchars($object->user_id));
                $ticket->setPrice(htmlspecialchars($object->price));
                if ($object->isAllAccess == 0)
                    $ticket->set_IsAllAccess(false);
                else if ($object->isAllAccess == 1)
                    $ticket->set_IsAllAccess(true);
                $this->ticketService->post_Ticket($ticket);
                break;
            case 'update':
                // you can use this one to update the status for example from pending to paid. Also you can use this to set the order id of the ticket if nessesary.
                $ticket = new Ticket();
                $ticket->setId(htmlspecialchars($object->id));
                $ticket->setStatus(htmlspecialchars($object->status));
                //to set the order id status use 0 if there isnt one.
                $ticket->setOrderId(htmlspecialchars($object->order_id));
                $this->ticketService->put_Ticket($ticket);
                break;
            case 'delete':
                // call this one to remove a ticket from the shopping cart.
                $id = htmlspecialchars($object->id);
                $this->ticketService->delete_Ticket($id);
                break;
            
            default:
                echo 'sum aint right';
                break;
            }
          }
    }
}