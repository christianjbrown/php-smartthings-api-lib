<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class Device implements DeviceInterface
{
    private array $components = [];
    private string $deviceId;
    private ?string $label = null;
    private ?string $name = null;

    public function __construct(string $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setComponents(array $value): DeviceInterface
    {
        $this->components = $value;

        return $this;
    }

    public function setDeviceId(string $value): DeviceInterface
    {
        $this->deviceId = $value;

        return $this;
    }

    public function setLabel(?string $value): DeviceInterface
    {
        $this->label = $value;

        return $this;
    }

    public function setName(?string $value): DeviceInterface
    {
        $this->name = $value;

        return $this;
    }
}
