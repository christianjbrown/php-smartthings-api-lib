<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatus;
use ChristianBrown\SmartThings\Model\DeviceStatusInterface;
use RuntimeException;
use function is_array;
use function json_encode;
use function sprintf;
use const JSON_PRETTY_PRINT;

final class DeviceStatusTransformer implements DeviceStatusTransformerInterface
{
    private DeviceStatusTemperatureMeasurementTransformerInterface $deviceStatusTemperatureMeasurementTransformer;

    public function __construct(DeviceStatusTemperatureMeasurementTransformerInterface $deviceStatusTemperatureMeasurementTransformer)
    {
        $this->deviceStatusTemperatureMeasurementTransformer = $deviceStatusTemperatureMeasurementTransformer;
    }

    public function transform(array $data): DeviceStatusInterface
    {
        $status = new DeviceStatus();
        if (empty($data[self::KEY_TEMPERATURE_MEASUREMENT]) || !is_array($data[self::KEY_TEMPERATURE_MEASUREMENT])) {
            throw new RuntimeException(sprintf('%s not set or not an array', self::KEY_TEMPERATURE_MEASUREMENT));
        }
        $temperatureMeasurement = $this->deviceStatusTemperatureMeasurementTransformer->transform($data[self::KEY_TEMPERATURE_MEASUREMENT]);
        $status->setTemperatureMeasurement($temperatureMeasurement);

        return $status;
    }
}
