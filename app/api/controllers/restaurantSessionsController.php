<?php
require __DIR__ . '/../../services/restaurantSessionService.php';
require_once __DIR__ . '/../../services/eventService.php';


class RestaurantSessionsController
{
  private $restaurantSessionService;
  private $eventService;

  function __construct()
  {
    $this->restaurantSessionService = new RestaurantSessionService();
    $this->eventService = new EventService();
  }

  public function index()
  {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $r = $this->restaurantSessionService->get_AllRestaurantSessions();
      header('Content-type: Application/JSON');
      echo json_encode($r);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $body =  file_get_contents('php://input');
      var_dump($body);
      $object = json_decode($body);
      var_dump($object);
      if ($object == null) {
        return;
      }
      
      switch ($object->post_type) {
        case 'insert':
          
          $this->eventService->insert_NewEvent();
          $id = $this->eventService->get_last_Id();
          $session = new RestaurantSession();
          $session->__set_id($id->id);
          $session->__set_restaurant_id(htmlspecialchars($object->restaurant_id));
          $session->__set_adult_Price(htmlspecialchars($object->adult_Price));
          $session->__set_kids_Price(htmlspecialchars($object->kids_Price));
          $session->__set_session_startTime(htmlspecialchars($object->session_startTime));
          $session->__set_session_endTime(htmlspecialchars($object->session_endTime));
          $session->__set_session_date(htmlspecialchars($object->session_date));
          $session->__set_seatings(htmlspecialchars($object->seatings));
          
          var_dump($session);
          $this->restaurantSessionService->insert_RestaurantSession($session);
          break;
        case 'edit':
          $this->restaurantSessionService->edit_RestaurantSession(htmlspecialchars($object->id), htmlspecialchars($object->restaurant_id), htmlspecialchars($object->adult_Price), htmlspecialchars($object->kids_Price), htmlspecialchars($object->session_startTime), htmlspecialchars($object->session_endTime), htmlspecialchars($object->session_date), htmlspecialchars($object->seatings));
          break;
        case 'delete':
          $this->restaurantSessionService->delete_RestaurantSession($object->id);
          break;
        default:
          break;
      }
      return;
    }
  }
}