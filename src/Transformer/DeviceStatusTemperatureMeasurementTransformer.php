<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurement;
use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementInterface;
use RuntimeException;

use function is_array;
use function sprintf;

final class DeviceStatusTemperatureMeasurementTransformer implements DeviceStatusTemperatureMeasurementTransformerInterface
{
    private DeviceStatusTemperatureMeasurementTemperatureTransformerInterface $deviceStatusTemperatureMeasurementTemperatureTransformer;

    public function __construct(DeviceStatusTemperatureMeasurementTemperatureTransformerInterface $deviceStatusTemperatureMeasurementTemperatureTransformer)
    {
        $this->deviceStatusTemperatureMeasurementTemperatureTransformer = $deviceStatusTemperatureMeasurementTemperatureTransformer;
    }

    public function transform(array $data): DeviceStatusTemperatureMeasurementInterface
    {
        if (empty($data[self::KEY_TEMPERATURE]) || !is_array($data[self::KEY_TEMPERATURE])) {
            throw new RuntimeException(sprintf('%s not set or not an array', self::KEY_TEMPERATURE));
        }
        $temperature = $this->deviceStatusTemperatureMeasurementTemperatureTransformer->transform($data[self::KEY_TEMPERATURE]);
        $temperatureMeasurement = new DeviceStatusTemperatureMeasurement($temperature);

        return $temperatureMeasurement;
    }
}
