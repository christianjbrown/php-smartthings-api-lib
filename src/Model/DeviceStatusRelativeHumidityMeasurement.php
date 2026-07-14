<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class DeviceStatusRelativeHumidityMeasurement implements DeviceStatusRelativeHumidityMeasurementInterface
{
    private DeviceStatusRelativeHumidityMeasurementHumidityInterface $humidity;

    public function __construct(DeviceStatusRelativeHumidityMeasurementHumidityInterface $humidity)
    {
        $this->humidity = $humidity;
    }

    public function getHumidity(): DeviceStatusRelativeHumidityMeasurementHumidityInterface
    {
        return $this->humidity;
    }

    public function setHumidity(DeviceStatusRelativeHumidityMeasurementHumidityInterface $value): self
    {
        $this->humidity = $value;

        return $this;
    }
}
