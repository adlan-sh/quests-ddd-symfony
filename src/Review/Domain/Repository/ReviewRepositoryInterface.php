<?php

declare(strict_types=1);

namespace App\Review\Domain\Repository;

use App\Review\Domain\Aggregation\Review;

interface ReviewRepositoryInterface
{
    public function create(array $review): Review;

    public function isExists(string $questId, string $userId): bool;

    public function isExistsById(string $reviewId): bool;

    public function isSubscribed(string $questId, string $userId): bool;

    public function questFinished(string $questId): bool;

    public function getUserReviews(string $userId, int $page, int $limit): array;

    public function getTotalCountForUser(string $userId): int;

    public function editReview(string $reviewId, int $score, string $text): Review;

    public function deleteReview(string $reviewId): void;
}
