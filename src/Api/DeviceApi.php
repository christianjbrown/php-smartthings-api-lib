<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Api;

use ChristianBrown\JsonApiClient\JsonApiRequestExceptionInterface;
use ChristianBrown\JsonApiClient\JsonApiRequestSenderInterface;
use ChristianBrown\SmartThings\Transformer\DevicesTransformerInterface;
use RuntimeException;

use function is_array;
use function sprintf;

final class DeviceApi implements DeviceApiInterface
{
    private string $apiToken;
    private DevicesTransformerInterface $devicesTransformer;
    private JsonApiRequestSenderInterface $requestSender;

    public function __construct(JsonApiRequestSenderInterface $requestSender, DevicesTransformerInterface $devicesTransformer, string $apiToken)
    {
        $this->requestSender = $requestSender;
        $this->devicesTransformer = $devicesTransformer;
        $this->apiToken = $apiToken;
    }

    /**
     * @throws JsonApiRequestExceptionInterface
     * @throws RuntimeException
     */
    public function get(): array
    {
        $headers = [
            self::HEADER_KEY_AUTHORIZATION => sprintf(self::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, $this->apiToken),
        ];
        $data = $this->requestSender->get(self::API_URL, [], $headers);

        if (empty($data[self::KEY_ITEMS]) || !is_array($data[self::KEY_ITEMS])) {
            throw new RuntimeException(sprintf(self::UNEXPECTED_RESPONSE_SPRINTF, self::KEY_ITEMS));
        }
        $devices = $this->devicesTransformer->transform($data[self::KEY_ITEMS]);

        return $devices;
    }
}
