<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class DeviceComponent implements DeviceComponentInterface
{
    private array $capabilities = [];

    public function getCapabilities(): array
    {
        return $this->capabilities;
    }

    public function setCapabilities(array $value): DeviceComponentInterface
    {
        $this->capabilities = $value;

        return $this;
    }
}
