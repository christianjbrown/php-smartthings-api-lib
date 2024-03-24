<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Transformer;

use ChristianBrown\SmartThings\Model\DeviceComponentCapability;
use ChristianBrown\SmartThings\Transformer\DeviceComponentCapabilityTransformer;
use ChristianBrown\SmartThings\Transformer\DeviceComponentCapabilityTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(DeviceComponentCapability::class)]
#[CoversClass(DeviceComponentCapabilityTransformer::class)]
final class DeviceComponentCapabilityTransformerTest extends TestCase
{
    public function testTransform(): void
    {
        $data = [
            DeviceComponentCapabilityTransformerInterface::KEY_ID => 'test-id',
        ];

        $transformer = new DeviceComponentCapabilityTransformer();

        $actual = $transformer->transform($data);

        self::assertSame('test-id', $actual->getId());
    }

    #[TestWith([[]])]
    #[TestWith([[DeviceComponentCapabilityTransformerInterface::KEY_ID => 42]])]
    public function testTransformUnexpectedData(array $data): void
    {
        $transformer = new DeviceComponentCapabilityTransformer();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf(DeviceComponentCapabilityTransformerInterface::UNEXPECTED_STRING_SPRINTF, DeviceComponentCapabilityTransformerInterface::KEY_ID));
        $transformer->transform($data);
    }
}
