<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/page.php';
class PageRepository extends Repository
{
  public function get_AllPages()
  {
    try {
      $stmt = $this->conn->prepare("SELECT id, name, title, html FROM page");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Page');
      $page = $stmt->fetchAll();
      return $page;
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function update_Page($id, $html)
  {
    try {
      $stmt = $this->conn->prepare("UPDATE page SET html = :html WHERE id = :id");
      $stmt->bindParam(':html', $html);
      $stmt->bindParam(':id', $id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function create_Page($page)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO page (name, title, html) VALUES (:name, :title, :html)");
      $stmt->bindParam(':name', $page->get_name());
      $stmt->bindParam(':title', $page->get_title());
      $stmt->bindParam(':html', $page->get_html());
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e;
    }
  }
}
