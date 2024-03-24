<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Transformer;

use ChristianBrown\SmartThings\Model\DeviceComponentInterface;
use ChristianBrown\SmartThings\Transformer\DeviceComponentsTransformer;
use ChristianBrown\SmartThings\Transformer\DeviceComponentsTransformerInterface;
use ChristianBrown\SmartThings\Transformer\DeviceComponentTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(DeviceComponentsTransformer::class)]
final class DeviceComponentsTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $data = [['test-component-1'], ['test-component-2']];

        $component1 = $this->createMock(DeviceComponentInterface::class);
        $component2 = $this->createMock(DeviceComponentInterface::class);
        $components = [$component1, $component2];

        $componentTransformer = $this->createMock(DeviceComponentTransformerInterface::class);
        $componentTransformer->method('transform')
            ->willReturnMap(
                [
                    [['test-component-1'], $component1],
                    [['test-component-2'], $component2],
                ]
            );

        $transformer = new DeviceComponentsTransformer($componentTransformer);

        $actual = $transformer->transform($data);

        self::assertSame($components, $actual);
    }

    public function testTransformUnexpected(): void
    {
        $data = [['test-component-1-array'], 'test-component-2-not-array', ['test-component-3-array'], 'test-component-4-not-array'];

        $component1 = $this->createMock(DeviceComponentInterface::class);
        $component3 = $this->createMock(DeviceComponentInterface::class);

        $componentTransformer = $this->createMock(DeviceComponentTransformerInterface::class);
        $componentTransformer->method('transform')
            ->willReturnMap(
                [
                    [['test-component-1-array'], $component1],
                    [['test-component-3-array'], $component3],
                ]
            );

        $transformer = new DeviceComponentsTransformer($componentTransformer);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf(DeviceComponentsTransformerInterface::UNEXPECTED_ARRAY_SPRINTF, DeviceComponentsTransformerInterface::ARRAY_NAME));

        $transformer->transform($data);
    }
}
