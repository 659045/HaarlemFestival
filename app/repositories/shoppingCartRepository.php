<?php
require_once(__DIR__ . '/../repositories/repository.php');

class ShoppingCartRepository extends Repository
{

    public function addTicket(Ticket $ticket)
    {
        if (!isset($_SESSION['shoppingCart'])) {
            $_SESSION['shoppingCart'] = [];
        }
        array_push($_SESSION['shoppingCart'], $ticket);
    }

    public function removeTicket(Ticket $ticket)
    {
        if (isset($_SESSION['shoppingCart'])) {
            $index = array_search($ticket, $_SESSION['shoppingCart']);
            if ($index !== false) {
                unset($_SESSION['shoppingCart'][$index]);
            }
        }
    }

    public function editTicket(Ticket $ticket)
    {
        if (isset($_SESSION['shoppingCart'])) {
            $index = array_search($ticket, $_SESSION['shoppingCart']);
            if ($index !== false) {
                $_SESSION['shoppingCart'][$index] = $ticket;
            }
        }
    }

}