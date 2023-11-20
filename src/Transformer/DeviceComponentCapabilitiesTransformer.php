<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

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
            $capabilities[] = $this->deviceComponentCapabilityTransformer->transform($capabilityData);
        }

        return $capabilities;
    }
}
