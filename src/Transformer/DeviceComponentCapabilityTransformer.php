<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceComponentCapability;
use ChristianBrown\SmartThings\Model\DeviceComponentCapabilityInterface;

use function is_string;
use function sprintf;

final class DeviceComponentCapabilityTransformer implements DeviceComponentCapabilityTransformerInterface
{
    /**
     * @param mixed[] $data
     */
    public function transform(array $data): DeviceComponentCapabilityInterface
    {
        if (empty($data[self::KEY_ID])) {
            throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_STRING_SPRINTF, self::KEY_ID));
        }
        if (!is_string($data[self::KEY_ID])) {
            throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_STRING_SPRINTF, self::KEY_ID));
        }
        $capability = new DeviceComponentCapability($data[self::KEY_ID]);

        return $capability;
    }
}
