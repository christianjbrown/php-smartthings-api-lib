<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Model;

use ChristianBrown\SmartThings\Model\Location;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Location::class)]
final class LocationTest extends TestCase
{
    public function test(): void
    {
        $location = new Location('test-location-id');
        self::assertSame('test-location-id', $location->getLocationId());
        self::assertNull($location->getName());

        self::assertSame($location, $location->setLocationId('test-new-location-id'));
        self::assertSame($location, $location->setName('test-name'));

        self::assertSame('test-new-location-id', $location->getLocationId());
        self::assertSame('test-name', $location->getName());
    }
}
