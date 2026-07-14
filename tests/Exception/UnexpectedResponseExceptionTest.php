<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Tests\Exception;

use ChristianBrown\SmartThings\Exception\ExceptionInterface;
use ChristianBrown\SmartThings\Exception\UnexpectedResponseException;
use ChristianBrown\SmartThings\Exception\UnexpectedResponseExceptionInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use RuntimeException;

#[CoversClass(UnexpectedResponseException::class)]
final class UnexpectedResponseExceptionTest extends TestCase
{
    public function test(): void
    {
        $exception = new UnexpectedResponseException('test-message');

        self::assertInstanceOf(UnexpectedResponseExceptionInterface::class, $exception);
        self::assertInstanceOf(ExceptionInterface::class, $exception);
        self::assertInstanceOf(RuntimeException::class, $exception);
        self::assertSame('test-message', $exception->getMessage());
    }
}
