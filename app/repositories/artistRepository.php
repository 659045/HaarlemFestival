<?php
require_once __DIR__ . '/repository.php';
require_once __DIR__ . '/../models/artist.php';
class ArtistRepository extends Repository
{
  public function get_AllArtists()
  {
    try {
      $stmt = $this->conn->prepare("SELECT id, name, description, genre, popularSongs, imagePath FROM artist");
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
      $r = $stmt->fetchAll();
      return $r;
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function get_ArtistById($id)
  {
    try {
      $stmt = $this->conn->prepare("SELECT id, name, description, genre, popularSongs, imagePath FROM artist WHERE id = :id");
      $stmt->bindParam(':id', $id);
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
      $r = $stmt->fetch();
      return $r;
    } catch (PDOException $e) {
      echo $e;
    }
  }
  public function insert_Artist(Artist $artist){
    try {
      $stmt = $this->conn->prepare("INSERT INTO artist (name, genre, imagePath) VALUES (:name, :genre, :path)");
      $stmt->execute(array(':name' => $artist->get_name(), ':genre' => $artist->get_genre(), ':path' => $artist->get_imagePath()));
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function delete_artistById($id){
    try {
      $stmt = $this->conn->prepare("DELETE FROM artist WHERE id = :id");
      $stmt->execute(array(':id' => $id));
    } catch (PDOException $e) {
      echo $e;
    }
  }

  public function edit_artistById($id, $name, $genres){
    try {
      $stmt = $this->conn->prepare("UPDATE `artist` SET `name`=:name,`genre`=:genres,`imagePath`='tbd' WHERE id = :id");
      $stmt->execute(array(':id' => $id, ':name' => $name, ':genres' => $genres));
    } catch (PDOException $e) {
      echo $e;
    }
  }
}
