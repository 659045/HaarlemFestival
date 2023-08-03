<?php
require __DIR__ . '/../repositories/danceSessionRepository.php';
require_once __DIR__ . '/../models/danceSession.php';
class DanceSessionService
{

  private $repo;

  function __construct(){
    $this->repo = new DanceSessionRepository();
  }

  public function get_AllDanceSessions(){
    return $this->repo->get_AllDanceSessions();
  }
  
  public function get_AllDanceSessionsByArtistId($artist_id){
    return $this->repo->get_AllDanceSessionsByArtistId($artist_id);
  }

  public function insert_NewSession(DanceSession $session){
    $this->repo->insert_NewSession($session);
  }

  public function edit_SessionById($id,$date, $venue_id, $artist_id, $type, $amount, $duration, $price){
    $this->repo->edit_SessionById($id, $date, $venue_id, $artist_id, $type, $amount, $duration, $price);
  }

  public function delete_SessionById($id){
    $this->repo->delete_SessionById($id);
  }

  public function updateTicketCountByEventid($id){
    $this->repo->updateTicketCountByEventId($id);
  }
}