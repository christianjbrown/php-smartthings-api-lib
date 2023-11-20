<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceComponentCapability;
use ChristianBrown\SmartThings\Model\DeviceComponentCapabilityInterface;
use RuntimeException;

use function is_string;
use function sprintf;

final class DeviceComponentCapabilityTransformer implements DeviceComponentCapabilityTransformerInterface
{
    public function transform(array $data): DeviceComponentCapabilityInterface
    {
        $capability = new DeviceComponentCapability();
        if (empty($data[self::KEY_ID]) || !is_string($data[self::KEY_ID])) {
            throw new RuntimeException(sprintf('%s not set or not a string', self::KEY_ID));
        }
        $capability->setId($data[self::KEY_ID]);

        return $capability;
    }
}
