<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class Device implements DeviceInterface
{
    /**
     * @var array<int, DeviceComponentInterface>
     */
    private array $components = [];
    private string $deviceId;
    private ?string $label = null;
    private ?string $locationId = null;
    private ?string $name = null;
    private ?string $roomId = null;

    public function __construct(string $deviceId)
    {
        $this->deviceId = $deviceId;
    }

    /**
     * @return array<int, DeviceComponentInterface>
     */
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

    public function getLocationId(): ?string
    {
        return $this->locationId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getRoomId(): ?string
    {
        return $this->roomId;
    }

    /**
     * @param array<int, DeviceComponentInterface> $value
     */
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

    public function setLocationId(?string $value): DeviceInterface
    {
        $this->locationId = $value;

        return $this;
    }

    public function setName(?string $value): DeviceInterface
    {
        $this->name = $value;

        return $this;
    }

    public function setRoomId(?string $value): DeviceInterface
    {
        $this->roomId = $value;

        return $this;
    }
}
