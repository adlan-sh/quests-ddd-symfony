<?php

declare(strict_types=1);

namespace App\Review\Application\UseCase\GetUserReviews;

use App\Review\Application\Mapper\ReviewMapper;
use App\Review\Domain\Service\ReviewService;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Application\UseCase\CommandResultInterface;
use App\User\Application\Adapter\UserIdAdapter;
use Symfony\Component\HttpFoundation\Response;

readonly class GetUserReviewsCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private UserIdAdapter $userIdAdapter,
        private ReviewService $reviewService
    ) {
    }

    public function __invoke(GetUserReviewsCommand $command): CommandResultInterface
    {
        $userId = $this->userIdAdapter->getUserId();
        $reviewsList = $this->reviewService->getUserReviews($userId, $command->page, $command->limit);

        return new GetUserReviewsCommandResult(
            ReviewMapper::toPaginationDTO($reviewsList['pagination']),
            ReviewMapper::toReviewListDTO($reviewsList['list']),
            Response::HTTP_OK
        );
    }
}
