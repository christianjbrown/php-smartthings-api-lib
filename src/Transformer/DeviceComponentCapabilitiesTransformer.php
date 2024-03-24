<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use RuntimeException;

use function is_array;
use function sprintf;

final class DeviceComponentCapabilitiesTransformer implements DeviceComponentCapabilitiesTransformerInterface
{
    private DeviceComponentCapabilityTransformerInterface $deviceComponentCapabilityTransformer;

    public function __construct(DeviceComponentCapabilityTransformerInterface $deviceComponentCapabilityTransformer)
    {
        $this->deviceComponentCapabilityTransformer = $deviceComponentCapabilityTransformer;
    }

    public function transform(array $data): array
    {
        $capabilities = [];
        foreach ($data as $capabilityData) {
            if (!is_array($capabilityData)) {
                throw new RuntimeException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::ARRAY_NAME));
            }
            $capabilities[] = $this->deviceComponentCapabilityTransformer->transform($capabilityData);
        }

        return $capabilities;
    }
}
