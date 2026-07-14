<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Model;

use ChristianBrown\SmartThings\Model\LocationRoom;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(LocationRoom::class)]
final class LocationRoomTest extends TestCase
{
    public function test(): void
    {
        $room = new LocationRoom('test-room-id');
        self::assertSame('test-room-id', $room->getRoomId());
        self::assertNull($room->getLocationId());
        self::assertNull($room->getName());

        self::assertSame($room, $room->setRoomId('test-new-room-id'));
        self::assertSame($room, $room->setLocationId('test-location-id'));
        self::assertSame($room, $room->setName('test-name'));

        self::assertSame('test-new-room-id', $room->getRoomId());
        self::assertSame('test-location-id', $room->getLocationId());
        self::assertSame('test-name', $room->getName());
    }
}
