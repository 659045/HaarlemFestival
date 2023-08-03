<?php
class Reservation implements JsonSerializable
{
    private ?string $uuid = null;

    private ?int $session_id = null;

    private ?bool $status = false;

    private ?int $adults = null;

    private ?int $kids = null;

    private ?string $comment = null;

    public function get_uuid(): string
    {
        return $this->uuid;
    }

    public function __set_uuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function get_session_id(): int
    {
        return $this->session_id;
    }

    public function __set_session_id(int $session_id): self
    {
        $this->session_id = $session_id;
        return $this;
    }

    public function get_status(): bool
    {
        return $this->status;
    }

    public function __set_status(bool $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function get_adults(): int
    {
        return $this->adults;
    }

    public function __set_adults(int $adults): self
    {
        $this->adults = $adults;
        return $this;
    }

    public function get_kids(): int
    {
        return $this->kids;
    }

    public function __set_kids(int $kids): self
    {
        $this->kids = $kids;
        return $this;
    }

    public function get_comment(): string
    {
        return $this->comment;
    }

    public function __set_comment(string $comment): self
    {
        $this->comment = $comment;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'uuid' => $this->uuid,
            'session_id' => $this->session_id,
            'status' => $this->status,
            'adults' => $this->adults,
            'kids' => $this->kids,
            'comment' => $this->comment
        ];
    }
}