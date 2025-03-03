<?php

declare(strict_types=1);

namespace App\Shared\Application\Resource;

interface ResourceInterface
{
    public function toArray(): array;

    public function getCode(): int;
}
