<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase;

use App\Review\Application\Request\GetUserReviewsRequest;
use App\Review\Application\Request\ReviewRequest;
use App\Review\Application\UseCase\AddReview\AddReviewCommand;
use App\Review\Application\UseCase\DeleteReview\DeleteReviewCommand;
use App\Review\Application\UseCase\EditReview\EditReviewCommand;
use App\Review\Application\UseCase\GetUserReviews\GetUserReviewsCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\UseCase\CommandResultInterface;

readonly class ReviewUseCaseInteractor
{
    public function __construct(
        private CommandBusInterface $commandBus
    ) {
    }

    public function addReview(ReviewRequest $request, string $questId): CommandResultInterface
    {
        return $this->commandBus->execute(
            new AddReviewCommand(
                $request->getScore(),
                $request->getText(),
                $questId
            )
        );
    }

    public function getUserReviews(GetUserReviewsRequest $request): CommandResultInterface
    {
        return $this->commandBus->execute(
            new GetUserReviewsCommand(
                $request->getPage(),
                $request->getLimit()
            )
        );
    }

    public function editReview(ReviewRequest $request, string $reviewId): CommandResultInterface
    {
        return $this->commandBus->execute(
            new EditReviewCommand(
                $request->getScore(),
                $request->getText(),
                $reviewId
            )
        );
    }

    public function deleteReview(string $reviewId): CommandResultInterface
    {
        return $this->commandBus->execute(
            new DeleteReviewCommand($reviewId)
        );
    }
}
