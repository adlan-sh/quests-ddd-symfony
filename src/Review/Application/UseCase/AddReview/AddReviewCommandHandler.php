<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\AddReview;

use App\Review\Application\Model\ReviewDTO;
use App\Review\Domain\Service\ReviewService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Adapter\UserIdAdapter;
use Symfony\Component\HttpFoundation\Response;

readonly class AddReviewCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ReviewService $reviewService,
        private UserIdAdapter $userIdAdapter
    ) {
    }

    public function __invoke(AddReviewCommand $command): CommandResultInterface
    {
        $reviewData = [
            'score' => $command->score,
            'text' => $command->text,
            'questId' => $command->questId,
            'userId' => $this->userIdAdapter->getUserId(),
        ];

        $review = $this->reviewService->createReview($reviewData);

        return new AddReviewCommandResult(
            new ReviewDTO($review->getScore(), $review->getText()),
            Response::HTTP_OK
        );
    }
}
