<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceStatusInterface
{
    public function getTemperatureMeasurement(): ?DeviceStatusTemperatureMeasurementInterface;

    public function setTemperatureMeasurement(?DeviceStatusTemperatureMeasurementInterface $temperatureMeasurement): self;
}
