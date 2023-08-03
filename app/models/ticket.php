<?php
use Ramsey\Uuid\Uuid;
require_once __DIR__ . '/../models/event2.php';
class Ticket implements JsonSerializable
{
    private ?string $uuid = null;
    private ?string $status = null;
    private ?float $price = null;
    private ?int $event_id = null;
    private ?int $user_id = null;
    private ?int $order_id = null;
    private ?bool $isAllAccess = null;

    public function getId(): ?string
    {
        return $this->uuid;
    }
    public function setId(?string $id): void
    {
        $this->uuid = $id;
    }
    public function getStatus(): ?string
    {
        return $this->status;
    }
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }
    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }
    public function getEvent_id(): ?int
    {
        return $this->event_id;
    }
    public function setEvent_id(?int $event): void
    {
        $this->event_id = $event;
    }
    public function getOrderId(): ?int
    {
        return $this->order_id;
    }
    public function setOrderId(?int $order_id): void
    {
        $this->order_id = $order_id;
    }
    public function get_UserId(): ?int
    {
        return $this->user_id;
    }
    public function set_UserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }
    public function get_IsAllAccess(): ?bool
    {
        return $this->isAllAccess;
    }
    public function set_IsAllAccess(?bool $isAllAccess): void
    {
        $this->isAllAccess = $isAllAccess;
    }
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->uuid,
            'status' => $this->status,
            'price' => $this->price,
            'event' => $this->event_id,
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'isAllAccess' => $this->isAllAccess
        ];
    }
}
