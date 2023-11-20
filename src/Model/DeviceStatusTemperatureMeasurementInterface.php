<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceStatusTemperatureMeasurementInterface
{
    public function getTemperature(): DeviceStatusTemperatureMeasurementTemperatureInterface;
    public function setTemperature(DeviceStatusTemperatureMeasurementTemperatureInterface $value): self;


}
