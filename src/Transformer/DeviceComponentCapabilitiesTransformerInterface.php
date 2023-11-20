<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

interface DeviceComponentCapabilitiesTransformerInterface
{
    public function transform(array $data): array;
}
