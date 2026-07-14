<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class DeviceComponent implements DeviceComponentInterface
{
    /**
     * @var array<int, DeviceComponentCapabilityInterface>
     */
    private array $capabilities = [];

    /**
     * @return array<int, DeviceComponentCapabilityInterface>
     */
    public function getCapabilities(): array
    {
        return $this->capabilities;
    }

    /**
     * @param array<int, DeviceComponentCapabilityInterface> $value
     */
    public function setCapabilities(array $value): DeviceComponentInterface
    {
        $this->capabilities = $value;

        return $this;
    }
}
