<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface DeviceComponentCapabilityInterface
{
    public function getId(): string;

    public function setId(string $value): self;
}
