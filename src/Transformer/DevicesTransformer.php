<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

final class DevicesTransformer implements DevicesTransformerInterface
{
    private DeviceTransformerInterface $deviceTransformer;

    public function __construct(DeviceTransformerInterface $deviceTransformer)
    {
        $this->deviceTransformer = $deviceTransformer;
    }

    public function transform(array $data): array
    {
        $devices = [];
        foreach ($data as $deviceData) {
            $devices[] = $this->deviceTransformer->transform($deviceData);
        }

        return $devices;
    }
}
