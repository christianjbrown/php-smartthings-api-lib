<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatus;
use ChristianBrown\SmartThings\Model\DeviceStatusInterface;

use function is_array;

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
        if (!empty($data[self::KEY_TEMPERATURE_MEASUREMENT]) && is_array($data[self::KEY_TEMPERATURE_MEASUREMENT])) {
            $temperatureMeasurement = $this->deviceStatusTemperatureMeasurementTransformer->transform($data[self::KEY_TEMPERATURE_MEASUREMENT]);
            $status->setTemperatureMeasurement($temperatureMeasurement);
        }

        return $status;
    }
}
