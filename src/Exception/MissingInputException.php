<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Exception;

use InvalidArgumentException;

final class MissingInputException extends InvalidArgumentException implements MissingInputExceptionInterface
{
}
