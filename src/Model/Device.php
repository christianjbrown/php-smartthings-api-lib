<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class Device implements DeviceInterface
{
    private string $deviceId;
    private string $name;
    private string $label;
    private array $components;

    public function getName(): string
    {
        return $this->name;
    }

    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function setName(string $value): DeviceInterface
    {
        $this->name = $value;

        return $this;
    }

    public function setDeviceId(string $value): DeviceInterface
    {
        $this->deviceId = $value;

        return $this;
    }

    public function setComponents(array $value): DeviceInterface
    {
        $this->components = $value;

        return $this;
    }

    public function setLabel(string $value): DeviceInterface
    {
        $this->label = $value;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }
}
