<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

interface DeviceComponentCapabilitiesTransformerInterface
{
    public const ID_VALUE_TEMPERATURE_MEASUREMENT = 'temperatureMeasurement';

    public function transform(array $data): array;
}
