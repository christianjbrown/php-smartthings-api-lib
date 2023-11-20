<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceComponentInterface
{
    public function getCapabilities(): array;

    public function setCapabilities(array $value): DeviceComponentInterface;

}
