<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Model\LocationRoomInterface;

interface LocationRoomTransformerInterface
{
    public const KEY_LOCATION_ID = 'locationId';
    public const KEY_NAME = 'name';
    public const KEY_ROOM_ID = 'roomId';
    public const UNEXPECTED_STRING_SPRINTF = '%s not set or not a string';

    /**
     * @param mixed[] $data
     */
    public function transform(array $data): LocationRoomInterface;
}
