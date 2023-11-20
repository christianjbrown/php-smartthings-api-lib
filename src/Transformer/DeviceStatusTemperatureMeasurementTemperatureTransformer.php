<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementTemperature;
use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementTemperatureInterface;
use RuntimeException;

use function is_string;
use function sprintf;
use function strtotime;

final class DeviceStatusTemperatureMeasurementTemperatureTransformer implements DeviceStatusTemperatureMeasurementTemperatureTransformerInterface
{
    public function transform(array $data): DeviceStatusTemperatureMeasurementTemperatureInterface
    {
        if (empty($data[self::KEY_TIMESTAMP]) || !is_string($data[self::KEY_TIMESTAMP])) {
            throw new RuntimeException(sprintf('%s not set or not a string', self::KEY_TIMESTAMP));
        }
        $timestamp = strtotime($data[self::KEY_TIMESTAMP]);
        if (false === $timestamp) {
            throw new RuntimeException(sprintf('%s not a valid timestamp', $data[self::KEY_TIMESTAMP]));
        }

        if (empty($data[self::KEY_UNIT]) || !is_string($data[self::KEY_UNIT])) {
            throw new RuntimeException(sprintf('%s not set or not a string', self::KEY_UNIT));
        }
        $unit = $data[self::KEY_UNIT];

        if (empty($data[self::KEY_VALUE]) || !is_float($data[self::KEY_VALUE])) {
            throw new RuntimeException(sprintf('%s not set or not a float', self::KEY_VALUE));
        }
        $value = $data[self::KEY_VALUE];

        $temperature = new DeviceStatusTemperatureMeasurementTemperature($timestamp, $unit, $value);

        return $temperature;
    }
}
