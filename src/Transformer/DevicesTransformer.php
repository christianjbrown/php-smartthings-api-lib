<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceInterface;

use function array_values;
use function count;
use function sprintf;

final class DevicesTransformer implements DevicesTransformerInterface
{
    private DeviceTransformerInterface $deviceTransformer;

    public function __construct(DeviceTransformerInterface $deviceTransformer)
    {
        $this->deviceTransformer = $deviceTransformer;
    }

    /**
     * @param mixed[] $data
     *
     * @return array<int, DeviceInterface>
     */
    public function transform(array $data): array
    {
        $devices = [];
        $values = array_values($data);
        for ($i = 0, $count = count($values); $i < $count; ++$i) {
            $deviceData = $values[$i];
            if (!is_array($deviceData)) {
                throw new UnexpectedResponseException(sprintf(self::UNEXPECTED_ARRAY_SPRINTF, self::ARRAY_NAME));
            }
            $devices[] = $this->deviceTransformer->transform($deviceData);
        }

        return $devices;
    }
}
