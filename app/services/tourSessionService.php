<?php
require __DIR__ . '/../repositories/tourSessionRepository.php';
class TourSessionService
{

  private $repo;

  function __construct(){
    $this->repo = new TourSessionRepository();
  }

  public function get_AllTourSessions(){
    return $this->repo->get_AllTourSessions();
  }

  public function get_TourSessionsByEventId($event_id){
    return $this->repo->get_TourSessionsByEventId($event_id);
  }
  
}