<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

interface CodeRepositoryInterface
{
    public function save(string $userId, int $code): void;

    public function isValid(string $userId, string $code): bool;
}
