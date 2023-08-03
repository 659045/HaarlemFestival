<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/event.php';
require_once __DIR__ . '/../models/event2.php';

class EventRepository extends Repository
{
    public function get_AllEvents()
    {
        try {
            $stmt = $this->conn->prepare("SELECT id, title, description, small_title, imagePath, pageLink FROM homepage_events");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function get_AllEvent2()
    {
        try {
            $stmt = $this->conn->prepare("SELECT id FROM events");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event2');
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function get_EventYummieById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM event_yummie WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function get_EventStrollById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM event_stroll WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function get_EventEDMById($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM event_edm WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }

    }

    public function insert_NewEvent()
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO events VALUES (null)");
            $stmt->execute();
          } catch (PDOException $e) {
            echo $e;
        }
    }

    public function get_last_Id()
    {
        try {
            $stmt = $this->conn->prepare("SELECT id FROM events ORDER BY id DESC LIMIT 1");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}