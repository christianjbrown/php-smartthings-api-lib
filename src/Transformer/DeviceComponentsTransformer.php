<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

final class DeviceComponentsTransformer implements DeviceComponentsTransformerInterface
{
    private DeviceComponentTransformerInterface $deviceComponentTransformer;

    public function __construct(DeviceComponentTransformerInterface $deviceComponentTransformer)
    {
        $this->deviceComponentTransformer = $deviceComponentTransformer;
    }

    public function transform(array $data): array
    {
        $components = [];
        foreach ($data as $componentData) {
            $components[] = $this->deviceComponentTransformer->transform($componentData);
        }

        return $components;
    }
}
