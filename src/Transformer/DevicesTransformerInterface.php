<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Transformer;

interface DevicesTransformerInterface
{
    public function transform(array $data): array;
}
