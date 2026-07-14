<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceComponent;
use ChristianBrown\SmartThings\Model\DeviceComponentInterface;

use function is_array;
use function sprintf;

final class DeviceComponentTransformer implements DeviceComponentTransformerInterface
{
    private DeviceComponentCapabilitiesTransformerInterface $deviceComponentCapabilitiesTransformer;

    public function __construct(DeviceComponentCapabilitiesTransformerInterface $deviceComponentCapabilitiesTransformer)
    {
        $this->deviceComponentCapabilitiesTransformer = $deviceComponentCapabilitiesTransformer;
    }

    /**
     * @param mixed[] $data
     */
    public function transform(array $data): DeviceComponentInterface
    {
        $component = new DeviceComponent();

        if (empty($data[self::KEY_CAPABILITIES])) {
            throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::KEY_CAPABILITIES));
        }
        if (!is_array($data[self::KEY_CAPABILITIES])) {
            throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::KEY_CAPABILITIES));
        }
        $capabilities = $this->deviceComponentCapabilitiesTransformer->transform($data[self::KEY_CAPABILITIES]);
        $component->setCapabilities($capabilities);

        return $component;
    }
}
