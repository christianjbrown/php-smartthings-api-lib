<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Transformer;

use ChristianBrown\SmartThings\Model\DeviceStatusTemperatureMeasurementTemperature;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTemperatureMeasurementTemperatureTransformer;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTemperatureMeasurementTemperatureTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(DeviceStatusTemperatureMeasurementTemperature::class)]
#[CoversClass(DeviceStatusTemperatureMeasurementTemperatureTransformer::class)]
final class DeviceStatusTemperatureMeasurementTemperatureTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $data = [
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP => '2021-02-03 12:34:56',
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE => 123.45,
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT => 'test-unit',
        ];

        $transformer = new DeviceStatusTemperatureMeasurementTemperatureTransformer();

        $actual = $transformer->transform($data);

        self::assertSame(1612355696, $actual->getTimestamp());
        self::assertSame(123.45, $actual->getValue());
        self::assertSame('test-unit', $actual->getUnit());
    }

    #[TestWith([
        [
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP => 42,
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE => 123.45,
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT => 'test-unit',
        ],
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::UNEXPECTED_STRING_SPRINTF,
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP,
    ])]
    #[TestWith([
        [
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE => 123.45,
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT => 'test-unit',
        ],
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::UNEXPECTED_STRING_SPRINTF,
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP,
    ])]
    #[TestWith([
        [
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP => 'test-not-a-timestamp',
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE => 123.45,
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT => 'test-unit',
        ],
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::UNEXPECTED_DATA_TIMESTAMP,
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP,
    ])]
    #[TestWith([
        [
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP => '2021-02-03 12:34:56',
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT => 'test-unit',
        ],
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::UNEXPECTED_FLOAT_SPRINTF,
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE,
    ])]
    #[TestWith([
        [
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP => '2021-02-03 12:34:56',
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE => 'test-not-a-float',
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT => 'test-unit',
        ],
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::UNEXPECTED_FLOAT_SPRINTF,
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE,
    ])]
    #[TestWith([
        [
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP => '2021-02-03 12:34:56',
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE => 123.45,
        ],
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::UNEXPECTED_STRING_SPRINTF,
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT,
    ])]
    #[TestWith([
        [
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_TIMESTAMP => '2021-02-03 12:34:56',
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_VALUE => 123.45,
            DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT => ['test-not-a-string'],
        ],
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::UNEXPECTED_STRING_SPRINTF,
        DeviceStatusTemperatureMeasurementTemperatureTransformerInterface::KEY_UNIT,
    ])]
    public function testTransformUnexpectedData(array $data, string $exceptionMessage, string $exceptionMessageField): void
    {
        $transformer = new DeviceStatusTemperatureMeasurementTemperatureTransformer();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf($exceptionMessage, $exceptionMessageField));
        $transformer->transform($data);
    }
}
