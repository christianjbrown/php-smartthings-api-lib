<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceComponentCapabilityInterface;

interface DeviceComponentCapabilityTransformerInterface
{
    public const KEY_ID = 'id';

    public function transform(array $data): DeviceComponentCapabilityInterface;
}
