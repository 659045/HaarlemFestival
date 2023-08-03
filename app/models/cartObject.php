<?php

require_once __DIR__ . '/ticket.php';

class cartObject implements JsonSerializable
{
  public ?string $id = null;
  public ?string $status = null;
  public ?float $price = null;
  public ?string $session_type = null;
  public $session;
  public ?int $user_id = null;
  public ?int $order_id = null;
  public ?bool $isAllAccess = null;



  function __construct($id, $status, $price, $uid, $oid, $allAccess)
  {
    $this->id = $id;
    $this->status = $status;
    $this->price = $price;
    $this->user_id = $uid;
    $this->order_id = $oid;
    $this->isAllAccess = $allAccess; 
  }


  public function jsonSerialize(): mixed
  {
    return [
      'id' => $this->id,
      'status' => $this->status,
      'price' => $this->price,
      'session_type' => $this->session_type,
      'session' => $this->session,
      'order_id' => $this->order_id,
      'user_id' => $this->user_id,
    ];
  }
}
