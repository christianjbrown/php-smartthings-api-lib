<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Model;

use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementTemperature;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DeviceStatusTemperatureMeasurementTemperature::class)]
final class DeviceStatusTemperatureMeasurementTemperatureTest extends TestCase
{
    public function test(): void
    {
        $temp = new DeviceStatusTemperatureMeasurementTemperature(42, 'test-unit', 123.45);
        self::assertSame(42, $temp->getTimestamp());
        self::assertSame('test-unit', $temp->getUnit());
        self::assertSame(123.45, $temp->getValue());

        self::assertSame($temp, $temp->setTimestamp(43));
        self::assertSame($temp, $temp->setUnit('test-new-unit'));
        self::assertSame($temp, $temp->setValue(543.21));

        self::assertSame(43, $temp->getTimestamp());
        self::assertSame('test-new-unit', $temp->getUnit());
        self::assertSame(543.21, $temp->getValue());
    }
}
