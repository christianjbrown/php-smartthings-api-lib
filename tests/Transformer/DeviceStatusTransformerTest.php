<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatus;
use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementInterface;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTemperatureMeasurementTransformerInterface;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTransformer;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DeviceStatus::class)]
#[CoversClass(DeviceStatusTransformer::class)]
final class DeviceStatusTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $data1 = [DeviceStatusTransformerInterface::KEY_TEMPERATURE_MEASUREMENT => ['test-temperature-measurement']];
        $data2 = [];

        $measurement1 = $this->createMock(DeviceStatusTemperatureMeasurementInterface::class);
        $measurementTransformer = $this->createMock(DeviceStatusTemperatureMeasurementTransformerInterface::class);
        $measurementTransformer->method('transform')
            ->willReturnMap(
                [
                    [['test-temperature-measurement'], $measurement1],
                ]
            );

        $transformer = new DeviceStatusTransformer($measurementTransformer);

        $actual1 = $transformer->transform($data1);
        self::assertSame($measurement1, $actual1->getTemperatureMeasurement());

        $actual2 = $transformer->transform($data2);
        self::assertNull($actual2->getTemperatureMeasurement());
    }
}
