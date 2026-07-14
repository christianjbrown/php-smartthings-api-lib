<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class DeviceStatus implements DeviceStatusInterface
{
    private ?DeviceStatusRelativeHumidityMeasurementInterface $relativeHumidityMeasurement = null;
    private ?DeviceStatusTemperatureMeasurementInterface $temperatureMeasurement = null;

    public function getRelativeHumidityMeasurement(): ?DeviceStatusRelativeHumidityMeasurementInterface
    {
        return $this->relativeHumidityMeasurement;
    }

    public function getTemperatureMeasurement(): ?DeviceStatusTemperatureMeasurementInterface
    {
        return $this->temperatureMeasurement;
    }

    public function setRelativeHumidityMeasurement(?DeviceStatusRelativeHumidityMeasurementInterface $relativeHumidityMeasurement): DeviceStatusInterface
    {
        $this->relativeHumidityMeasurement = $relativeHumidityMeasurement;

        return $this;
    }

    public function setTemperatureMeasurement(?DeviceStatusTemperatureMeasurementInterface $temperatureMeasurement): DeviceStatusInterface
    {
        $this->temperatureMeasurement = $temperatureMeasurement;

        return $this;
    }
}
