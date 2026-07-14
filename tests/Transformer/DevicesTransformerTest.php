<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Transformer;

use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceInterface;
use ChristianBrown\SmartThings\Transformer\DevicesTransformer;
use ChristianBrown\SmartThings\Transformer\DevicesTransformerInterface;
use ChristianBrown\SmartThings\Transformer\DeviceTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DevicesTransformer::class)]
final class DevicesTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $data = [['test-device-1'], ['test-device-2']];

        $device1 = $this->createMock(DeviceInterface::class);
        $device2 = $this->createMock(DeviceInterface::class);
        $devices = [$device1, $device2];

        $deviceTransformer = $this->createMock(DeviceTransformerInterface::class);
        $deviceTransformer->method('transform')
            ->willReturnMap(
                [
                    [['test-device-1'], $device1],
                    [['test-device-2'], $device2],
                ]
            );

        $transformer = new DevicesTransformer($deviceTransformer);

        $actual = $transformer->transform($data);

        self::assertSame($devices, $actual);
    }

    public function testTransformEmpty(): void
    {
        $deviceTransformer = $this->createMock(DeviceTransformerInterface::class);

        $transformer = new DevicesTransformer($deviceTransformer);

        self::assertSame([], $transformer->transform([]));
    }

    public function testTransformSingle(): void
    {
        $device1 = $this->createMock(DeviceInterface::class);

        $deviceTransformer = $this->createMock(DeviceTransformerInterface::class);
        $deviceTransformer->method('transform')
            ->with(['test-device-1'])
            ->willReturn($device1);

        $transformer = new DevicesTransformer($deviceTransformer);

        self::assertSame([$device1], $transformer->transform([['test-device-1']]));
    }

    public function testTransformThrowsOnFirstNonArray(): void
    {
        $deviceTransformer = $this->createMock(DeviceTransformerInterface::class);

        $transformer = new DevicesTransformer($deviceTransformer);

        $this->expectException(UnexpectedResponseException::class);
        $this->expectExceptionMessage(sprintf(DevicesTransformerInterface::UNEXPECTED_ARRAY_SPRINTF, DevicesTransformerInterface::ARRAY_NAME));

        $transformer->transform(['test-device-1-not-array']);
    }

    public function testTransformUnexpected(): void
    {
        $data = [['test-device-1-array'], 'test-device-2-not-array', ['test-device-3-array'], 'test-device-4-not-array'];

        $device1 = $this->createMock(DeviceInterface::class);
        $device3 = $this->createMock(DeviceInterface::class);

        $deviceTransformer = $this->createMock(DeviceTransformerInterface::class);
        $deviceTransformer->method('transform')
            ->willReturnMap(
                [
                    [['test-device-1-array'], $device1],
                    [['test-device-3-array'], $device3],
                ]
            );

        $transformer = new DevicesTransformer($deviceTransformer);

        $this->expectException(UnexpectedResponseException::class);
        $this->expectExceptionMessage(sprintf(DevicesTransformerInterface::UNEXPECTED_ARRAY_SPRINTF, DevicesTransformerInterface::ARRAY_NAME));

        $transformer->transform($data);
    }
}
