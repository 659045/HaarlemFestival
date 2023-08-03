<?php

require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/reservation.php';

class ReservationRepository extends Repository{

    public function get_AllReservations(){
        try{
            $stmt = $this->conn->prepare("SELECT uuid, session_id, status, adults, kids, comment FROM reservation");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reservation');
            $r = $stmt->fetchAll();
            return $r;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function get_ReservationById($uuid){
        try{
            $stmt = $this->conn->prepare("SELECT uuid, session_id, status, adults, kids, comment FROM reservation WHERE uuid = :uuid");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Reservation');
            $r = $stmt->fetch();
            return $r;
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function insert_Reservation($reservation){
        try{
            $stmt = $this->conn->prepare("INSERT INTO reservation (uuid, session_id, status, adults, kids, comment) VALUES (:uuid, :session_id, :status, :adults, :kids, :comment)");
            $stmt->bindParam(':uuid', $reservation->get_uuid());
            $stmt->bindParam(':session_id', $reservation->get_session_id());
            $stmt->bindParam(':status', $reservation->get_status());
            $stmt->bindParam(':adults', $reservation->get_adults());
            $stmt->bindParam(':kids', $reservation->get_kids());
            $stmt->bindParam(':comment', $reservation->get_comment());
            $stmt->execute();
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function edit_Reservation($uuid, $session_id, $status, $adults, $kids, $comment){
        try{
            $stmt = $this->conn->prepare("UPDATE reservation SET session_id = :session_id, status = :status, adults = :adults, kids = :kids, comment = :comment WHERE uuid = :uuid");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':session_id', $session_id);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':adults', $adults);
            $stmt->bindParam(':kids', $kids);
            $stmt->bindParam(':comment', $comment);
            $stmt->execute();
        }catch(PDOException $e){
            echo $e;
        }
    }

    public function delete_Reservation($uuid){
        try{
            $stmt = $this->conn->prepare("DELETE FROM reservation WHERE uuid = :uuid");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
        }catch(PDOException $e){
            echo $e;
        }
    }
}