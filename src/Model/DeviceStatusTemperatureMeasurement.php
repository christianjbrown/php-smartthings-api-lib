<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class DeviceStatusTemperatureMeasurement implements DeviceStatusTemperatureMeasurementInterface
{
    private DeviceStatusTemperatureMeasurementTemperatureInterface $temperature;

    public function getTemperature(): DeviceStatusTemperatureMeasurementTemperatureInterface
    {
        return $this->temperature;
    }

    public function setTemperature(DeviceStatusTemperatureMeasurementTemperatureInterface $value): self
    {
        $this->temperature = $value;

        return $this;
    }

}
