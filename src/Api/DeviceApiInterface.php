<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Api;

interface DeviceApiInterface extends ApiInterface
{
    public const API_URL = 'https://api.smartthings.com/v1/devices/';
    public const KEY_ITEMS = 'items';
    public const UNEXPECTED_RESPONSE_SPRINTF = '%s not set or not an array';

    public function get(): array;
}
