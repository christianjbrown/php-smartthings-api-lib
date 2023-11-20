<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

final class DeviceStatusTemperatureMeasurementTemperature implements DeviceStatusTemperatureMeasurementTemperatureInterface
{
    private int $timestamp;
    private string $unit;
    private float $value;

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function setTimestamp(int $value): DeviceStatusTemperatureMeasurementTemperatureInterface
    {
        $this->timestamp = $value;

        return $this;
    }

    public function setUnit(string $value): DeviceStatusTemperatureMeasurementTemperatureInterface
    {
        $this->unit = $value;

        return $this;
    }

    public function setValue(float $value): DeviceStatusTemperatureMeasurementTemperatureInterface
    {
        $this->value = $value;

        return $this;
    }
}
