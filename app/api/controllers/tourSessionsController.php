<?php
require_once __DIR__ . '/../../services/tourSessionService.php';


class TourSessionsController
{
  private $tourSessionService;

  function __construct()
  {
    $this->tourSessionService = new TourSessionService();
  }

  public function index()
  {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $r = $this->tourSessionService->get_AllTourSessions();
      header('Content-type: Application/JSON');
      echo json_encode($r);
    }
  }
}