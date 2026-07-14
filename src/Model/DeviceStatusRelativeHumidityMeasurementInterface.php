<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceStatusRelativeHumidityMeasurementInterface
{
    public function getHumidity(): DeviceStatusRelativeHumidityMeasurementHumidityInterface;

    public function setHumidity(DeviceStatusRelativeHumidityMeasurementHumidityInterface $value): self;
}
