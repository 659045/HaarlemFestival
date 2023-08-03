<?php
require __DIR__ . '/../../services/reservationService.php';
require_once __DIR__ . '/../../models/reservation.php';


class ReservationsController
{
  private $reservationService;

  function __construct()
  {
    $this->reservationService = new ReservationService();
  }

  public function index()
  {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $r = $this->reservationService->get_AllReservations();
      header('Content-type: Application/JSON');
      echo json_encode($r);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $body =  file_get_contents('php://input');
      $object = json_decode($body);

      if ($object == null) {
        return;
      }

      switch ($object->post_type) {
        case 'delete':
          $this->reservationService->delete_Reservation($object->id);
          break;
        case 'edit':
          $this->reservationService->edit_Reservation(htmlspecialchars($object->uuid), htmlspecialchars($object->session_id), htmlspecialchars($object->status), htmlspecialchars($object->adults), htmlspecialchars($object->kids), htmlspecialchars($object->comment));
          break;
        case 'insert':
          $r = new Reservation();
            $r->__set_uuid(htmlspecialchars($object->uuid));
            $r->__set_session_id(htmlspecialchars($object->session_id));
            $r->__set_status($object->status);
            $r->__set_adults(htmlspecialchars($object->adults));
            $r->__set_kids(htmlspecialchars($object->kids));
            $r->__set_comment(htmlspecialchars($object->comment));

          $this->reservationService->insert_Reservation($r);
          break;
        default:
          break;
      }
    }
  }
}
