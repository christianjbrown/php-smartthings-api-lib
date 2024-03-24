<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\Device;
use ChristianBrown\SmartThings\Model\DeviceInterface;
use RuntimeException;

use function is_array;
use function is_string;
use function sprintf;

final class DeviceTransformer implements DeviceTransformerInterface
{
    private DeviceComponentsTransformerInterface $deviceComponentsTransformer;

    public function __construct(DeviceComponentsTransformerInterface $deviceComponentsTransformer)
    {
        $this->deviceComponentsTransformer = $deviceComponentsTransformer;
    }

    public function transform(array $data): DeviceInterface
    {
        if (empty($data[self::KEY_DEVICE_ID]) || !is_string($data[self::KEY_DEVICE_ID])) {
            throw new RuntimeException(sprintf(self::UNEXPECTED_STRING_SPRINTF, self::KEY_DEVICE_ID));
        }
        $deviceId = $data[self::KEY_DEVICE_ID];
        $device = new Device($deviceId);

        if (!empty($data[self::KEY_LABEL]) && is_string($data[self::KEY_LABEL])) {
            $device->setLabel($data[self::KEY_LABEL]);
        }

        if (!empty($data[self::KEY_NAME]) && is_string($data[self::KEY_NAME])) {
            $device->setName($data[self::KEY_NAME]);
        }

        if (!empty($data[self::KEY_COMPONENTS]) && is_array($data[self::KEY_COMPONENTS])) {
            $components = $this->deviceComponentsTransformer->transform($data[self::KEY_COMPONENTS]);
            $device->setComponents($components);
        }

        return $device;
    }
}
