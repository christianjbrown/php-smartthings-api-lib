<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Api;

interface ApiInterface
{
    public const HEADER_KEY_AUTHORIZATION = 'Authorization';
    public const HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF = 'Bearer %s';
}
