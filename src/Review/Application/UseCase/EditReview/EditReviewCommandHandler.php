<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\EditReview;

use App\Review\Application\Model\ReviewDTO;
use App\Review\Domain\Service\ReviewService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use Symfony\Component\HttpFoundation\Response;

readonly class EditReviewCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ReviewService $reviewService
    ) {
    }

    public function __invoke(EditReviewCommand $command): CommandResultInterface
    {
        $review = $this->reviewService->editReview($command->reviewId, $command->score, $command->text);

        return new EditReviewCommandResult(
            new ReviewDTO($review->getScore(), $review->getText()),
            Response::HTTP_OK
        );
    }
}
