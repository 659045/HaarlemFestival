<?php
require __DIR__ . '/../../services/restaurantService.php';


class RestaurantsController
{
  private $restaurantService;

  function __construct()
  {
    $this->restaurantService = new RestaurantService();
  }

  public function index()
  {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
      $r = $this->restaurantService->get_AllRestaurants();
      header('Content-type: Application/JSON');
      echo json_encode($r);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (isset($_POST['post_type'])) {
        switch ($_POST['post_type']) {
          case 'edit':
            $this->restaurantService->edit_Restaurant (htmlspecialchars($_POST["id"]), htmlspecialchars($_POST['restaurant_name']), htmlspecialchars($_POST['restaurant_category']), htmlspecialchars($_POST['restaurant_star']), htmlspecialchars($_POST['restaurant_michelinStar']), htmlspecialchars($_POST['restaurant_description']), htmlspecialchars($_POST['restaurant_address']), htmlspecialchars($_POST['restaurant_phoneNumber']));
            break;
          case 'insert':
            $r = new Restaurant();
            $r->__set_name(htmlspecialchars($_POST['restaurant_name']));
            $r->__set_category(htmlspecialchars($_POST['restaurant_category']));
            $r->__set_stars(htmlspecialchars($_POST['restaurant_star']));
            $r->__set_michelinStar((bool)htmlspecialchars($_POST['restaurant_michelinStar']));
            $r->__set_description(htmlspecialchars($_POST['restaurant_description']));
            $r->__set_address(htmlspecialchars($_POST['restaurant_address']));
            $r->__set_phone_number(htmlspecialchars($_POST['restaurant_phoneNumber']));
            
            $curr = getcwd();
            $img = '/img/';
            $fileExtensionsAllowed = ['jpeg', 'jpg', 'png'];
            $imagePath = "";
            
            for ($i = 0; $i < 9; $i++) {
              $files = $_FILES['picture' . ($i + 1)];
              $fileTmpName = $files['tmp_name'];
              $uploadPath = $curr . $img . basename($files['name']);
              move_uploaded_file($fileTmpName[$i], $uploadPath);
              $imagePath .= $img . basename($files['name']) . ":";
            }

            $r->__set_imagePath($imagePath);
            var_dump($r);
            $this->restaurantService->insert_Restaurant($r);

            break;
          default:
            break;
        }
        return;
      }
      $body =  file_get_contents('php://input');
      $object = json_decode($body);


      if ($object == null) {
        return;
      }

      if ($object->post_type == 'delete') {
        $this->restaurantService->delete_Restaurant($object->id);
      }
    }
  }
}
