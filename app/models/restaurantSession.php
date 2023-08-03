<?php
class RestaurantSession implements JsonSerializable
{
    private ?int $id = null;
    private ?int $restaurant_id = null;
    private $adult_Price = null;
    private $kids_Price = null;
    private ?string $session_startTime = null;
    private ?string $session_endTime = null;

    private ?string $session_date = null;

    private ?int $seatings = null;


    public function get_id(): int
    {
        return $this->id;
    }
    public function __set_id(int $id): self
    {
        $this->id  = $id;
        return $this;
    }

    public function get_restaurant_id(): int
    {
        return $this->restaurant_id;
    }

    public function __set_restaurant_id(int $restaurant_id): self
    {
        $this->restaurant_id = $restaurant_id;
        return $this;
    }

    public function get_adult_Price(): float
    {
        return $this->adult_Price;
    }

    public function __set_adult_Price(float $adult_Price): self
    {
        $this->adult_Price = $adult_Price;
        return $this;
    }

    public function get_kids_Price(): float
    {
        return $this->kids_Price;
    }

    public function __set_kids_Price(float $kids_Price): self
    {
        $this->kids_Price = $kids_Price;
        return $this;
    }

    public function get_session_startTime(): string
    {
        return $this->session_startTime;
    }

    public function __set_session_startTime(string $session_startTime): self
    {
        $this->session_startTime = $session_startTime;
        return $this;
    }

    public function get_session_endTime(): string
    {
        return $this->session_endTime;
    }

    public function __set_session_endTime(string $session_endTime): self
    {
        $this->session_endTime = $session_endTime;
        return $this;
    }

    public function get_session_date(): string
    {
        return $this->session_date;
    }

    public function __set_session_date(string $session_date): self
    {
        $this->session_date = $session_date;
        return $this;
    }

    public function get_seatings(): int
    {
        return $this->seatings;
    }

    public function __set_seatings(int $seatings): self
    {
        $this->seatings = $seatings;
        return $this;
    }
 
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'restaurant_id' => $this->restaurant_id,
            'adult_Price' => $this->adult_Price,
            'kids_Price' => $this->kids_Price,
            'session_startTime' => $this->session_startTime,
            'session_endTime' => $this->session_endTime,
            'session_date' => $this->session_date,
            'seatings' => $this->seatings
        ];
    }
}
