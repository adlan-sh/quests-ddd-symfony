<?php

declare(strict_types=1);

namespace App\Shared\Domain\Service;

interface CacheServiceInterface
{
    public function exists(string $key): bool;

    public function get(string $key, string $class): mixed;

    public function set(string $key, mixed $value): void;
}
