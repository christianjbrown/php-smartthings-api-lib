<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Api;

use ChristianBrown\JsonApiClient\JsonApiRequestExceptionInterface;
use ChristianBrown\JsonApiClient\JsonApiRequestSenderInterface;
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
    private JsonApiRequestSenderInterface $requestSender;

    public function __construct(JsonApiRequestSenderInterface $requestSender, DeviceStatusTransformerInterface $deviceStatusTransformer, string $apiToken)
    {
        $this->requestSender = $requestSender;
        $this->deviceStatusTransformer = $deviceStatusTransformer;
        $this->apiToken = $apiToken;
    }

    /**
     * @throws JsonApiRequestExceptionInterface
     * @throws RuntimeException
     */
    public function get(DeviceInterface $device): DeviceStatusInterface
    {
        $headers = [
            self::HEADER_KEY_AUTHORIZATION => sprintf(self::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, $this->apiToken),
        ];
        $url = sprintf(self::API_URL_SPRINTF, $device->getDeviceId());
        $data = $this->requestSender->get($url, [], $headers);

        if (empty($data[self::KEY_COMPONENTS]) || !is_array($data[self::KEY_COMPONENTS])) {
            throw new RuntimeException(sprintf(self::UNEXPECTED_RESPONSE_SPRINTF, self::KEY_COMPONENTS));
        }
        $components = $data[self::KEY_COMPONENTS];
        if (empty($components[self::KEY_COMPONENTS_MAIN]) || !is_array($components[self::KEY_COMPONENTS_MAIN])) {
            throw new RuntimeException(sprintf(self::UNEXPECTED_RESPONSE_SPRINTF, self::KEY_COMPONENTS_MAIN));
        }
        $status = $this->deviceStatusTransformer->transform($components[self::KEY_COMPONENTS_MAIN]);

        return $status;
    }
}
