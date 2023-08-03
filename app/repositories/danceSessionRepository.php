<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/danceSession.php';
class DanceSessionRepository extends Repository
{
  public function get_AllDanceSessions()
  {
    try {
      $stmt = $this->conn->prepare("SELECT id, venue, artist_id, date, session, duration, ticketsAmount, price FROM event_edm ORDER BY date ASC");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_CLASS, 'DanceSession');
      $r = $stmt->fetchAll();
      return $r;
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function get_AllDanceSessionsByArtistId($artist_id)
  {
    try {
      $stmt = $this->conn->prepare("SELECT id, venue, artist_id, date, session, duration, ticketsAmount, price FROM event_edm WHERE artist_id = :artist_id ORDER BY date ASC");
      $stmt->bindParam(':artist_id', $artist_id);
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_CLASS, 'DanceSession');
      $r = $stmt->fetchAll();
      return $r;
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function insert_NewSession(DanceSession $session)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO `event_edm`(`venue`, `artist_id`, `date`, `session`, `duration`, `ticketsAmount`, `price`) VALUES (:venue_id,:artist_id,:date,:type,:duration,:tickets,:price)");

      $stmt->execute(array(':venue_id' => $session->get_venue(), ':artist_id' => $session->get_artist_id(), ':date' => $session->get_date(), ':type' => $session->get_session(), ':duration' => $session->get_duration(), ':tickets' => $session->get_ticketsAmount(), ':price' => $session->get_price()));
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function edit_SessionById($id, $date, $venue_id, $artist_id, $type, $amount, $duration, $price){
    try {
      $stmt = $this->conn->prepare("UPDATE `event_edm` SET `venue`=:venue_id,`artist_id`=:artist_id,`date`=:date,`session`=:type,`duration`=:duration,`ticketsAmount`=:tickets,`price`=:price WHERE id = :id");
      $stmt->execute(array(':venue_id' => $venue_id, ':artist_id' => $artist_id, ':date' => $date, ':type' => $type, ':duration' => $duration, ':tickets' => $amount, ':price' => $price, ':id' => $id));
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function delete_SessionById($id){
    try {
      $stmt = $this->conn->prepare("DELETE FROM `event_edm` WHERE `event_edm`.`id` = :id");
      $stmt->execute(array(':id' => $id));
    } catch (PDOException $e) {
      echo $e;
    }
  }


  public function updateTicketCountByEventId($id){
    try {
      $stmt = $this->conn->prepare("UPDATE `event_edm` SET `ticketsAmount`=(ticketsAmount-1) WHERE id = :id");
      $stmt->execute(array(':id' => $id));
    } catch (PDOException $e) {
      echo $e;
    }
  }
}
