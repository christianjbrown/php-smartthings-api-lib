<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Api;

use ChristianBrown\JsonApiClient\JsonApiRequestExceptionInterface;
use ChristianBrown\JsonApiClient\JsonApiRequestSenderInterface;
use ChristianBrown\SmartThings\Api\ApiInterface;
use ChristianBrown\SmartThings\Api\DeviceStatusApi;
use ChristianBrown\SmartThings\Api\DeviceStatusApiInterface;
use ChristianBrown\SmartThings\Model\DeviceInterface;
use ChristianBrown\SmartThings\Model\DeviceStatusInterface;
use ChristianBrown\SmartThings\Transformer\DeviceStatusTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

use RuntimeException;

use function sprintf;

#[CoversClass(DeviceStatusApi::class)]
final class DeviceStatusApiTest extends TestCase
{
    /**
     * @throws JsonApiRequestExceptionInterface
     * @throws Exception
     */
    public function testGet(): void
    {
        $data = [
            DeviceStatusApiInterface::KEY_COMPONENTS => [
                DeviceStatusApiInterface::KEY_COMPONENTS_MAIN => ['test-item-1', 'test-item-2'],
            ],
        ];

        $device = $this->createMock(DeviceInterface::class);
        $device->method('getDeviceId')
            ->willReturn('test-device-id');

        $deviceStatus = $this->createMock(DeviceStatusInterface::class);

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->method('get')
            ->with(
                sprintf(DeviceStatusApiInterface::API_URL_SPRINTF, 'test-device-id'),
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn($data);

        $deviceStatusTransformer = $this->createMock(DeviceStatusTransformerInterface::class);
        $deviceStatusTransformer->method('transform')
            ->with($data[DeviceStatusApiInterface::KEY_COMPONENTS][DeviceStatusApiInterface::KEY_COMPONENTS_MAIN])
            ->willReturn($deviceStatus);

        $deviceApi = new DeviceStatusApi($requestSender, $deviceStatusTransformer, 'test-api-token');
        $actual = $deviceApi->get($device);

        self::assertSame($deviceStatus, $actual);
    }

    /**
     * @throws JsonApiRequestExceptionInterface
     * @throws Exception
     */
    #[TestWith([['test-items-key-missing'], DeviceStatusApiInterface::KEY_COMPONENTS])]
    #[TestWith([[DeviceStatusApiInterface::KEY_COMPONENTS => 'test-not-array'], DeviceStatusApiInterface::KEY_COMPONENTS])]
    #[TestWith([[DeviceStatusApiInterface::KEY_COMPONENTS => ['test-items-key-missing']], DeviceStatusApiInterface::KEY_COMPONENTS_MAIN])]
    #[TestWith([[DeviceStatusApiInterface::KEY_COMPONENTS => [DeviceStatusApiInterface::KEY_COMPONENTS_MAIN => 'test-not-array']], DeviceStatusApiInterface::KEY_COMPONENTS_MAIN])]
    public function testGetUnexpectedResponse(array $data, string $exceptionString): void
    {
        $device = $this->createMock(DeviceInterface::class);
        $device->method('getDeviceId')
            ->willReturn('test-device-id');

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->method('get')
            ->with(
                sprintf(DeviceStatusApiInterface::API_URL_SPRINTF, 'test-device-id'),
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn($data);

        $deviceStatusTransformer = $this->createMock(DeviceStatusTransformerInterface::class);

        $deviceApi = new DeviceStatusApi($requestSender, $deviceStatusTransformer, 'test-api-token');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(sprintf(DeviceStatusApiInterface::UNEXPECTED_RESPONSE_SPRINTF, $exceptionString));
        $deviceApi->get($device);
    }
}
