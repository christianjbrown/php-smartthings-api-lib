<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurement;
use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementInterface;

use function is_array;
use function sprintf;

final class DeviceStatusTemperatureMeasurementTransformer implements DeviceStatusTemperatureMeasurementTransformerInterface
{
    private DeviceStatusTemperatureMeasurementTemperatureTransformerInterface $deviceStatusTemperatureMeasurementTemperatureTransformer;

    public function __construct(DeviceStatusTemperatureMeasurementTemperatureTransformerInterface $deviceStatusTemperatureMeasurementTemperatureTransformer)
    {
        $this->deviceStatusTemperatureMeasurementTemperatureTransformer = $deviceStatusTemperatureMeasurementTemperatureTransformer;
    }

    /**
     * @param mixed[] $data
     */
    public function transform(array $data): DeviceStatusTemperatureMeasurementInterface
    {
        if (empty($data[self::KEY_TEMPERATURE])) {
            throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::KEY_TEMPERATURE));
        }
        if (!is_array($data[self::KEY_TEMPERATURE])) {
            throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::KEY_TEMPERATURE));
        }
        $temperature = $this->deviceStatusTemperatureMeasurementTemperatureTransformer->transform($data[self::KEY_TEMPERATURE]);
        $temperatureMeasurement = new DeviceStatusTemperatureMeasurement($temperature);

        return $temperatureMeasurement;
    }
}
