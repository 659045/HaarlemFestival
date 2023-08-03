<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/ticket.php';

class TicketRepository extends Repository
{
    public function get_AllTickets(): array
    {
        $sql = "SELECT * FROM ticket";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

    public function Get_AllTicketsByEventIdAndStatus($id, $status): array
    {
        $sql = "SELECT uuid as id, status, event_id, price, user_id, order_id, isAllAccess From ticket WHERE user_id = :user_id, status = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Ticket');
        return $result;
    }
    public function get_TicketsByEventId($id): array
    {
        $sql = "SELECT * FROM ticket WHERE event_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }

    public function get_TicketById($id): Ticket
    {
        $sql = "SELECT `uuid`, `status`, `event_id`, `price`, `user_id`, `exp_date`, `order_id`, `isAllAccess` FROM `ticket` WHERE uuid = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ticket');
        $result = $stmt->fetch();
       return $result;
    }
    public function get_TicketsByStatus($status)
    {
        $sql = "SELECT * FROM ticket WHERE status = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_CLASS);
        return $result;
    }
    public function get_TicketsByUserIdAndStatus($id, $status)
    {
        $sql = "SELECT uuid, status, event_id, price, user_id, order_id, isAllAccess From ticket WHERE user_id = :user_id AND status = :status";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $id);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ticket');
        $result = $stmt->fetchAll();
        
        return $result;
    }

    public function delete_Ticket($id)
    {
        $this->updateTicketsAmount($this->get_EventIdFromTicket($id), '+');
        $sql = "DELETE FROM `ticket` WHERE `uuid` = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function put_Ticket($ticket)
    {
        $sql = "UPDATE ticket SET status = :status, order_id = :order_id WHERE uuid = :id";
        $stmt = $this->conn->prepare($sql);
        $id=$ticket->getId();
        $status=$ticket->getStatus();
        $order_id=$ticket->getOrderId();
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':status', $status);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
    }
    public function post_Ticket($ticket)
    {
        $this->updateTicketsAmount($ticket->getEvent_Id(), '-');
        $sql = "INSERT INTO ticket(uuid,status,event_id,price,user_id,exp_date,order_id,isAllAccess) VALUES (uuid(), 'pending', :event, :price, :user_id, NOW() + INTERVAL 1 DAY ,null,:isAllAccess)";
        $stmt = $this->conn->prepare($sql);
        $event=$ticket->getEvent_Id();
        $stmt->bindParam(':event', $event);
        $user_id=$ticket->get_UserId();
        $stmt->bindParam(':user_id', $user_id);
        $price = $ticket->getPrice();
        $stmt->bindParam(':price', $price);

        $isAllAccess = $ticket->get_IsAllAccess();
        if ($isAllAccess) {
            $isAllAccess = 1;
        }
        else if (!$isAllAccess) {
            $isAllAccess = 0;
        }

        $stmt->bindParam(':isAllAccess', $isAllAccess);
        $stmt->execute();
    }
    public function get_EventIdFromTicket($id){
        $sql = "SELECT `event_id` FROM `ticket` WHERE `uuid` = :id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['event_id'];
    }

    public function getTicketsAmount($event_id){
        $sql = "SELECT ticketsAmount FROM events WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $event_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['ticketsAmount'];
    }
    

    public function updateTicketsAmount($event_id,$plusOrMinus){
        if ($this->getTicketsAmount($event_id) <= 0 && $plusOrMinus == '-'){
            return;
        }
        if ($plusOrMinus == '-'){
            $sql = "UPDATE events SET ticketsAmount = (SELECT ticketsAmount FROM events WHERE id = :id) - 1 WHERE id = :id;";
        }
        else if ($plusOrMinus == '+'){
            $sql = "UPDATE events SET ticketsAmount = (SELECT ticketsAmount FROM events WHERE id = :id) + 1 WHERE id = :id;";
        }
        else
            return;        
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $event_id);
        $stmt->execute();        
    }
    public function getAllEventsStroll(){
        try
        {
            $sql = 'select * from event_stroll;';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $result;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    public function checkoutTicket($id){

        $sql = "UPDATE `ticket` SET `status`='paid' WHERE uuid = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
    }
}