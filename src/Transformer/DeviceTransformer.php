<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\Device;
use ChristianBrown\SmartThings\Model\DeviceInterface;
use RuntimeException;

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
        $device = new Device();
        foreach ([self::KEY_DEVICE_ID, self::KEY_LABEL, self::KEY_NAME] as $key) {
            if (empty($data[$key]) || !is_string($data[$key])) {
                throw new RuntimeException(sprintf('%s not set or not a string', $key));
            }
        }
        $device->setDeviceId($data[self::KEY_DEVICE_ID]);
        $device->setLabel($data[self::KEY_LABEL]);
        $device->setName($data[self::KEY_NAME]);

        if (empty($data[self::KEY_COMPONENTS]) || !is_array($data[self::KEY_COMPONENTS])) {
            throw new RuntimeException(sprintf('%s not set or not an array', self::KEY_COMPONENTS));
        }
        $components = $this->deviceComponentsTransformer->transform($data[self::KEY_COMPONENTS]);
        $device->setComponents($components);

        return $device;
    }
}
