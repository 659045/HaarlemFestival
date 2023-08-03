<?php
require __DIR__ . '/../repositories/restaurantRepository.php';
require_once __DIR__ . '/../models/restaurant.php';
class RestaurantService
{
  public function get_AllRestaurants(): array
  {
    $repo = new RestaurantRepository();
    return $repo->get_AllRestaurants();
  }

  public function get_RestaurantById($id): Restaurant
  {
    $repo = new RestaurantRepository();
    return $repo->get_RestaurantById($id);
  }

  public function edit_Restaurant($id, $name, $category, $star, $michelinStar, $description, $address, $phone_number)
  {
    $repo = new RestaurantRepository();
    $repo->edit_Restaurant($id, $name, $category, $star, $michelinStar, $description, $address, $phone_number);
  }

  public function insert_Restaurant(Restaurant $restaurant)
  {
    $repo = new RestaurantRepository();
    $repo->insert_Restaurant($restaurant);
  }

  public function delete_Restaurant($id)
  {
    $repo = new RestaurantRepository();
    $repo->delete_Restaurant($id);
  }
}
