<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Transformer;

use ChristianBrown\SmartThings\Model\DeviceComponentCapabilityInterface;
use ChristianBrown\SmartThings\Transformer\DeviceComponentCapabilitiesTransformer;
use ChristianBrown\SmartThings\Transformer\DeviceComponentCapabilitiesTransformerInterface;
use ChristianBrown\SmartThings\Transformer\DeviceComponentCapabilityTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(DeviceComponentCapabilitiesTransformer::class)]
final class DeviceComponentCapabilitiesTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $data = [['test-capability-1'], ['test-capability-2']];

        $capability1 = $this->createMock(DeviceComponentCapabilityInterface::class);
        $capability2 = $this->createMock(DeviceComponentCapabilityInterface::class);
        $capabilities = [$capability1, $capability2];

        $capabilityTransformer = $this->createMock(DeviceComponentCapabilityTransformerInterface::class);
        $capabilityTransformer->method('transform')
            ->willReturnMap(
                [
                    [['test-capability-1'], $capability1],
                    [['test-capability-2'], $capability2],
                ]
            );

        $transformer = new DeviceComponentCapabilitiesTransformer($capabilityTransformer);

        $actual = $transformer->transform($data);

        self::assertSame($capabilities, $actual);
    }

    public function testTransformUnexpected(): void
    {
        $data = [['test-capability-1-array'], 'test-capability-2-not-array', ['test-capability-3-array'], 'test-capability-4-not-array'];

        $capability1 = $this->createMock(DeviceComponentCapabilityInterface::class);
        $capability3 = $this->createMock(DeviceComponentCapabilityInterface::class);

        $capabilityTransformer = $this->createMock(DeviceComponentCapabilityTransformerInterface::class);
        $capabilityTransformer->method('transform')
            ->willReturnMap(
                [
                    [['test-capability-1-array'], $capability1],
                    [['test-capability-3-array'], $capability3],
                ]
            );

        $transformer = new DeviceComponentCapabilitiesTransformer($capabilityTransformer);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf(DeviceComponentCapabilitiesTransformerInterface::UNEXPECTED_ARRAY_SPRINTF, DeviceComponentCapabilitiesTransformerInterface::ARRAY_NAME));

        $transformer->transform($data);
    }
}
