<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use RuntimeException;

use function sprintf;

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
            if (!is_array($deviceData)) {
                throw new RuntimeException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::ARRAY_NAME));
            }
            $devices[] = $this->deviceTransformer->transform($deviceData);
        }

        return $devices;
    }
}
