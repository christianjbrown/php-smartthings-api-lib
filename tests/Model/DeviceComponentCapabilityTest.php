<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Model;

use ChristianBrown\SmartThings\Model\DeviceComponentCapability;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DeviceComponentCapability::class)]
final class DeviceComponentCapabilityTest extends TestCase
{
    public function test(): void
    {
        $capability = new DeviceComponentCapability('test-id');
        self::assertSame('test-id', $capability->getId());
        self::assertSame($capability, $capability->setId('test-new-id'));
        self::assertSame('test-new-id', $capability->getId());
    }
}
