<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Api;

use ChristianBrown\JsonApiClient\JsonApiRequestExceptionInterface;
use ChristianBrown\JsonApiClient\JsonApiRequestSenderInterface;
use ChristianBrown\SmartThings\Api\ApiInterface;
use ChristianBrown\SmartThings\Api\DeviceApi;
use ChristianBrown\SmartThings\Api\DeviceApiInterface;
use ChristianBrown\SmartThings\Model\DeviceInterface;
use ChristianBrown\SmartThings\Transformer\DevicesTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

use RuntimeException;

use function sprintf;

#[CoversClass(DeviceApi::class)]
final class DeviceApiTest extends TestCase
{
    /**
     * @throws JsonApiRequestExceptionInterface
     * @throws Exception
     */
    public function testGet(): void
    {
        $data = [
            DeviceApiInterface::KEY_ITEMS => ['test-item-1', 'test-item-2'],
        ];

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->method('get')
            ->with(
                DeviceApiInterface::API_URL,
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn($data);

        $devices = [$this->createMock(DeviceInterface::class), $this->createMock(DeviceInterface::class)];

        $devicesTransformer = $this->createMock(DevicesTransformerInterface::class);
        $devicesTransformer->method('transform')
            ->with($data[DeviceApiInterface::KEY_ITEMS])
            ->willReturn($devices);

        $deviceApi = new DeviceApi($requestSender, $devicesTransformer, 'test-api-token');
        $actual = $deviceApi->get();

        self::assertSame($devices, $actual);
    }

    /**
     * @throws JsonApiRequestExceptionInterface
     * @throws Exception
     */
    #[TestWith([['test-items-key-missing']])]
    #[TestWith([[DeviceApiInterface::KEY_ITEMS => 'test-not-array']])]
    public function testGetUnexpectedResponse(array $data): void
    {
        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->method('get')
            ->with(
                DeviceApiInterface::API_URL,
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn($data);

        $devicesTransformer = $this->createMock(DevicesTransformerInterface::class);

        $deviceApi = new DeviceApi($requestSender, $devicesTransformer, 'test-api-token');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf(DeviceApiInterface::UNEXPECTED_RESPONSE_SPRINTF, DeviceApiInterface::KEY_ITEMS));
        $deviceApi->get();
    }
}
