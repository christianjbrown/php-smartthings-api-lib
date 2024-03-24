<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use RuntimeException;

use function is_array;
use function sprintf;

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
            if (!is_array($componentData)) {
                throw new RuntimeException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::ARRAY_NAME));
            }
            $components[] = $this->deviceComponentTransformer->transform($componentData);
        }

        return $components;
    }
}
