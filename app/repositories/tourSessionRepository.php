<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/event_tour.php';
class TourSessionRepository extends Repository
{
  public function get_TourSessionsByEventId($event_id)
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM event_stroll WHERE id = :id");
      $stmt->bindParam(':id', $event_id);
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $r = $stmt->fetchAll();
      return $r;
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function get_AllTourSessions()
  {
    try {
      $stmt = $this->conn->prepare("SELECT * FROM event_stroll");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_OBJ);
      $r = $stmt->fetchAll();
      return $r;
    } catch (PDOException $e) {
      echo $e;
    }
  }
  
}