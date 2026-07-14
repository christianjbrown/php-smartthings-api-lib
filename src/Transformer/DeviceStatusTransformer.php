<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatus;
use ChristianBrown\SmartThings\Model\DeviceStatusInterface;

use function is_array;

final class DeviceStatusTransformer implements DeviceStatusTransformerInterface
{
    private DeviceStatusRelativeHumidityMeasurementTransformerInterface $deviceStatusRelativeHumidityMeasurementTransformer;
    private DeviceStatusTemperatureMeasurementTransformerInterface $deviceStatusTemperatureMeasurementTransformer;

    public function __construct(DeviceStatusTemperatureMeasurementTransformerInterface $deviceStatusTemperatureMeasurementTransformer, DeviceStatusRelativeHumidityMeasurementTransformerInterface $deviceStatusRelativeHumidityMeasurementTransformer)
    {
        $this->deviceStatusTemperatureMeasurementTransformer = $deviceStatusTemperatureMeasurementTransformer;
        $this->deviceStatusRelativeHumidityMeasurementTransformer = $deviceStatusRelativeHumidityMeasurementTransformer;
    }

    /**
     * @param mixed[] $data
     */
    public function transform(array $data): DeviceStatusInterface
    {
        $status = new DeviceStatus();
        if (!empty($data[self::KEY_TEMPERATURE_MEASUREMENT])) {
            if (is_array($data[self::KEY_TEMPERATURE_MEASUREMENT])) {
                $temperatureMeasurement = $this->deviceStatusTemperatureMeasurementTransformer->transform($data[self::KEY_TEMPERATURE_MEASUREMENT]);
                $status->setTemperatureMeasurement($temperatureMeasurement);
            }
        }
        if (!empty($data[self::KEY_RELATIVE_HUMIDITY_MEASUREMENT])) {
            if (is_array($data[self::KEY_RELATIVE_HUMIDITY_MEASUREMENT])) {
                $relativeHumidityMeasurement = $this->deviceStatusRelativeHumidityMeasurementTransformer->transform($data[self::KEY_RELATIVE_HUMIDITY_MEASUREMENT]);
                $status->setRelativeHumidityMeasurement($relativeHumidityMeasurement);
            }
        }

        return $status;
    }
}
