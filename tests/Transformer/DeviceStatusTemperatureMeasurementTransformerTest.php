<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurement;
use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementTemperatureInterface;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTemperatureMeasurementTemperatureTransformerInterface;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTemperatureMeasurementTransformer;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTemperatureMeasurementTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(DeviceStatusTemperatureMeasurement::class)]
#[CoversClass(DeviceStatusTemperatureMeasurementTransformer::class)]
final class DeviceStatusTemperatureMeasurementTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $data = [
            DeviceStatusTemperatureMeasurementTransformerInterface::KEY_TEMPERATURE => ['test-temperature'],
        ];

        $temperature = $this->createMock(DeviceStatusTemperatureMeasurementTemperatureInterface::class);

        $tempTransformer = $this->createMock(DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::class);
        $tempTransformer->method('transform')
            ->with(['test-temperature'])
            ->willReturn($temperature);

        $transformer = new DeviceStatusTemperatureMeasurementTransformer($tempTransformer);

        $actual = $transformer->transform($data);

        self::assertSame($temperature, $actual->getTemperature());
    }

    #[TestWith([[]])]
    #[TestWith([[DeviceStatusTemperatureMeasurementTransformerInterface::KEY_TEMPERATURE => 'test-not-an-array']])]
    public function testTransformUnexpectedData(array $data): void
    {
        $tempTransformer = $this->createMock(DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::class);
        $transformer = new DeviceStatusTemperatureMeasurementTransformer($tempTransformer);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf(DeviceStatusTemperatureMeasurementTransformerInterface::UNEXPECTED_ARRAY_SPRINTF, DeviceStatusTemperatureMeasurementTransformerInterface::KEY_TEMPERATURE));
        $transformer->transform($data);
    }
}
