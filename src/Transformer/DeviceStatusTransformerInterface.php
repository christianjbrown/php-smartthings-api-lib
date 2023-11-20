<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatusInterface;

interface DeviceStatusTransformerInterface
{
    public const KEY_TEMPERATURE_MEASUREMENT = 'temperatureMeasurement';

    public function transform(array $data): DeviceStatusInterface;
}
