<?php

declare(strict_types=1);

namespace App\Quest\Domain\Repository;

interface SubscribeRepositoryInterface
{
    public function hasSeats(string $questId): bool;

    public function subscribe(string $questId, string $userId): bool;

    public function unsubscribe(string $questId, string $userId): bool;
}
