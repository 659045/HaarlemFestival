<?php
require __DIR__ . '/../repositories/eventRepository.php';
require_once __DIR__ . '/../models/event.php';
require_once __DIR__ . '/../models/event2.php';

class EventService
{
    public function get_AllEvents(): array
    {
        $repo = new EventRepository();
        return $repo->get_AllEvents();
    }
    public function get_AllEvent2(): array
    {
        $repo = new EventRepository();
        return $repo->get_AllEvent2();
    }
    public function get_EventYummieById($id)
    {
        $repo = new EventRepository();
        return $repo->get_EventYummieById($id);
    }
    public function get_EventStrollById($id)
    {
        $repo = new EventRepository();
        return $repo->get_EventStrollById($id);
    }
    public function get_EventEDMById($id)
    {
        $repo = new EventRepository();
        return $repo->get_EventEDMById($id);
    }

    public function insert_NewEvent()
    {
        $repo = new EventRepository();
        $repo->insert_NewEvent();
    }

    public function get_last_Id(){
        $repo = new EventRepository();
        return $repo->get_last_Id();
    }
}