<?php

declare(strict_types=1);

namespace App\Review\Domain\Service;

use App\Review\Domain\Aggregation\Review;
use App\Review\Domain\Exception\QuestWasNotFinishedException;
use App\Review\Domain\Exception\ReviewAlreadyExistsException;
use App\Review\Domain\Exception\ReviewNotFoundException;
use App\Review\Domain\Exception\UserWasNotSubscribedForQuestException;
use App\Review\Domain\Repository\ReviewRepositoryInterface;
use App\Shared\Domain\Entity\Pagination;

readonly class ReviewService
{
    public function __construct(
        private ReviewRepositoryInterface $reviewRepository,
        private Pagination $pagination
    ) {
    }

    public function createReview(array $review): Review
    {
        if (!$this->reviewRepository->isSubscribed($review['questId'], $review['userId'])) {
            throw new UserWasNotSubscribedForQuestException();
        }

        if (!$this->reviewRepository->questFinished($review['questId'])) {
            throw new QuestWasNotFinishedException();
        }

        if ($this->reviewRepository->isExists($review['questId'], $review['userId'])) {
            throw new ReviewAlreadyExistsException();
        }

        return $this->reviewRepository->create($review);
    }

    public function getUserReviews(string $userId, int $page, int $limit): array
    {
        $totalCount = $this->reviewRepository->getTotalCountForUser($userId);

        $this->pagination->setPage($page);
        $this->pagination->setLimit($limit);
        $this->pagination->setTotalCount($totalCount);

        return [
            'pagination' => $this->pagination->getPaginate(),
            'list' => $this->reviewRepository->getUserReviews($userId, $page, $limit),
        ];
    }

    public function editReview(string $reviewId, int $score, string $text): Review
    {
        if (!$this->reviewRepository->isExistsById($reviewId)) {
            throw new ReviewNotFoundException();
        }

        return $this->reviewRepository->editReview($reviewId, $score, $text);
    }

    public function deleteReview(string $reviewId): void
    {
        if (!$this->reviewRepository->isExistsById($reviewId)) {
            throw new ReviewNotFoundException();
        }

        $this->reviewRepository->deleteReview($reviewId);
    }
}
