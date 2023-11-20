<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceComponentInterface;

interface DeviceComponentTransformerInterface
{
    public const KEY_CAPABILITIES = 'capabilities';

    public function transform(array $data): DeviceComponentInterface;
}
