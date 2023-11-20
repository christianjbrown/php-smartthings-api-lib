<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementInterface;

interface DeviceStatusTemperatureMeasurementTransformerInterface
{
    public const KEY_TEMPERATURE = 'temperature';

    public function transform(array $data): DeviceStatusTemperatureMeasurementInterface;
}
