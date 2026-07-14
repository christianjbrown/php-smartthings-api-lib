<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class LocationRoom implements LocationRoomInterface
{
    private ?string $locationId = null;
    private ?string $name = null;
    private string $roomId;

    public function __construct(string $roomId)
    {
        $this->roomId = $roomId;
    }

    public function getLocationId(): ?string
    {
        return $this->locationId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getRoomId(): string
    {
        return $this->roomId;
    }

    public function setLocationId(?string $value): LocationRoomInterface
    {
        $this->locationId = $value;

        return $this;
    }

    public function setName(?string $value): LocationRoomInterface
    {
        $this->name = $value;

        return $this;
    }

    public function setRoomId(string $value): LocationRoomInterface
    {
        $this->roomId = $value;

        return $this;
    }
}
