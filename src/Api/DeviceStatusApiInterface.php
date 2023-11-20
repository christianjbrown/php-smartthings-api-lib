<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Api;

use ChristianBrown\SmartThings\Model\DeviceInterface;
use ChristianBrown\SmartThings\Model\DeviceStatusInterface;

interface DeviceStatusApiInterface
{
    public const API_NAME = 'SmartThings Device Status API';
    public const API_URL_SPRINTF = 'https://api.smartthings.com/v1/devices/%s/status';
    public const KEY_COMPONENTS = 'components';
    public const KEY_COMPONENTS_MAIN = 'main';

    public function get(DeviceInterface $device): DeviceStatusInterface;
}
