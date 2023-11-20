<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\DeviceInterface;

interface DeviceTransformerInterface
{
    public const KEY_COMPONENTS = 'components';
    public const KEY_DEVICE_ID = 'deviceId';
    public const KEY_LABEL = 'label';
    public const KEY_NAME = 'name';

    public function transform(array $data): DeviceInterface;
}
