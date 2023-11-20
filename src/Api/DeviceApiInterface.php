<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Api;

interface DeviceApiInterface
{
    public const API_NAME = 'SmartThings Device API';
    public const API_URL = 'https://api.smartthings.com/v1/devices/';
    public const KEY_ITEMS = 'items';

    public function get(): array;
}
