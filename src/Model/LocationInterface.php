<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface LocationInterface
{
    public function getLocationId(): string;

    public function getName(): ?string;

    public function setLocationId(string $value): self;

    public function setName(?string $value): self;
}
