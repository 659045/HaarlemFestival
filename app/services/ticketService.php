<?php
require __DIR__ . '/../repositories/ticketRepository.php';
require_once __DIR__ . '/danceSessionService.php';
require_once __DIR__ . '/danceSessionService.php';
require_once __DIR__ . '/restaurantSessionService.php';
require_once __DIR__ . '/../models/ticket.php';

class TicketService
{
    public function get_AllTickets(): array
    {
        $repo = new TicketRepository();
        return $repo->get_AllTickets();
    }

    public function get_TicketsByEventId($id): array
    {
        $repo = new TicketRepository();
        return $repo->get_TicketsByEventId($id);
    }

    public function get_TicketById($id): Ticket
    {
        $repo = new TicketRepository();
        return $repo->get_TicketById($id);
    }
    public function post_Ticket($ticket)
    {
        $repo = new TicketRepository();
        return $repo->post_Ticket($ticket);
    }
    public function getAllEventsStroll(): array
    {
        $repo = new TicketRepository();
        return $repo->getAllEventsStroll();
    }
    public function get_TicketsByStatus($status)
    {
        $repo = new TicketRepository();
        return $repo->get_TicketsByStatus($status);
    }
    public function get_TicketsByUserIdAndStatus($id, $status): array
    {
        $repo = new TicketRepository();
        return $repo->get_TicketsByUserIdAndStatus($id, $status);
    }
    public function delete_Ticket($id)
    {
        $repo = new TicketRepository();
        return $repo->delete_Ticket($id);
    }

    public function put_Ticket($ticket)
    {
        $repo = new TicketRepository();
        return $repo->put_Ticket($ticket);
    }

    public function checkoutTicket($id){
        $repo = new TicketRepository();
        $repo->checkoutTicket($id);

        $ticket = $repo->get_TicketById($id);
        $danceService = new DanceSessionService(); 
        $danceService->updateTicketCountByEventid($ticket->getEvent_id());
        $restaurantService = new RestaurantSessionService();
        $restaurantService->updateTicketCountByEventid($ticket->getEvent_id());
    }


}