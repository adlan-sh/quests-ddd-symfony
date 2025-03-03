<?php

namespace App\Quest\Domain\Repository;

use App\Quest\Domain\Aggregation\Quest;

interface QuestRepositoryInterface
{
    public function getById(string $id): ?Quest;

    public function getTotalCount(): int;

    public function getTotalCountCompletedQuestsForUser(string $userId): int;

    public function getAllByPage(
        int $page,
        int $limit,
        string $sort,
        array $filter,
        ?string $search
    ): array;

    public function getCompletedByPage(
        string $userId,
        int $page,
        int $limit,
        string $sort,
        array $filter,
        ?string $search
    ): array;
}
