<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceInterface
{
    /**
     * @return array<int, DeviceComponentInterface>
     */
    public function getComponents(): array;

    public function getDeviceId(): string;

    public function getLabel(): ?string;

    public function getLocationId(): ?string;

    public function getName(): ?string;

    public function getRoomId(): ?string;

    /**
     * @param array<int, DeviceComponentInterface> $value
     */
    public function setComponents(array $value): self;

    public function setDeviceId(string $value): self;

    public function setLabel(?string $value): self;

    public function setLocationId(?string $value): self;

    public function setName(?string $value): self;

    public function setRoomId(?string $value): self;
}
