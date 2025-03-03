<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

readonly class Photo
{
    public function __construct(private string $path)
    {
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
