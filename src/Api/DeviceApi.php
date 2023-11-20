<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Api;

use ChristianBrown\JsonApiClient\RequestSenderInterface;
use ChristianBrown\SmartThings\Transformer\DevicesTransformerInterface;
use RuntimeException;

use function is_array;
use function sprintf;

final class DeviceApi implements DeviceApiInterface
{
    private string $apiToken;
    private DevicesTransformerInterface $devicesTransformer;
    private RequestSenderInterface $requestSender;

    public function __construct(RequestSenderInterface $requestSender, DevicesTransformerInterface $devicesTransformer, string $apiToken)
    {
        $this->requestSender = $requestSender;
        $this->devicesTransformer = $devicesTransformer;
        $this->apiToken = $apiToken;
    }

    public function get(): array
    {
        $headers = [
            'Authorization' => sprintf('Bearer %s', $this->apiToken),
        ];
        $data = $this->requestSender->get(self::API_NAME, self::API_URL, [], $headers);

        if (empty($data[self::KEY_ITEMS]) || !is_array($data[self::KEY_ITEMS])) {
            throw new RuntimeException(sprintf('%s not set or not an array', self::KEY_ITEMS));
        }
        $devices = $this->devicesTransformer->transform($data[self::KEY_ITEMS]);

        return $devices;
    }
}
