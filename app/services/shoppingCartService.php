<?php
require_once __DIR__ . '/../models/ticket.php';
require __DIR__ . '/../repositories/shoppingCartRepository.php';


class ShoppingCartService
{
    public function addTicket(Ticket $ticket)
    {
        $repo = new ShoppingCartRepository();
        return $repo->addTicket($ticket);
    }

    public function removeTicket(Ticket $ticket)
    {
        $repo = new ShoppingCartRepository();
        return $repo->removeTicket($ticket);
    }

    public function editTicket(Ticket $ticket)
    {
        $repo = new ShoppingCartRepository();
        return $repo->editTicket($ticket);
    }

}