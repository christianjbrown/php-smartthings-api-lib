<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceInterface;

interface DevicesTransformerInterface
{
    public const ARRAY_NAME = 'device';
    public const UNEXPECTED_ARRAY_SPRINTF = '%s not set or not an array';

    /**
     * @param mixed[] $data
     *
     * @return array<int, DeviceInterface>
     */
    public function transform(array $data): array;
}
