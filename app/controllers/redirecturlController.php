<?php

class RedirectUrlController
{

  public function __construct()
  {
  }

  function index()
  {
    $orderId = htmlspecialchars($_GET['orderId']);
    print_r($orderId);
    if ($orderId) {
      require __DIR__ . '/../views/payment/success.php';
    } else {
      require __DIR__ . '/../views/payment/fail.php';
    }
  }
}
