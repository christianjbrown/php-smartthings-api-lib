<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Api;

use ChristianBrown\ApiClient\Exception\Request\RequestExceptionInterface;
use ChristianBrown\ApiClient\JsonApiRequestSenderInterface;
use ChristianBrown\SmartThings\Api\ApiInterface;
use ChristianBrown\SmartThings\Api\LocationRoomApi;
use ChristianBrown\SmartThings\Api\LocationRoomApiInterface;
use ChristianBrown\SmartThings\Exception\MissingInputException;
use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Model\DeviceInterface;
use ChristianBrown\SmartThings\Model\LocationInterface;
use ChristianBrown\SmartThings\Model\LocationRoomInterface;
use ChristianBrown\SmartThings\Transformer\LocationRoomTransformerInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

use function sprintf;

#[CoversClass(LocationRoomApi::class)]
final class LocationRoomApiTest extends TestCase
{
    /**
     * @throws RequestExceptionInterface
     * @throws Exception
     */
    public function testGetCachesByRoomId(): void
    {
        $data = ['test-room-data'];

        $device = $this->createMock(DeviceInterface::class);
        $device->method('getLocationId')
            ->willReturn('test-location-id');
        $device->method('getRoomId')
            ->willReturn('test-room-id');

        $room = $this->createMock(LocationRoomInterface::class);

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->expects(self::once())
            ->method('get')
            ->with(
                sprintf(LocationRoomApiInterface::API_URL_SPRINTF, 'test-location-id', 'test-room-id'),
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn($data);

        $roomTransformer = $this->createMock(LocationRoomTransformerInterface::class);
        $roomTransformer->expects(self::once())
            ->method('transform')
            ->with($data)
            ->willReturn($room);

        $roomApi = new LocationRoomApi($requestSender, $roomTransformer, 'test-api-token');

        // Second call for the same roomId is served from the cache without hitting the API.
        self::assertSame($room, $roomApi->getOneByDevice($device));
        self::assertSame($room, $roomApi->getOneByDevice($device));
    }

    /**
     * @throws RequestExceptionInterface
     * @throws Exception
     */
    public function testGetOneByDevice(): void
    {
        $data = ['test-room-data'];

        $device = $this->createMock(DeviceInterface::class);
        $device->method('getLocationId')
            ->willReturn('test-location-id');
        $device->method('getRoomId')
            ->willReturn('test-room-id');

        $room = $this->createMock(LocationRoomInterface::class);

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->method('get')
            ->with(
                sprintf(LocationRoomApiInterface::API_URL_SPRINTF, 'test-location-id', 'test-room-id'),
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn($data);

        $roomTransformer = $this->createMock(LocationRoomTransformerInterface::class);
        $roomTransformer->method('transform')
            ->with($data)
            ->willReturn($room);

        $roomApi = new LocationRoomApi($requestSender, $roomTransformer, 'test-api-token');
        $actual = $roomApi->getOneByDevice($device);

        self::assertSame($room, $actual);
    }

    /**
     * @throws RequestExceptionInterface
     * @throws Exception
     */
    public function testGetOneByDeviceMissingLocationId(): void
    {
        $device = $this->createMock(DeviceInterface::class);
        $device->method('getLocationId')
            ->willReturn(null);

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $roomTransformer = $this->createMock(LocationRoomTransformerInterface::class);

        $roomApi = new LocationRoomApi($requestSender, $roomTransformer, 'test-api-token');

        $this->expectException(MissingInputException::class);
        $this->expectExceptionMessage(LocationRoomApiInterface::MISSING_LOCATION_ID);
        $roomApi->getOneByDevice($device);
    }

    /**
     * @throws RequestExceptionInterface
     * @throws Exception
     */
    public function testGetOneByDeviceMissingRoomId(): void
    {
        $device = $this->createMock(DeviceInterface::class);
        $device->method('getLocationId')
            ->willReturn('test-location-id');
        $device->method('getRoomId')
            ->willReturn(null);

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $roomTransformer = $this->createMock(LocationRoomTransformerInterface::class);

        $roomApi = new LocationRoomApi($requestSender, $roomTransformer, 'test-api-token');

        $this->expectException(MissingInputException::class);
        $this->expectExceptionMessage(LocationRoomApiInterface::MISSING_ROOM_ID);
        $roomApi->getOneByDevice($device);
    }

    /**
     * @throws RequestExceptionInterface
     * @throws Exception
     */
    public function testGetOneByLocationAndId(): void
    {
        $data = ['test-room-data'];

        $location = $this->createMock(LocationInterface::class);
        $location->method('getLocationId')
            ->willReturn('test-location-id');

        $room = $this->createMock(LocationRoomInterface::class);

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->method('get')
            ->with(
                sprintf(LocationRoomApiInterface::API_URL_SPRINTF, 'test-location-id', 'test-room-id'),
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn($data);

        $roomTransformer = $this->createMock(LocationRoomTransformerInterface::class);
        $roomTransformer->method('transform')
            ->with($data)
            ->willReturn($room);

        $roomApi = new LocationRoomApi($requestSender, $roomTransformer, 'test-api-token');
        $actual = $roomApi->getOneByLocationAndId($location, 'test-room-id');

        self::assertSame($room, $actual);
    }

    /**
     * @throws RequestExceptionInterface
     * @throws Exception
     */
    #[TestWith([false])]
    #[TestWith([true])]
    public function testGetOneUnexpectedResponse(bool $skipCache): void
    {
        $location = $this->createMock(LocationInterface::class);
        $location->method('getLocationId')
            ->willReturn('test-location-id');

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->method('get')
            ->with(
                sprintf(LocationRoomApiInterface::API_URL_SPRINTF, 'test-location-id', 'test-room-id'),
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn([]);

        $roomTransformer = $this->createMock(LocationRoomTransformerInterface::class);

        $roomApi = new LocationRoomApi($requestSender, $roomTransformer, 'test-api-token');

        $this->expectException(UnexpectedResponseException::class);
        $this->expectExceptionMessage(LocationRoomApiInterface::UNEXPECTED_RESPONSE);
        $roomApi->getOneByLocationAndId($location, 'test-room-id', $skipCache);
    }

    /**
     * @throws RequestExceptionInterface
     * @throws Exception
     */
    public function testGetSkipsCache(): void
    {
        $data = ['test-room-data'];

        $device = $this->createMock(DeviceInterface::class);
        $device->method('getLocationId')
            ->willReturn('test-location-id');
        $device->method('getRoomId')
            ->willReturn('test-room-id');

        $room = $this->createMock(LocationRoomInterface::class);

        $requestSender = $this->createMock(JsonApiRequestSenderInterface::class);
        $requestSender->expects(self::exactly(2))
            ->method('get')
            ->with(
                sprintf(LocationRoomApiInterface::API_URL_SPRINTF, 'test-location-id', 'test-room-id'),
                [],
                [
                    ApiInterface::HEADER_KEY_AUTHORIZATION => sprintf(ApiInterface::HEADER_VALUE_AUTHORIZATION_BEARER_SPRINTF, 'test-api-token'),
                ]
            )
            ->willReturn($data);

        $roomTransformer = $this->createMock(LocationRoomTransformerInterface::class);
        $roomTransformer->method('transform')
            ->with($data)
            ->willReturn($room);

        $roomApi = new LocationRoomApi($requestSender, $roomTransformer, 'test-api-token');

        // First call populates the cache; the second bypasses it and hits the API again.
        self::assertSame($room, $roomApi->getOneByDevice($device));
        self::assertSame($room, $roomApi->getOneByDevice($device, true));
    }
}
