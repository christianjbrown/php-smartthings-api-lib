<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

interface DeviceComponentsTransformerInterface
{
    public const ARRAY_NAME = 'device';
    public const UNEXPECTED_ARRAY_SPRINTF = '%s not set or not an array';

    public function transform(array $data): array;
}
