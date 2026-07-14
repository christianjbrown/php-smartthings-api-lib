<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class Location implements LocationInterface
{
    private string $locationId;
    private ?string $name = null;

    public function __construct(string $locationId)
    {
        $this->locationId = $locationId;
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setLocationId(string $value): LocationInterface
    {
        $this->locationId = $value;

        return $this;
    }

    public function setName(?string $value): LocationInterface
    {
        $this->name = $value;

        return $this;
    }
}
