<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceComponentCapabilityInterface
{
    public const ID_VALUE_TEMPERATURE_MEASUREMENT = 'temperatureMeasurement';

    public function getId(): string;
    public function setId(string $value): DeviceComponentCapabilityInterface;
}
