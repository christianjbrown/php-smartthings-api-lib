<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceComponent;
use ChristianBrown\SmartThings\Model\DeviceComponentInterface;
use RuntimeException;

use function is_array;
use function sprintf;

final class DeviceComponentTransformer implements DeviceComponentTransformerInterface
{
    private DeviceComponentCapabilitiesTransformerInterface $deviceComponentCapabilitiesTransformer;

    public function __construct(DeviceComponentCapabilitiesTransformerInterface $deviceComponentCapabilitiesTransformer)
    {
        $this->deviceComponentCapabilitiesTransformer = $deviceComponentCapabilitiesTransformer;
    }

    public function transform(array $data): DeviceComponentInterface
    {
        $component = new DeviceComponent();

        if (empty($data[self::KEY_CAPABILITIES]) || !is_array($data[self::KEY_CAPABILITIES])) {
            throw new RuntimeException(sprintf('%s not set or not an array', self::KEY_CAPABILITIES));
        }
        $capabilities = $this->deviceComponentCapabilitiesTransformer->transform($data[self::KEY_CAPABILITIES]);
        $component->setCapabilities($capabilities);

        return $component;
    }
}
