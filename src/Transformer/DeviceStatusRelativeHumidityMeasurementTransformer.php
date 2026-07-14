<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceStatusRelativeHumidityMeasurement;
use ChristianBrown\SmartThings\Model\DeviceStatusRelativeHumidityMeasurementInterface;

use function is_array;
use function sprintf;

final class DeviceStatusRelativeHumidityMeasurementTransformer implements DeviceStatusRelativeHumidityMeasurementTransformerInterface
{
    private DeviceStatusRelativeHumidityMeasurementHumidityTransformerInterface $deviceStatusRelativeHumidityMeasurementHumidityTransformer;

    public function __construct(DeviceStatusRelativeHumidityMeasurementHumidityTransformerInterface $deviceStatusRelativeHumidityMeasurementHumidityTransformer)
    {
        $this->deviceStatusRelativeHumidityMeasurementHumidityTransformer = $deviceStatusRelativeHumidityMeasurementHumidityTransformer;
    }

    /**
     * @param mixed[] $data
     */
    public function transform(array $data): DeviceStatusRelativeHumidityMeasurementInterface
    {
        if (empty($data[self::KEY_HUMIDITY])) {
            throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::KEY_HUMIDITY));
        }
        if (!is_array($data[self::KEY_HUMIDITY])) {
            throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::KEY_HUMIDITY));
        }
        $humidity = $this->deviceStatusRelativeHumidityMeasurementHumidityTransformer->transform($data[self::KEY_HUMIDITY]);
        $relativeHumidityMeasurement = new DeviceStatusRelativeHumidityMeasurement($humidity);

        return $relativeHumidityMeasurement;
    }
}
