<?php

declare(strict_types=1);

namespace App\Quest\Domain\Repository;

interface FavoriteRepositoryInterface
{
    public function add(string $questId, string $userId): void;

    public function remove(string $questId, string $userId): void;

    public function getTotalCount(string $userId): int;

    public function getAllByPage(
        string $userId,
        int $page,
        int $limit,
        string $sort,
        array $filter,
        ?string $search
    ): array;
}
