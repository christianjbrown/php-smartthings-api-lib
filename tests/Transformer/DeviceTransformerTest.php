<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Transformer;

use ChristianBrown\SmartThings\Model\Device;
use ChristianBrown\SmartThings\Model\DeviceComponentInterface;
use ChristianBrown\SmartThings\Transformer\DeviceComponentsTransformerInterface;
use ChristianBrown\SmartThings\Transformer\DeviceTransformer;
use ChristianBrown\SmartThings\Transformer\DeviceTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(Device::class)]
#[CoversClass(DeviceTransformer::class)]
final class DeviceTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $componentsData = ['test-component-1', 'test-component-2'];
        $data = [
            DeviceTransformerInterface::KEY_DEVICE_ID => 'test-device-id',
            DeviceTransformerInterface::KEY_LABEL => 'test-label',
            DeviceTransformerInterface::KEY_NAME => 'test-name',
            DeviceTransformerInterface::KEY_COMPONENTS => $componentsData,
        ];

        $components = [
            $this->createMock(DeviceComponentInterface::class),
            $this->createMock(DeviceComponentInterface::class),
        ];

        $componentsTransformer = $this->createMock(DeviceComponentsTransformerInterface::class);
        $componentsTransformer->method('transform')
            ->with($componentsData)
            ->willReturn($components);

        $transformer = new DeviceTransformer($componentsTransformer);

        $actual = $transformer->transform($data);

        self::assertSame($data[DeviceTransformerInterface::KEY_DEVICE_ID], $actual->getDeviceId());
        self::assertSame($data[DeviceTransformerInterface::KEY_LABEL], $actual->getLabel());
        self::assertSame($data[DeviceTransformerInterface::KEY_NAME], $actual->getName());
        self::assertSame($components, $actual->getComponents());
    }

    #[TestWith([[]])]
    #[TestWith([[DeviceTransformerInterface::KEY_DEVICE_ID => 42]])]
    public function testTransformUnexpectedData(array $data): void
    {
        $componentsTransformer = $this->createMock(DeviceComponentsTransformerInterface::class);
        $transformer = new DeviceTransformer($componentsTransformer);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf(DeviceTransformerInterface::UNEXPECTED_STRING_SPRINTF, DeviceTransformerInterface::KEY_DEVICE_ID));
        $transformer->transform($data);
    }
}
