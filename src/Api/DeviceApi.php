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
    private RequestSenderInterface $requestSender;
    private DevicesTransformerInterface $devicesTransformer;
    private string $apiToken;

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

    /*

        if (!empty($jsonDevices['items']) && is_array($jsonDevices['items'])) {
            foreach ($jsonDevices['items'] as $device) {
                $deviceSupportsReadingTemp = false;
                if (is_array($device) && !empty($device['name']) && is_string($device['name']) && !empty($device['deviceId']) && is_string($device['deviceId']) && !empty($device['components'][0]['capabilities']) && is_array($device['components'][0]['capabilities'])) {
                    foreach ($device['components'][0]['capabilities'] as $capability) {
                        if (is_array($capability) && !empty($capability['id']) && 'temperatureMeasurement' === $capability['id']) {
                            $deviceSupportsReadingTemp = true;
                            break;
                        }
                    }
                    if ($deviceSupportsReadingTemp) {
                        $devicesWithReadingTemp[$device['name']] = $device['deviceId'];
                    }
                }
            }
        }

        $totalForAverage = 0;
        $totalDevicesAveraged = 0;
        $latestNonStaleTimestamp = null;
        foreach ($devicesWithReadingTemp as $deviceName => $deviceId) {
            $deviceUrl = sprintf('https://api.smartthings.com/v1/devices/%s/status', $deviceId);
            $rawDeviceData = file_get_contents($deviceUrl, false, $context);
            $jsonDevice = json_decode($rawDeviceData, true, 512, \JSON_THROW_ON_ERROR);
            if (!empty($jsonDevice['components']['main']['temperatureMeasurement']['temperature']['value']) && !empty($jsonDevice['components']['main']['temperatureMeasurement']['temperature']['timestamp'])) {
                $temp = (float) $jsonDevice['components']['main']['temperatureMeasurement']['temperature']['value'];
                $timestamp = strtotime($jsonDevice['components']['main']['temperatureMeasurement']['temperature']['timestamp']);
                $stale = $timestamp < time() - (24 * 60 * 60);
                if (!$stale) {
                    $totalForAverage += $temp;
                    ++$totalDevicesAveraged;
                    if (null === $latestNonStaleTimestamp || $timestamp < $latestNonStaleTimestamp) {
                        $latestNonStaleTimestamp = $timestamp;
                    }
                }
                $bodyJsonDevices[] = [
                    'name' => $deviceName,
                    'temp' => $temp,
                    'timestamp' => $timestamp,
                    'stale' => $stale,
                ];
            }
        }
        usort(
            $bodyJsonDevices,
            static fn ($a, $b) => strcmp($a['name'], $b['name'])
        );

        $data['devices'] = $bodyJsonDevices;
        if ($totalDevicesAveraged > 0) {
            $data['averageTempDegrees'] = $totalForAverage / $totalDevicesAveraged;
            $data['averageTempTimestamp'] = $latestNonStaleTimestamp;
        }

        return $data;
     */
}
