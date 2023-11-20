<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class DeviceStatus implements DeviceStatusInterface
{
    private ?DeviceStatusTemperatureMeasurementInterface $temperatureMeasurement = null;

    public function getTemperatureMeasurement(): ?DeviceStatusTemperatureMeasurementInterface
    {
        return $this->temperatureMeasurement;
    }

    public function setTemperatureMeasurement(?DeviceStatusTemperatureMeasurementInterface $temperatureMeasurement): DeviceStatusInterface
    {
        $this->temperatureMeasurement = $temperatureMeasurement;

        return $this;
    }
}
