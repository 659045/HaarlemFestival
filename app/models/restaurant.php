<?php
class Restaurant implements JsonSerializable
{
    private ?int $id = null;
    private ?string $name = null;
    private ?string $category = null;
    private  $star = null;
    private ?bool $michelinStar = null;
    private ?string $description = null;
    private ?string $address = null;
    private ?string $phone_number = null;
    private ?string $imagePath = null;


    public function get_id(): int
    {
        return $this->id;
    }
    public function __set_id(int $id): self
    {
        $this->id  = $id;
        return $this;
    }

    public function get_name(): string
    {
        return $this->name;
    }
    public function __set_name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function get_category(): string
    {
        return $this->category;
    }
    public function __set_category(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    public function get_stars(): float
    {
        return $this->star;
    }
    public function __set_stars(string $star): self
    {
        $this->star = $star;
        return $this;
    }

    public function get_michelinStar(): bool
    {
        return $this->michelinStar;
    }

    public function __set_michelinStar(bool $michelinStar): self
    {
        $this->michelinStar = $michelinStar;
        return $this;
    }

    public function get_description(): string
    {
        return $this->description;
    }

    public function __set_description(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function get_address(): string
    {
        return $this->address;
    }

    public function __set_address(string $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function get_phone_number(): string
    {
        return $this->phone_number;
    }

    public function __set_phone_number(string $phone_number): self
    {
        $this->phone_number = $phone_number;
        return $this;
    }

    public function get_imagePath(): string
    {
        return $this->imagePath;
    }

    public function __set_imagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;
        return $this;
    }


    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'star' => $this->star,
            'michelinStar' => $this->michelinStar,
            'description' => $this->description,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'imagePath' => $this->imagePath
        ];
    }
}
