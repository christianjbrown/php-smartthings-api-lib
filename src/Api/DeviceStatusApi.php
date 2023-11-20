<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Api;

use ChristianBrown\JsonApiClient\RequestSenderInterface;
use ChristianBrown\SmartThings\Model\DeviceInterface;
use ChristianBrown\SmartThings\Model\DeviceStatusInterface;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTransformerInterface;
use RuntimeException;

use function is_array;
use function sprintf;

final class DeviceStatusApi implements DeviceStatusApiInterface
{
    private string $apiToken;
    private DeviceStatusTransformerInterface $deviceStatusTransformer;
    private RequestSenderInterface $requestSender;

    public function __construct(RequestSenderInterface $requestSender, DeviceStatusTransformerInterface $deviceStatusTransformer, string $apiToken)
    {
        $this->requestSender = $requestSender;
        $this->deviceStatusTransformer = $deviceStatusTransformer;
        $this->apiToken = $apiToken;
    }

    public function get(DeviceInterface $device): DeviceStatusInterface
    {
        $headers = [
            'Authorization' => sprintf('Bearer %s', $this->apiToken),
        ];
        $url = sprintf(self::API_URL_SPRINTF, $device->getDeviceId());
        $data = $this->requestSender->get(self::API_NAME, $url, [], $headers);

        if (empty($data[self::KEY_COMPONENTS]) || !is_array($data[self::KEY_COMPONENTS])) {
            throw new RuntimeException(sprintf('%s not set or not an array', self::KEY_COMPONENTS));
        }
        $components = $data[self::KEY_COMPONENTS];
        if (empty($components[self::KEY_COMPONENTS_MAIN]) || !is_array($components[self::KEY_COMPONENTS_MAIN])) {
            throw new RuntimeException(sprintf('%s not set or not an array', self::KEY_COMPONENTS_MAIN));
        }
        $status = $this->deviceStatusTransformer->transform($components[self::KEY_COMPONENTS_MAIN]);

        return $status;
    }
}
