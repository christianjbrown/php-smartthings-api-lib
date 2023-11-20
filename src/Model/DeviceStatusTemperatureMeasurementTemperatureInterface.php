<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceStatusTemperatureMeasurementTemperatureInterface
{
    public function getValue(): float;

    public function setValue(float $value): self;

    public function getUnit(): string;

    public function setUnit(string $value): self;

    public function setTimestamp(int $value): self;

    public function getTimestamp(): int;


}
