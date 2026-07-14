<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Exception;

use RuntimeException;

final class UnexpectedResponseException extends RuntimeException implements UnexpectedResponseExceptionInterface
{
}
