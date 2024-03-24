<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementInterface;

interface DeviceStatusTemperatureMeasurementTransformerInterface
{
    public const KEY_TEMPERATURE = 'temperature';
    public const UNEXPECTED_ARRAY_SPRINTF = '%s not set or not an array';

    public function transform(array $data): DeviceStatusTemperatureMeasurementInterface;
}
