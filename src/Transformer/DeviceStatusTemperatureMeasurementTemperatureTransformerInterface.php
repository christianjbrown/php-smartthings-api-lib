<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementTemperatureInterface;

interface DeviceStatusTemperatureMeasurementTemperatureTransformerInterface
{
    public const KEY_TIMESTAMP = 'timestamp';
    public const KEY_UNIT = 'unit';
    public const KEY_VALUE = 'value';

    public function transform(array $data): DeviceStatusTemperatureMeasurementTemperatureInterface;
}
