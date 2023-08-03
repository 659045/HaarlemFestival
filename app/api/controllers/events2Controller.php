<?php
require __DIR__ . '/../../services/eventService.php';

class Events2Controller
{
    private $eventService;

    function __construct()
    {
        $this->eventService = new EventService();
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $result = $this->eventService->get_AllEvent2();
            header('Content-type: Application/JSON');
            echo json_encode($result);
        }
    }
}
