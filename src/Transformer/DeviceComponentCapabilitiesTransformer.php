<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceComponentCapabilityInterface;

use function array_values;
use function count;
use function is_array;
use function sprintf;

final class DeviceComponentCapabilitiesTransformer implements DeviceComponentCapabilitiesTransformerInterface
{
    private DeviceComponentCapabilityTransformerInterface $deviceComponentCapabilityTransformer;

    public function __construct(DeviceComponentCapabilityTransformerInterface $deviceComponentCapabilityTransformer)
    {
        $this->deviceComponentCapabilityTransformer = $deviceComponentCapabilityTransformer;
    }

    /**
     * @param mixed[] $data
     *
     * @return array<int, DeviceComponentCapabilityInterface>
     */
    public function transform(array $data): array
    {
        $capabilities = [];
        $values = array_values($data);
        for ($i = 0, $count = count($values); $i < $count; ++$i) {
            $capabilityData = $values[$i];
            if (!is_array($capabilityData)) {
                throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::ARRAY_NAME));
            }
            $capabilities[] = $this->deviceComponentCapabilityTransformer->transform($capabilityData);
        }

        return $capabilities;
    }
}
