<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceComponentInterface;

use function array_values;
use function count;
use function is_array;
use function sprintf;

final class DeviceComponentsTransformer implements DeviceComponentsTransformerInterface
{
    private DeviceComponentTransformerInterface $deviceComponentTransformer;

    public function __construct(DeviceComponentTransformerInterface $deviceComponentTransformer)
    {
        $this->deviceComponentTransformer = $deviceComponentTransformer;
    }

    /**
     * @param mixed[] $data
     *
     * @return array<int, DeviceComponentInterface>
     */
    public function transform(array $data): array
    {
        $components = [];
        $values = array_values($data);
        for ($i = 0, $count = count($values); $i < $count; ++$i) {
            $componentData = $values[$i];
            if (!is_array($componentData)) {
                throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::ARRAY_NAME));
            }
            $components[] = $this->deviceComponentTransformer->transform($componentData);
        }

        return $components;
    }
}
