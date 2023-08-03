<?php
require_once __DIR__ . '/../models/event2.php';

class Event_tour extends Event2 
{
    private ?array $route = null;
    private ?string $language = null;
    private ?DateTime $datetime = null;

    public function get_route(): array
    {
        return $this->route;
    }
    public function __set_route(array $route): self
    {
        $this->route = $route;
        return $this;
    }
    public function get_language(): string
    {
        return $this->language;
    }
    public function __set_language(string $language): self
    {
        $this->language = $language;
        return $this;
    }
    public function get_datetime(): DateTime
    {
        return $this->datetime;
    }
    public function __set_datetime(DateTime $datetime): self
    {
        $this->datetime = $datetime;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'route' => $this->route,
            'language' => $this->language,
            'datetime' => $this->datetime
        ];
    }
}