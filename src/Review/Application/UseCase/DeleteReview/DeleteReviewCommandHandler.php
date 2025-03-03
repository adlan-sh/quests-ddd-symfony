<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\DeleteReview;

use App\Review\Domain\Service\ReviewService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use Symfony\Component\HttpFoundation\Response;

readonly class DeleteReviewCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ReviewService $reviewService
    ) {
    }

    public function __invoke(DeleteReviewCommand $command): CommandResultInterface
    {
        $this->reviewService->deleteReview($command->reviewId);

        return new DeleteReviewCommandResult(
            Response::HTTP_OK
        );
    }
}
