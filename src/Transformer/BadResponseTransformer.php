<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

use ChristianBrown\JsonApiClient\BadResponseTransformerInterface;
use Psr\Http\Message\ResponseInterface;

final class BadResponseTransformer implements BadResponseTransformerInterface
{
    public function getFriendlyErrorFromBadResponse(ResponseInterface $response): string
    {
        return 'test';
    }

    public function getFriendlyErrorFromBadResponseJsonData(ResponseInterface $response, array $responseData): string
    {
        return 'test';
    }
}
