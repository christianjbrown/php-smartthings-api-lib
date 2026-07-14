<?php

declare(strict_types=1);

namespace ChristianBrown\SmartThings\Model;

interface LocationRoomInterface
{
    public function getLocationId(): ?string;

    public function getName(): ?string;

    public function getRoomId(): string;

    public function setLocationId(?string $value): self;

    public function setName(?string $value): self;

    public function setRoomId(string $value): self;
}
