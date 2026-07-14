<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceComponentInterface
{
    /**
     * @return array<int, DeviceComponentCapabilityInterface>
     */
    public function getCapabilities(): array;

    /**
     * @param array<int, DeviceComponentCapabilityInterface> $value
     */
    public function setCapabilities(array $value): self;
}
