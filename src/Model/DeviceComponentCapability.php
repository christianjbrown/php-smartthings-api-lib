<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class DeviceComponentCapability implements DeviceComponentCapabilityInterface
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $value): DeviceComponentCapabilityInterface
    {
        $this->id = $value;

        return $this;
    }
}
