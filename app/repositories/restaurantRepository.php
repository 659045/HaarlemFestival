<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/restaurant.php';
class RestaurantRepository extends Repository
{
  public function get_AllRestaurants()
  {
    try {
      $stmt = $this->conn->prepare("SELECT id, name, category, star, michelinStar, description, address, phone_number, imagePath FROM restaurant");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');
      $r = $stmt->fetchAll();
      return $r;
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function get_RestaurantById($id)
  {
    try {
      $stmt = $this->conn->prepare("SELECT id, name, category, star, michelinStar, description, address, phone_number, imagePath FROM restaurant WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');
      $r = $stmt->fetch();
      return $r;
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function edit_Restaurant($id, $name, $category, $star, $michelinStar, $description, $address, $phone_number)
  {
    try {
      $stmt = $this->conn->prepare("UPDATE restaurant SET name = :name, category = :category, star = :star, michelinStar = :michelinStar, description = :description, address = :address, phone_number = :phone_number WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':category', $category);
      $stmt->bindParam(':star', $star);
      $stmt->bindParam(':michelinStar', $michelinStar);
      $stmt->bindParam(':description', $description);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':phone_number', $phone_number);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function insert_Restaurant(Restaurant $restaurant)
  {
    try {
      $stmt = $this->conn->prepare("INSERT INTO restaurant (name, category, star, michelinStar, description, address, phone_number, imagePath) VALUES (:name, :category, :star, :michelinStar, :description, :address, :phone_number, :imagePath)");
      $stmt->bindParam(':name', $restaurant->get_name());
      $stmt->bindParam(':category', $restaurant->get_category());
      $stmt->bindParam(':star', $restaurant->get_stars());
      $stmt->bindParam(':michelinStar', $restaurant->get_michelinStar());
      $stmt->bindParam(':description', $restaurant->get_description());
      $stmt->bindParam(':address', $restaurant->get_address());
      $stmt->bindParam(':phone_number', $restaurant->get_phone_number());
      $stmt->bindParam(':imagePath', $restaurant->get_imagePath());
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function delete_Restaurant($id)
  {
    try {
      $stmt = $this->conn->prepare("DELETE FROM restaurant WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();
    } catch (PDOException $e) {
      echo $e;
    }
  }
}
